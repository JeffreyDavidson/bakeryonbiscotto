<?php

namespace App\Filament\Pages;

use App\Models\Order;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
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
                Actions::make([
                    Action::make('submit')
                        ->label('🧾 Create Order')
                        ->submit('submit')
                        ->color('primary')
                        ->size('lg'),
                    Action::make('clear')
                        ->label('Clear Form')
                        ->color('gray')
                        ->size('lg')
                        ->action(fn () => $this->resetForm()),
                ])->alignEnd(),
            ]);
    }

    public function form(Schema $form): Schema
    {
        $products = Product::where('is_available', true)->orderBy('name')->get();
        $productOptions = $products->mapWithKeys(fn ($p) => [$p->id => $p->name])->toArray();
        $productPrices = $products->pluck('price', 'id')->toArray();

        // Build bundle flavor options: product_id => [flavor names]
        $bundleProducts = $products->where('is_bundle', true);
        $bundleFlavorOptions = [];
        foreach ($bundleProducts as $bp) {
            if ($bp->bundle_category_id) {
                $flavors = Product::where('category_id', $bp->bundle_category_id)
                    ->where('is_available', true)
                    ->where('is_bundle', false)
                    ->orderBy('name')
                    ->pluck('name')
                    ->toArray();
                $bundleFlavorOptions[$bp->id] = $flavors;
            }
        }
        $bundlePickCounts = $bundleProducts->pluck('bundle_pick_count', 'id')->toArray();

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
                            ,
                        TextInput::make('customer_email')
                            ->email()
                            ->required()
                            ->label('Email')
                            ->placeholder('jane@example.com')
                            ,
                        TextInput::make('customer_phone')
                            ->tel()
                            ->label('Phone')
                            ->placeholder('(555) 123-4567')
                            ,
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
                                    ->columnSpan(1)
                                    ->live(),
                                TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->minValue(1)
                                    ->label('Qty')
                                    ->columnSpan(1)
                                    ->live(),
                                Placeholder::make('unit_price')
                                    ->label('Price')
                                    ->columnSpan(1)
                                    ->content(function (Get $get) use ($productPrices) {
                                        $productId = $get('product_id');
                                        $price = $productPrices[$productId] ?? 0;
                                        return new \Illuminate\Support\HtmlString(
                                            '<div style="padding:0.5rem 0.75rem;background:#fdf8f2;border:1px solid #e8d0b0;border-radius:8px;color:#3d2314;font-weight:600;text-align:center;">$' . number_format($price, 2) . '</div>'
                                        );
                                    }),
                                Placeholder::make('line_total')
                                    ->label('Total')
                                    ->columnSpan(1)
                                    ->content(function (Get $get) use ($productPrices) {
                                        $productId = $get('product_id');
                                        $price = $productPrices[$productId] ?? 0;
                                        $qty = (int) ($get('quantity') ?: 1);
                                        $total = $price * $qty;
                                        return new \Illuminate\Support\HtmlString(
                                            '<div style="padding:0.5rem 0.75rem;background:linear-gradient(135deg,#3d2314,#6b4c3b);border-radius:8px;color:white;font-weight:700;text-align:center;font-size:1rem;">$' . number_format($total, 2) . '</div>'
                                        );
                                    }),
                                Placeholder::make('remove_btn')
                                    ->label("\u{200B}")
                                    ->columnSpan(1)
                                    ->content(new \Illuminate\Support\HtmlString(
                                        '<div style="display:flex;align-items:center;justify-content:center;height:100%;">'
                                        . '<button type="button" x-on:click="$wire.removeItem($el.closest(\'li[x-sortable-item]\').getAttribute(\'x-sortable-item\'))" style="background:none;border:none;cursor:pointer;color:#3d2314;transition:color 0.15s;padding:0;margin:0;display:flex;align-items:center;justify-content:center;" onmouseover="this.style.color=\'#c0392b\'" onmouseout="this.style.color=\'#3d2314\'">'
                                        . '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:1.25rem;height:1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>'
                                        . '</button></div>'
                                    )),
                                Placeholder::make('bundle_info')
                                    ->label('')
                                    ->columnSpanFull()
                                    ->visible(function (Get $get) use ($bundlePickCounts) {
                                        $productId = $get('product_id');
                                        return isset($bundlePickCounts[$productId]);
                                    })
                                    ->content(function (Get $get) use ($bundlePickCounts, $bundleFlavorOptions) {
                                        $productId = $get('product_id');
                                        $count = $bundlePickCounts[$productId] ?? 0;
                                        $selections = $get('selections') ?? [];
                                        $totalPicked = collect($selections)->sum('qty');
                                        $remaining = $count - $totalPicked;
                                        $pct = $count > 0 ? round(($totalPicked / $count) * 100) : 0;

                                        $bar = '<div style="background:#e8d0b0;border-radius:9999px;height:8px;margin:8px 0;overflow:hidden;">'
                                            . '<div style="background:#8b5e3c;height:100%;width:'.$pct.'%;transition:width 0.3s;border-radius:9999px;"></div>'
                                            . '</div>';

                                        $status = $totalPicked === $count
                                            ? '✅ All flavors selected!'
                                            : "🎁 Choose {$count} flavors — {$totalPicked} of {$count} selected";

                                        return new \Illuminate\Support\HtmlString($status . $bar);
                                    }),
                                Repeater::make('selections')
                                    ->label('Flavor Selections')
                                    ->columnSpanFull()
                                    ->visible(function (Get $get) use ($bundleFlavorOptions) {
                                        $productId = $get('product_id');
                                        return isset($bundleFlavorOptions[$productId]);
                                    })
                                    ->schema([
                                        Select::make('flavor')
                                            ->label('Flavor')
                                            ->options(function (Get $get) use ($bundleFlavorOptions) {
                                                // Navigate up to parent item's product_id
                                                $productId = $get('../../product_id');
                                                $flavors = $bundleFlavorOptions[$productId] ?? [];
                                                return array_combine($flavors, $flavors);
                                            })
                                            ->required()
                                            ->placeholder('Pick a flavor...')
                                            ->columnSpan(2),
                                        TextInput::make('qty')
                                            ->label('Qty')
                                            ->numeric()
                                            ->default(1)
                                            ->minValue(1)
                                            ->required()
                                            ->columnSpan(1)
                                            ->live(),
                                    ])
                                    ->columns(3)
                                    ->defaultItems(0)
                                    ->addActionLabel('+ Add Flavor')
                                    ->addAction(function (\Filament\Actions\Action $action) use ($bundlePickCounts) {
                                        return $action->hidden(function (Repeater $component) use ($bundlePickCounts): bool {
                                            // Walk up to the parent items repeater to get this item's product_id
                                            $itemState = $component->getContainer()->getRawState();
                                            $productId = $itemState['product_id'] ?? null;
                                            $maxPicks = $bundlePickCounts[$productId] ?? 0;
                                            if ($maxPicks === 0) return false;

                                            $selections = $itemState['selections'] ?? [];
                                            $totalPicked = collect($selections)->sum(fn ($sel) => (int) ($sel['qty'] ?? 1));

                                            return $totalPicked >= $maxPicks;
                                        });
                                    })
                                    ->reorderable(false)
                                    ->live(),
                            ])
                            ->columns(5)
                            ->defaultItems(1)
                            ->deleteAction(fn (\Filament\Actions\Action $action) => $action->hidden())
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
                            ->native(true)
                            ->minDate(now())
                            ->live(),
                        Select::make('requested_time')
                            ->label('Time Slot')
                            ->options(function (Get $get) {
                                $date = $get('requested_date');
                                if (!$date) return [];

                                $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeek;

                                // Same schedule as storefront: 0=Sun, 1=Mon, etc.
                                $scheduleByDay = [
                                    0 => ['start' => 10, 'end' => 19], // Sunday 10am-7pm
                                    1 => ['start' => 12, 'end' => 19], // Monday 12pm-7pm
                                    2 => ['start' => 12, 'end' => 19], // Tuesday 12pm-7pm
                                    3 => ['start' => 10, 'end' => 19], // Wednesday 10am-7pm
                                    4 => ['start' => 10, 'end' => 16], // Thursday 10am-4pm
                                    5 => ['start' => 10, 'end' => 19], // Friday 10am-7pm
                                    6 => ['start' => 14, 'end' => 19], // Saturday 2pm-7pm
                                ];

                                $schedule = $scheduleByDay[$dayOfWeek] ?? null;
                                if (!$schedule) return [];

                                $slots = [];
                                for ($h = $schedule['start']; $h < $schedule['end']; $h++) {
                                    $value = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
                                    $label = ($h > 12 ? ($h - 12) : $h) . ':00 ' . ($h >= 12 ? 'PM' : 'AM');
                                    $slots[$value] = $label;
                                }

                                return $slots;
                            })
                            ->placeholder('Select a time...')
                            ->disabled(fn (Get $get) => !$get('requested_date')),
                        ViewField::make('delivery_address')
                            ->label('Delivery Address')
                            ->view('forms.components.address-autocomplete')
                            ->columnSpan(2)
                            ->visible(fn (Get $get) => $get('fulfillment_type') === 'delivery'),
                        TextInput::make('delivery_zip')
                            ->label('Zip Code')
                            ->placeholder('33837')
                            ->columnSpan(1)
                            ->visible(fn (Get $get) => $get('fulfillment_type') === 'delivery')
                            ->readOnly(),
                    ]),

                Section::make('Payment')
                    ->description('How is this order being paid?')
                    ->icon('heroicon-o-credit-card')
                    ->columns(3)
                    ->components([
                        Select::make('payment_method')
                            ->label('Payment Method')
                            ->options([
                                'cash' => '💵 Cash',
                                'paypal' => '🅿️ PayPal',
                            ])
                            ->required()
                            ->live()
                            ->selectablePlaceholder(false)
                            ->default('cash'),
                        Placeholder::make('payment_deadline_display')
                            ->label('Payment Deadline')
                            ->visible(fn (Get $get) => $get('payment_method') === 'paypal' && $get('requested_date'))
                            ->content(function (Get $get) {
                                $date = \Carbon\Carbon::parse($get('requested_date'))->subDays(2);
                                return new \Illuminate\Support\HtmlString(
                                    '<div style="padding:0.5rem 0.75rem;background:#fdf8f2;border:1px solid #e8d0b0;border-radius:8px;color:#3d2314;font-weight:600;">'
                                    . '📅 Must be paid by ' . $date->format('M j, Y')
                                    . '</div>'
                                );
                            }),
                        Placeholder::make('cash_note')
                            ->label('')
                            ->visible(fn (Get $get) => $get('payment_method') === 'cash')
                            ->content(new \Illuminate\Support\HtmlString(
                                '<div style="padding:0.5rem 0.75rem;background:#d4edda;border:1px solid #c3e6cb;border-radius:8px;color:#155724;font-weight:500;">'
                                . '✅ Cash payment — will be marked as paid on creation'
                                . '</div>'
                            )),
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

    /**
     * Convert nested selections [{flavor: 'Chocolate Chip', qty: 2}, ...] 
     * to flat array ['Chocolate Chip', 'Chocolate Chip', ...] matching storefront format.
     */
    private function flattenSelections(array $selections): ?array
    {
        if (empty($selections)) return null;

        $flat = [];
        foreach ($selections as $sel) {
            $flavor = $sel['flavor'] ?? null;
            $qty = (int) ($sel['qty'] ?? 1);
            if ($flavor) {
                for ($i = 0; $i < $qty; $i++) {
                    $flat[] = $flavor;
                }
            }
        }

        return empty($flat) ? null : $flat;
    }

    public function removeItem(string $itemKey): void
    {
        $items = $this->data['items'] ?? [];
        unset($items[$itemKey]);
        $this->data['items'] = array_values($items);
    }

    public function resetForm(): void
    {
        $this->data = [];
        $this->form->fill();
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        // Validate bundle selections
        foreach ($data['items'] as $idx => $item) {
            $product = Product::find($item['product_id']);
            if ($product && $product->is_bundle && $product->bundle_pick_count) {
                $totalPicked = collect($item['selections'] ?? [])->sum(fn ($sel) => (int) ($sel['qty'] ?? 1));
                if ($totalPicked !== $product->bundle_pick_count) {
                    Notification::make()
                        ->title("{$product->name} requires exactly {$product->bundle_pick_count} flavors (you selected {$totalPicked})")
                        ->danger()
                        ->send();
                    return;
                }
            }
        }

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
                'selections' => $this->flattenSelections($item['selections'] ?? []),
            ];
        }

        $deliveryFee = $data['fulfillment_type'] === 'delivery' ? 5.00 : 0;
        $total = $subtotal + $deliveryFee;

        $paymentMethod = $data['payment_method'] ?? 'cash';
        $isCash = $paymentMethod === 'cash';

        $orderData = [
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
            'payment_method' => $paymentMethod,
            'payment_status' => $isCash ? 'paid' : 'unpaid',
            'paid_at' => $isCash ? now() : null,
            'payment_deadline' => !$isCash ? \Carbon\Carbon::parse($data['requested_date'])->subDays(2)->toDateString() : null,
        ];

        $order = Order::create($orderData);

        foreach ($itemsData as $item) {
            $order->items()->create($item);
        }

        // Send PayPal invoice if payment method is PayPal
        if ($paymentMethod === 'paypal') {
            try {
                $order->load('items');
                $paypalService = app(\App\Services\PayPalService::class);
                $invoiceResult = $paypalService->createAndSendInvoice($order);

                Notification::make()
                    ->title('PayPal invoice sent to ' . $data['customer_email'])
                    ->success()
                    ->send();
            } catch (\Exception $e) {
                \Log::error('PayPal invoice error', ['error' => $e->getMessage(), 'order' => $order->order_number]);
                Notification::make()
                    ->title('Order created but PayPal invoice failed: ' . $e->getMessage())
                    ->warning()
                    ->send();
            }
        }

        Notification::make()
            ->title('Order created: ' . $order->order_number)
            ->success()
            ->send();

        $this->redirect(\App\Filament\Resources\OrderResource::getUrl('view', ['record' => $order]));
    }
}
