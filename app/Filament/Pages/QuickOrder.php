<?php

namespace App\Filament\Pages;

use App\Models\Order;
use App\Models\OrderItem;
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

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'fulfillment_type' => 'pickup',
            'items' => [[]],
        ]);
    }

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

    public function form(Schema $form): Schema
    {
        $products = Product::where('is_available', true)->orderBy('name')->get();
        $productOptions = $products->mapWithKeys(fn ($p) => [$p->id => "{$p->name} (\${$p->price})"])->toArray();
        return $form
            ->schema([
                Section::make('Customer Information')
                    ->icon('heroicon-o-user')
                    ->components([
                        TextInput::make('customer_name')->required()->label('Name'),
                        TextInput::make('customer_email')->email()->required()->label('Email'),
                        TextInput::make('customer_phone')->tel()->label('Phone'),
                    ]),

                Section::make('Order Items')
                    ->icon('heroicon-o-shopping-cart')
                    ->components([
                        Repeater::make('items')
                            ->label('')
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->options($productOptions)
                                    ->required()
                                    ->placeholder('Select a product'),
                                TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->minValue(1),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->addActionLabel('Add Product')
                            ->minItems(1),
                    ]),

                Section::make('Fulfillment')
                    ->icon('heroicon-o-truck')
                    ->components([
                        Select::make('fulfillment_type')
                            ->options([
                                'pickup' => 'Pickup',
                                'delivery' => 'Delivery',
                            ])
                            ->required()
                            ->live(),
                        DatePicker::make('requested_date')
                            ->required()
                            ->native(false)
                            ->minDate(now()),
                        Select::make('requested_time')
                            ->label('Time Slot')
                            ->options([
                                '09:00' => '9:00 AM',
                                '10:00' => '10:00 AM',
                                '11:00' => '11:00 AM',
                                '12:00' => '12:00 PM',
                                '13:00' => '1:00 PM',
                                '14:00' => '2:00 PM',
                                '15:00' => '3:00 PM',
                                '16:00' => '4:00 PM',
                                '17:00' => '5:00 PM',
                            ]),
                        TextInput::make('delivery_address')
                            ->label('Delivery Address')
                            ->visible(fn (Get $get) => $get('fulfillment_type') === 'delivery'),
                        TextInput::make('delivery_zip')
                            ->label('Zip Code')
                            ->visible(fn (Get $get) => $get('fulfillment_type') === 'delivery'),
                    ]),

                Section::make('Notes')
                    ->components([
                        Textarea::make('notes')->rows(3)->label(''),
                    ])->collapsible(),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        $subtotal = 0;
        $itemsData = [];
        foreach ($data['items'] as $item) {
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

        $deliveryFee = $data['fulfillment_type'] === 'delivery' ? 5.00 : 0;
        $total = $subtotal + $deliveryFee;

        $order = Order::create([
            'order_number' => 'BOB-' . strtoupper(Str::random(8)),
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'] ?? null,
            'fulfillment_type' => $data['fulfillment_type'],
            'delivery_address' => $data['delivery_address'] ?? null,
            'delivery_zip' => $data['delivery_zip'] ?? null,
            'delivery_fee' => $deliveryFee,
            'requested_date' => $data['requested_date'],
            'requested_time' => $data['requested_time'] ?? null,
            'notes' => $data['notes'] ?? null,
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
