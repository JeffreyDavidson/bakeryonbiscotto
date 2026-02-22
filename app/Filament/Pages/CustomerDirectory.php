<?php

namespace App\Filament\Pages;

use App\Models\Order;
use App\Models\OrderItem;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedTable;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class CustomerDirectory extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Customers';

    protected static ?string $title = 'Customer Directory';

    protected static ?int $navigationSort = 4;

    protected string $view = 'filament.pages.customer-directory';

    public static function getNavigationGroup(): ?string
    {
        return 'Shop';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->select([
                        'customer_email',
                        DB::raw('MAX(id) as id'),
                        DB::raw('(SELECT o2.customer_name FROM orders o2 WHERE o2.customer_email = orders.customer_email ORDER BY o2.id DESC LIMIT 1) as customer_name'),
                        DB::raw('(SELECT o2.customer_phone FROM orders o2 WHERE o2.customer_email = orders.customer_email ORDER BY o2.id DESC LIMIT 1) as customer_phone'),
                        DB::raw('COUNT(*) as orders_count'),
                        DB::raw('SUM(total) as total_spent'),
                        DB::raw('MAX(created_at) as last_order_date'),
                    ])
                    ->groupBy('customer_email')
            )
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Name')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->having('customer_name', 'like', "%{$search}%");
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('customer_name', $direction);
                    }),
                TextColumn::make('customer_email')
                    ->label('Email')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->having('customer_email', 'like', "%{$search}%");
                    })
                    ->copyable(),
                TextColumn::make('customer_phone')
                    ->label('Phone')
                    ->placeholder('—'),
                TextColumn::make('orders_count')
                    ->label('Orders')
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('orders_count', $direction);
                    })
                    ->badge(),
                TextColumn::make('total_spent')
                    ->label('Total Spent')
                    ->money('USD')
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('total_spent', $direction);
                    }),
                TextColumn::make('last_order_date')
                    ->label('Last Order')
                    ->dateTime('M j, Y')
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('last_order_date', $direction);
                    }),
                TextColumn::make('favorite_item')
                    ->label('Favorite Item')
                    ->getStateUsing(function ($record) {
                        return OrderItem::query()
                            ->join('orders', 'orders.id', '=', 'order_items.order_id')
                            ->where('orders.customer_email', $record->customer_email)
                            ->select('order_items.product_name', DB::raw('SUM(order_items.quantity) as total_qty'))
                            ->groupBy('order_items.product_name')
                            ->orderByDesc('total_qty')
                            ->value('product_name');
                    })
                    ->placeholder('—'),
            ])
            ->recordKey('customer_email')
            ->defaultSort('last_order_date', 'desc')
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->modalHeading(fn ($record) => $record->customer_name)
                    ->modalContent(fn ($record) => view('filament.pages.customer-detail', [
                        'customer' => $record,
                        'orders' => Order::where('customer_email', $record->customer_email)
                            ->with('items')
                            ->orderByDesc('created_at')
                            ->get(),
                        'stats' => Order::where('customer_email', $record->customer_email)
                            ->select([
                                DB::raw('AVG(total) as avg_order_value'),
                                DB::raw('MIN(created_at) as first_order_date'),
                            ])
                            ->first(),
                    ]))
                    ->modalWidth('4xl')
                    ->slideOver(),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            EmbeddedTable::make(),
        ]);
    }
}
