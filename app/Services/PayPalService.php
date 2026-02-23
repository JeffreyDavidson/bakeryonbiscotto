<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PayPalService
{
    protected string $baseUrl;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct()
    {
        $this->baseUrl = config('services.paypal.base_url');
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
    }

    protected function getAccessToken(): string
    {
        $response = Http::asForm()
            ->withBasicAuth($this->clientId, $this->clientSecret)
            ->post("{$this->baseUrl}/v1/oauth2/token", [
                'grant_type' => 'client_credentials',
            ]);

        return $response->json('access_token');
    }

    public function createOrder(float $amount, string $description = 'Bakery Order'): array
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/v2/checkout/orders", [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => number_format($amount, 2, '.', ''),
                        ],
                        'description' => $description,
                    ],
                ],
            ]);

        return $response->json();
    }

    public function captureOrder(string $paypalOrderId): array
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->contentType('application/json')
            ->send('POST', "{$this->baseUrl}/v2/checkout/orders/{$paypalOrderId}/capture");

        \Log::info('PayPal capture response', [
            'status' => $response->status(),
            'body' => $response->json(),
        ]);

        return $response->json();
    }

    public function createAndSendInvoice(Order $order): array
    {
        $token = $this->getAccessToken();

        // Build line items
        $items = [];
        foreach ($order->items as $item) {
            $items[] = [
                'name' => $item->product_name,
                'quantity' => (string) $item->quantity,
                'unit_amount' => [
                    'currency_code' => 'USD',
                    'value' => number_format($item->unit_price, 2, '.', ''),
                ],
            ];
        }

        // Add delivery fee as line item if > 0
        if ($order->delivery_fee > 0) {
            $items[] = [
                'name' => 'Delivery Fee',
                'quantity' => '1',
                'unit_amount' => [
                    'currency_code' => 'USD',
                    'value' => number_format($order->delivery_fee, 2, '.', ''),
                ],
            ];
        }

        // Split customer name into first/last
        $nameParts = explode(' ', $order->customer_name, 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '';

        $invoicePayload = [
            'detail' => [
                'invoice_number' => $order->order_number . '-' . time(),
                'currency_code' => 'USD',
                'note' => "Bakery on Biscotto - Order {$order->order_number}",
                'payment_term' => [
                    'due_date' => $order->payment_deadline->format('Y-m-d'),
                ],
            ],
            'invoicer' => [
                'business_name' => 'Bakery on Biscotto',
            ],
            'primary_recipients' => [
                [
                    'billing_info' => [
                        'name' => [
                            'given_name' => $firstName,
                            'surname' => $lastName,
                        ],
                        'email_address' => $order->customer_email,
                    ],
                ],
            ],
            'items' => $items,
        ];

        // Create draft invoice
        $createResponse = Http::withToken($token)
            ->post("{$this->baseUrl}/v2/invoicing/invoices", $invoicePayload);

        if (!$createResponse->successful()) {
            Log::error('PayPal invoice creation failed', [
                'status' => $createResponse->status(),
                'body' => $createResponse->json(),
            ]);
            throw new \RuntimeException('Failed to create PayPal invoice: ' . $createResponse->body());
        }

        $invoiceData = $createResponse->json();
        $invoiceId = $invoiceData['id'] ?? null;

        // Extract the self link to get invoice URL
        $invoiceUrl = collect($invoiceData['links'] ?? [])
            ->firstWhere('rel', 'payer-view')['href'] ?? null;

        if (!$invoiceId) {
            throw new \RuntimeException('PayPal invoice ID not returned');
        }

        // Send the invoice
        $sendResponse = Http::withToken($token)
            ->post("{$this->baseUrl}/v2/invoicing/invoices/{$invoiceId}/send", [
                'send_to_invoicer' => true,
            ]);

        if (!$sendResponse->successful()) {
            Log::error('PayPal invoice send failed', [
                'invoice_id' => $invoiceId,
                'status' => $sendResponse->status(),
                'body' => $sendResponse->json(),
            ]);
        }

        // If we didn't get payer-view link from creation, fetch the invoice to get it
        if (!$invoiceUrl) {
            $detail = Http::withToken($token)
                ->get("{$this->baseUrl}/v2/invoicing/invoices/{$invoiceId}")
                ->json();
            $invoiceUrl = collect($detail['links'] ?? [])
                ->firstWhere('rel', 'payer-view')['href'] ?? null;
        }

        // Store on order
        $order->update([
            'paypal_invoice_id' => $invoiceId,
            'paypal_invoice_url' => $invoiceUrl,
        ]);

        return [
            'invoice_id' => $invoiceId,
            'invoice_url' => $invoiceUrl,
            'status' => $invoiceData['status'] ?? 'SENT',
        ];
    }

    public function getInvoiceStatus(string $invoiceId): string
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->get("{$this->baseUrl}/v2/invoicing/invoices/{$invoiceId}");

        return $response->json('status') ?? 'UNKNOWN';
    }

    public function cancelInvoice(string $invoiceId): bool
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/v2/invoicing/invoices/{$invoiceId}/cancel", [
                'subject' => 'Order cancelled',
                'note' => 'This invoice has been cancelled by Bakery on Biscotto.',
                'send_to_invoicer' => true,
                'send_to_recipient' => true,
            ]);

        return $response->successful();
    }
}
