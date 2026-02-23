<?php

namespace App\Filament\Pages;

use App\Models\Order;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class QuickOrder extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-plus-circle';
    protected static ?string $navigationLabel = 'Quick Order';
    protected static ?int $navigationSort = 10;

    public ?array $data = [];

    public static function getNavigationGroup(): ?string
    {
        return 'Shop';
    }

    public function mount(): void
    {
        $this->form->fill([
            'fulfillment_type' => 'pickup',
            'items' => [['product_id' => null, 'quantity' => 1]],
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
        return '🧁 Quick Order';
    }

    public function getSubheading(): ?string
    {
        return 'Create an order on behalf of a customer';
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([EmbeddedSchema::make('form')])
                    ->id('form')
                    ->livewireSubmitHandler('submit'),
            ]);
    }

    public function form(Schema $form): Schema
    {
        $products = Product::where('is_available', true)->orderBy('name')->get();
        $productOptions = $products->mapWithKeys(fn ($p) => [$p->id => "{$p->name} — \${$p->price}"])->toArray();

        return $form
            ->schema([
                Section::make('Customer Information')
                    ->description('Who is this order for?')
                    ->icon('heroicon-o-user')
                    ->columns(3)
                    ->components([
                        TextInput::make('customer_name')
                            ->required()
                            ->label('Name')
                            ->placeholder('Jane Smith')
                            ->prefixIcon('heroicon-o-user'),
                        TextInput::make('customer_email')
                            ->email()
                            ->required()
                            ->label('Email')
                            ->placeholder('jane@example.com')
                            ->prefixIcon('heroicon-o-envelope'),
                        TextInput::make('customer_phone')
                            ->tel()
                            ->label('Phone')
                            ->placeholder('(555) 123-4567')
                            ->prefixIcon('heroicon-o-phone'),
                    ]),

                Section::make('Order Items')
                    ->description('Add products and quantities')
                    ->icon('heroicon-o-shopping-cart')
                    ->components([
                        Repeater::make('items')
                            ->label('')
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->options($productOptions)
                                    ->required()
                                    ->placeholder('Choose a product...')
                                    ->columnSpan(2)
                                    ->live(),
                                TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->minValue(1)
                                    ->label('Qty')
                                    ->columnSpan(1),
                            ])
                            ->columns(3)
                            ->defaultItems(1)
                            ->addActionLabel('+ Add Another Product')
                            ->addAction(function (\Filament\Actions\Action $action) {
                                return $action->disabled(function (Repeater $component): bool {
                                    foreach ($component->getRawState() ?? [] as $item) {
                                        if (empty($item['product_id'])) {
                                            return true;
                                        }
                                    }
                                    return false;
                                });
                            })
                            ->reorderable(false)
                            ->minItems(1),
                    ]),

                Section::make('Fulfillment Details')
                    ->description('When and how should this order be fulfilled?')
                    ->icon('heroicon-o-truck')
                    ->columns(3)
                    ->components([
                        Select::make('fulfillment_type')
                            ->label('Fulfillment Type')
                            ->options([
                                'pickup' => '📦 Pickup',
                                'delivery' => '🚚 Delivery',
                            ])
                            ->required()
                            ->native(false)
                            ->live()
                            ->selectablePlaceholder(false),
                        DatePicker::make('requested_date')
                            ->label('Requested Date')
                            ->required()
                            ->native(false)
                            ->minDate(now())
                            ->prefixIcon('heroicon-o-calendar'),
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
                            ])
                            ->placeholder('Select a time...'),
                        TextInput::make('delivery_address')
                            ->label('Delivery Address')
                            ->placeholder('123 Main St, Davenport, FL')
                            ->prefixIcon('heroicon-o-map-pin')
                            ->columnSpan(2)
                            ->visible(fn (Get $get) => $get('fulfillment_type') === 'delivery'),
                        TextInput::make('delivery_zip')
                            ->label('Zip Code')
                            ->placeholder('33837')
                            ->columnSpan(1)
                            ->visible(fn (Get $get) => $get('fulfillment_type') === 'delivery'),
                    ]),

                Section::make('Special Instructions')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->collapsed()
                    ->components([
                        Textarea::make('notes')
                            ->rows(3)
                            ->label('')
                            ->placeholder('Allergies, special requests, decorations, etc.'),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('submit')
                ->label('🧾 Create Order')
                ->submit('submit'),
        ];
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
