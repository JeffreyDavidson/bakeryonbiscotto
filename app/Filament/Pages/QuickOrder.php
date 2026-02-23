<?php

namespace App\Filament\Pages;

use App\Models\Order;
use App\Models\Product;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;

class QuickOrder extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-plus-circle';

    protected static ?string $navigationLabel = 'Quick Order';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.quick-order';

    public static function getNavigationGroup(): ?string
    {
        return 'Shop';
    }

    // Form state
    public string $customer_name = '';
    public string $customer_email = '';
    public string $customer_phone = '';
    public string $fulfillment_type = 'pickup';
    public string $requested_date = '';
    public string $requested_time = '';
    public string $delivery_address = '';
    public string $delivery_zip = '';
    public string $notes = '';
    public array $items = [
        ['product_id' => '', 'quantity' => 1],
    ];

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '' => 'Quick Order',
        ];
    }

    public function getTitle(): string
    {
        return 'Quick Order';
    }

    public function getHeading(): string
    {
        return '';
    }

    #[Computed]
    public function products()
    {
        return Product::where('is_available', true)->orderBy('name')->get();
    }

    #[Computed]
    public function productOptions()
    {
        return $this->products->mapWithKeys(fn ($p) => [$p->id => "{$p->name} (\${$p->price})"])->toArray();
    }

    #[Computed]
    public function productPrices()
    {
        return $this->products->pluck('price', 'id')->toArray();
    }

    public function addItem(): void
    {
        $this->items[] = ['product_id' => '', 'quantity' => 1];
    }

    public function removeItem(int $index): void
    {
        if (count($this->items) > 1) {
            unset($this->items[$index]);
            $this->items = array_values($this->items);
        }
    }

    public function getItemPrice(string|int $productId): float
    {
        return (float) ($this->productPrices[$productId] ?? 0);
    }

    public function getSubtotal(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $price = $this->getItemPrice($item['product_id'] ?? '');
            $qty = (int) ($item['quantity'] ?? 0);
            $total += $price * $qty;
        }
        return $total;
    }

    public function getDeliveryFee(): float
    {
        return $this->fulfillment_type === 'delivery' ? 5.00 : 0;
    }

    public function submit(): void
    {
        $this->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'fulfillment_type' => 'required|in:pickup,delivery',
            'requested_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $subtotal = 0;
        $itemsData = [];
        foreach ($this->items as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) continue;
            $price = (float) $product->price;
            $qty = (int) $item['quantity'];
            $lineTotal = $price * $qty;
            $subtotal += $lineTotal;
            $itemsData[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'unit_price' => $price,
                'quantity' => $qty,
                'line_total' => $lineTotal,
            ];
        }

        $deliveryFee = $this->getDeliveryFee();
        $total = $subtotal + $deliveryFee;

        $order = Order::create([
            'order_number' => 'BOB-' . strtoupper(Str::random(8)),
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone ?: null,
            'fulfillment_type' => $this->fulfillment_type,
            'delivery_address' => $this->delivery_address ?: null,
            'delivery_zip' => $this->delivery_zip ?: null,
            'delivery_fee' => $deliveryFee,
            'requested_date' => $this->requested_date,
            'requested_time' => $this->requested_time ?: null,
            'notes' => $this->notes ?: null,
            'subtotal' => $subtotal,
            'total' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        foreach ($itemsData as $item) {
            $order->items()->create($item);
        }

        Notification::make()
            ->title('Order created: ' . $order->order_number)
            ->success()
            ->send();

        $this->redirect(\App\Filament\Resources\OrderResource::getUrl('view', ['record' => $order]));
    }
}
