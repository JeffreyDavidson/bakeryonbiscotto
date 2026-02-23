<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeResource\Pages;
use App\Models\Income;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;

    protected static ?string $navigationLabel = 'Other Income';

    protected static ?int $navigationSort = 2;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-arrow-trending-up';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Finances';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            \Filament\Schemas\Components\Section::make('Income Details')
                ->icon('heroicon-o-banknotes')
                ->description('Revenue from non-order sources')
                ->columns(2)
                ->columnSpanFull()
                ->components([
                    \Filament\Forms\Components\TextInput::make('description')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('e.g. Farmers market booth sales')
                        ->prefixIcon('heroicon-o-document-text')
                        ->columnSpanFull(),
                    \Filament\Forms\Components\Select::make('source')
                        ->options(Income::SOURCES)
                        ->required()
                        ->searchable()
                        ->prefixIcon('heroicon-o-arrow-trending-up')
                        ->helperText('Where did this revenue come from?'),
                    \Filament\Forms\Components\TextInput::make('amount')
                        ->required()
                        ->numeric()
                        ->prefix('$')
                        ->step('0.01')
                        ->placeholder('0.00'),
                    \Filament\Forms\Components\DatePicker::make('date')
                        ->required()
                        ->default(now())
                        ->prefixIcon('heroicon-o-calendar'),
                ]),

            \Filament\Schemas\Components\Section::make('Notes')
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->description('Additional details')
                ->columnSpanFull()
                ->components([
                    \Filament\Forms\Components\Textarea::make('notes')
                        ->rows(3)
                        ->placeholder('Any additional notes about this income...')
                        ->label(''),
                ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading("💵 Other Income")
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date('M j, Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('source')
                    ->formatStateUsing(fn (string $state) => Income::SOURCES[$state] ?? ucfirst($state))
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'farmers_market' => 'success',
                        'cash_sale' => 'warning',
                        'custom_order' => 'info',
                        'paypal_direct' => 'primary',
                        default => 'gray',
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('amount')
                    ->money('usd')
                    ->sortable(),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('source')
                    ->options(Income::SOURCES),
                Tables\Filters\Filter::make('date_range')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')->label('From'),
                        \Filament\Forms\Components\DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
                        return $query
                            ->when($data['from'] ?? null, fn ($q, $date) => $q->whereDate('date', '>=', $date))
                            ->when($data['until'] ?? null, fn ($q, $date) => $q->whereDate('date', '<=', $date));
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) $indicators[] = 'From ' . \Carbon\Carbon::parse($data['from'])->format('M j, Y');
                        if ($data['until'] ?? null) $indicators[] = 'Until ' . \Carbon\Carbon::parse($data['until'])->format('M j, Y');
                        return $indicators;
                    }),
            ])
            ->actions([
                EditAction::make()->slideOver()->modalWidth('2xl'),
            ])
            ->bulkActions([])
            ->emptyStateHeading('No other income recorded')
            ->emptyStateDescription('Log farmers market sales, cash orders, and other non-website revenue here. 🏪')
            ->emptyStateIcon('heroicon-o-arrow-trending-up');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIncomes::route('/'),
        ];
    }
}
