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

        $templateId = \App\Models\Setting::get('paypal_template_id');

        $detail = [
            'invoice_number' => $order->order_number . '-' . time(),
            'currency_code' => 'USD',
            'note' => \App\Models\Setting::get('invoice_seller_note', 'While certain items may not contain allergens they are produced in an environment where allergens could be present. Please proceed with caution. ' . \App\Models\Setting::get('business_name', 'Bakery on Biscotto') . ' is not responsible for any ill effects.'),
            'terms_and_conditions' => \App\Models\Setting::get('invoice_terms', "Payment must be made in full for an order to be considered placed. Please pay your invoice as soon as possible as some items take more time to complete than others, and your order will not be started until payment is made.\n\nCancellations made at least 48 hours in advance will receive a full refund. Anything between 24 and 48 hours notice will receive a 50% refund. Anything under 24 hours is non-refundable."),
            'payment_term' => [
                'due_date' => $order->payment_deadline->format('Y-m-d'),
            ],
        ];

        if ($templateId) {
            $detail['template_id'] = $templateId;
        }

        $invoicePayload = [
            'detail' => $detail,
            'invoicer' => [
                'business_name' => \App\Models\Setting::get('business_name', 'Bakery on Biscotto'),
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

    /**
     * List all invoice templates.
     */
    public function listTemplates(): array
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->get("{$this->baseUrl}/v2/invoicing/templates");

        return $response->json('templates') ?? [];
    }

    /**
     * Get a single template by ID.
     */
    public function getTemplate(string $templateId): array
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->get("{$this->baseUrl}/v2/invoicing/templates/{$templateId}");

        return $response->json();
    }

    /**
     * Update a template's note and terms.
     */
    public function updateTemplate(string $templateId, string $note, string $terms): array
    {
        $token = $this->getAccessToken();

        // Fetch current template first
        $current = $this->getTemplate($templateId);

        // Update the detail fields
        $current['detail'] = array_merge($current['detail'] ?? [], [
            'note' => $note,
            'terms_and_conditions' => $terms,
        ]);

        // Remove read-only fields
        unset($current['id'], $current['links'], $current['standard_template']);

        $response = Http::withToken($token)
            ->put("{$this->baseUrl}/v2/invoicing/templates/{$templateId}", $current);

        if (!$response->successful()) {
            Log::error('PayPal template update failed', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);
            throw new \RuntimeException('Failed to update PayPal template: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * Create a new invoice template.
     */
    public function createTemplate(string $name, string $note, string $terms): array
    {
        $token = $this->getAccessToken();

        $payload = [
            'name' => $name,
            'default_template' => true,
            'detail' => [
                'currency_code' => 'USD',
                'note' => $note,
                'terms_and_conditions' => $terms,
            ],
            'settings' => [
                'template_item_settings' => [
                    ['field_name' => 'items.date', 'display_preference' => ['hidden' => true]],
                    ['field_name' => 'items.discount', 'display_preference' => ['hidden' => true]],
                    ['field_name' => 'items.tax', 'display_preference' => ['hidden' => true]],
                ],
            ],
        ];

        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/v2/invoicing/templates", $payload);

        if (!$response->successful()) {
            Log::error('PayPal template creation failed', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);
            throw new \RuntimeException('Failed to create PayPal template: ' . $response->body());
        }

        return $response->json();
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
                'note' => 'This invoice has been cancelled by ' . \App\Models\Setting::get('business_name', 'Bakery on Biscotto') . '.',
                'send_to_invoicer' => true,
                'send_to_recipient' => true,
            ]);

        return $response->successful();
    }
}
