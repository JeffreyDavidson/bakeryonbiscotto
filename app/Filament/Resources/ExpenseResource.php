<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Models\Expense;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationLabel = 'Expenses';

    protected static ?int $navigationSort = 1;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-arrow-trending-down';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Finances';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Expense Details')
                ->icon('heroicon-o-banknotes')
                ->columns(2)
                ->components([
                    \Filament\Forms\Components\TextInput::make('description')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('e.g. Flour, sugar, butter from Publix')
                        ->prefixIcon('heroicon-o-document-text')
                        ->columnSpanFull(),
                    \Filament\Forms\Components\Select::make('category')
                        ->options(Expense::CATEGORIES)
                        ->required()
                        ->searchable()
                        ->prefixIcon('heroicon-o-folder'),
                    \Filament\Forms\Components\TextInput::make('vendor')
                        ->maxLength(255)
                        ->placeholder('e.g. Publix, Amazon, Costco')
                        ->prefixIcon('heroicon-o-building-storefront'),
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
                    \Filament\Forms\Components\TextInput::make('business_percentage')
                        ->label('Business Use %')
                        ->numeric()
                        ->default(100)
                        ->minValue(1)
                        ->maxValue(100)
                        ->suffix('%')
                        ->helperText('100% = fully business. Lower for shared purchases.'),
                    \Filament\Forms\Components\FileUpload::make('receipt')
                        ->image()
                        ->disk('public')
                        ->directory('receipts')
                        ->visibility('public')
                        ->helperText('Optional — snap a photo of the receipt'),
                ]),

            \Filament\Schemas\Components\Section::make('Additional')
                ->icon('heroicon-o-cog-6-tooth')
                ->columns(2)
                ->components([
                    \Filament\Forms\Components\Toggle::make('is_recurring')
                        ->label('Recurring expense')
                        ->live(),
                    \Filament\Forms\Components\Select::make('recurring_frequency')
                        ->options([
                            'weekly' => 'Weekly',
                            'monthly' => 'Monthly',
                            'quarterly' => 'Quarterly',
                            'yearly' => 'Yearly',
                        ])
                        ->visible(fn ($get) => $get('is_recurring'))
                        ->prefixIcon('heroicon-o-arrow-path'),
                    \Filament\Forms\Components\Textarea::make('notes')
                        ->rows(2)
                        ->placeholder('Any additional notes...')
                        ->columnSpanFull(),
                ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date('M j, Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->formatStateUsing(fn (string $state) => Expense::CATEGORIES[$state] ?? ucfirst($state))
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'ingredients', 'packaging' => 'warning',
                        'delivery_gas' => 'info',
                        'marketing' => 'primary',
                        'booth_fees' => 'success',
                        'education' => 'info',
                        default => 'gray',
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('vendor')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Total')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('business_percentage')
                    ->label('Biz %')
                    ->formatStateUsing(fn ($state) => $state . '%')
                    ->color(fn ($state) => $state < 100 ? 'warning' : 'gray')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('deductible_amount')
                    ->label('Deductible')
                    ->money('usd')
                    ->getStateUsing(fn ($record) => $record->deductible_amount)
                    ->color(fn ($record) => $record->business_percentage < 100 ? 'success' : null)
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_recurring')
                    ->label('Recurring')
                    ->boolean()
                    ->trueIcon('heroicon-o-arrow-path')
                    ->trueColor('info')
                    ->falseIcon('')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('receipt')
                    ->label('Receipt')
                    ->boolean()
                    ->getStateUsing(fn ($record) => !empty($record->receipt))
                    ->trueIcon('heroicon-o-camera')
                    ->trueColor('success')
                    ->falseIcon('')
                    ->toggleable(),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options(Expense::CATEGORIES)
                    ->multiple(),
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
                Tables\Filters\TernaryFilter::make('is_recurring')
                    ->label('Recurring'),
            ])
            ->actions([
                EditAction::make()->slideOver()->modalWidth('2xl'),
            ])
            ->bulkActions([])
            ->emptyStateHeading('No expenses recorded')
            ->emptyStateDescription('Track your bakery expenses here for easy tax time. 💰')
            ->emptyStateIcon('heroicon-o-banknotes');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenses::route('/'),
        ];
    }
}
