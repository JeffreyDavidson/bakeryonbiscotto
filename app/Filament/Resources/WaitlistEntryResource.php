<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaitlistEntryResource\Pages;
use App\Mail\WaitlistSpotAvailable;
use App\Models\WaitlistEntry;
use BackedEnum;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Mail;

class WaitlistEntryResource extends Resource
{
    protected static ?string $model = WaitlistEntry::class;

    protected static ?string $navigationLabel = 'Waitlist';

    protected static ?int $navigationSort = 5;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-queue-list';
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'Shop';
    }

    public static function getNavigationBadge(): ?string
    {
        $count = WaitlistEntry::waiting()
            ->where('requested_date', '>=', now()->toDateString())
            ->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Waitlist')
            ->columns([
                TextColumn::make('requested_date')
                    ->label('Date')
                    ->date('M j, Y')
                    ->sortable(),
                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer_email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('product_interest')
                    ->label('Interested In')
                    ->limit(40)
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'waiting' => 'warning',
                        'notified' => 'info',
                        'converted' => 'success',
                        'expired' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Signed Up')
                    ->dateTime('M j, g:i A')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('requested_date', 'asc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'waiting' => 'Waiting',
                        'notified' => 'Notified',
                        'converted' => 'Converted',
                        'expired' => 'Expired',
                    ]),
                \Filament\Tables\Filters\Filter::make('date_range')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')->label('From'),
                        \Filament\Forms\Components\DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
                        return $query
                            ->when($data['from'] ?? null, fn ($q, $date) => $q->whereDate('requested_date', '>=', $date))
                            ->when($data['until'] ?? null, fn ($q, $date) => $q->whereDate('requested_date', '<=', $date));
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) $indicators[] = 'From ' . \Carbon\Carbon::parse($data['from'])->format('M j, Y');
                        if ($data['until'] ?? null) $indicators[] = 'Until ' . \Carbon\Carbon::parse($data['until'])->format('M j, Y');
                        return $indicators;
                    }),
            ])
            ->actions([
                Actions\Action::make('notify')
                    ->label('Notify')
                    ->icon('heroicon-o-bell')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Notify Customer')
                    ->modalDescription(fn (WaitlistEntry $record) => "Send an email to {$record->customer_name} ({$record->customer_email}) that a spot opened up for {$record->requested_date->format('M j, Y')}?")
                    ->action(function (WaitlistEntry $record) {
                        Mail::to($record->customer_email)->send(new WaitlistSpotAvailable($record));
                        $record->markNotified();
                        Notification::make()
                            ->title('Notification sent!')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (WaitlistEntry $record) => $record->status === 'waiting'),
                Actions\Action::make('convert')
                    ->label('Convert')
                    ->icon('heroicon-o-arrow-right-circle')
                    ->color('success')
                    ->url(fn (WaitlistEntry $record) => route('filament.admin.pages.quick-order', [
                        'customer_name' => $record->customer_name,
                        'customer_email' => $record->customer_email,
                        'customer_phone' => $record->customer_phone,
                        'requested_date' => $record->requested_date->format('Y-m-d'),
                    ]))
                    ->after(fn (WaitlistEntry $record) => $record->markConverted())
                    ->visible(fn (WaitlistEntry $record) => in_array($record->status, ['waiting', 'notified'])),
                Actions\Action::make('remove')
                    ->label('Remove')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (WaitlistEntry $record) => $record->delete()),
            ])
            ->emptyStateHeading("No one on the waitlist — capacity is looking good!")
            ->emptyStateIcon('heroicon-o-queue-list');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWaitlistEntries::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
