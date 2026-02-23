<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Settings extends Page
{

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Settings';
    protected static string|\UnitEnum|null $navigationGroup = 'Admin';
    protected static ?int $navigationSort = 99;
    protected string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            // Store Information
            'business_name' => Setting::get('business_name', 'Bakery on Biscotto'),
            'tagline' => Setting::get('tagline', ''),
            'store_phone' => Setting::get('store_phone', ''),
            'store_email' => Setting::get('store_email', ''),
            'store_address' => Setting::get('store_address', ''),
            'operating_hours' => Setting::get('operating_hours', ''),
            'social_instagram' => Setting::get('social_instagram', ''),
            'social_facebook' => Setting::get('social_facebook', ''),
            'social_tiktok' => Setting::get('social_tiktok', ''),

            // Order Settings
            'minimum_order_amount' => Setting::get('minimum_order_amount', '0'),
            'max_advance_order_days' => Setting::get('max_advance_order_days', '14'),
            'default_prep_time_hours' => Setting::get('default_prep_time_hours', '24'),
            'auto_confirm_orders' => Setting::get('auto_confirm_orders', '0') === '1',

            // Delivery Settings
            'delivery_enabled' => Setting::get('delivery_enabled', '1') === '1',
            'delivery_radius_miles' => Setting::get('delivery_radius_miles', '10'),
            'delivery_fee_tiers' => Setting::get('delivery_fee_tiers', '0-5:5.00,5-10:8.00,10+:12.00'),
            'free_delivery_minimum' => Setting::get('free_delivery_minimum', '50'),

            // Notification Settings
            'send_order_emails' => Setting::get('send_order_emails', '1') === '1',
            'send_review_followup_emails' => Setting::get('send_review_followup_emails', '1') === '1',
            'admin_notification_email' => Setting::get('admin_notification_email', ''),
        ]);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Store Information')
                    ->description('Basic business details displayed to customers.')
                    ->schema([
                        TextInput::make('business_name')
                            ->label('Business Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('tagline')
                            ->label('Tagline')
                            ->maxLength(255)
                            ->placeholder('e.g. Freshly baked with love'),
                        TextInput::make('store_phone')
                            ->label('Phone')
                            ->tel()
                            ->maxLength(50),
                        TextInput::make('store_email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        Textarea::make('store_address')
                            ->label('Address')
                            ->rows(2)
                            ->maxLength(500),
                        Textarea::make('operating_hours')
                            ->label('Operating Hours')
                            ->rows(3)
                            ->placeholder("Mon-Fri: 7am - 6pm\nSat: 8am - 4pm\nSun: Closed")
                            ->helperText('Displayed to customers as-is.'),
                        TextInput::make('social_instagram')
                            ->label('Instagram URL')
                            ->url()
                            ->maxLength(255)
                            ->prefix('🔗'),
                        TextInput::make('social_facebook')
                            ->label('Facebook URL')
                            ->url()
                            ->maxLength(255)
                            ->prefix('🔗'),
                        TextInput::make('social_tiktok')
                            ->label('TikTok URL')
                            ->url()
                            ->maxLength(255)
                            ->prefix('🔗'),
                    ])
                    ->columns(2),

                Section::make('Order Settings')
                    ->description('Configure order constraints and behavior.')
                    ->schema([
                        TextInput::make('minimum_order_amount')
                            ->label('Minimum Order Amount ($)')
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01)
                            ->prefix('$'),
                        TextInput::make('max_advance_order_days')
                            ->label('Max Advance Order Days')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(365)
                            ->helperText('How far ahead customers can place orders.'),
                        TextInput::make('default_prep_time_hours')
                            ->label('Default Prep Time (hours)')
                            ->numeric()
                            ->minValue(1)
                            ->suffix('hours'),
                        Toggle::make('auto_confirm_orders')
                            ->label('Auto-confirm orders')
                            ->helperText('When enabled, new orders are automatically confirmed. When disabled, orders require manual confirmation.'),
                    ])
                    ->columns(2),

                Section::make('Delivery Settings')
                    ->description('Configure delivery options and fees.')
                    ->schema([
                        Toggle::make('delivery_enabled')
                            ->label('Delivery Enabled')
                            ->helperText('Enable or disable delivery option for customers.'),
                        TextInput::make('delivery_radius_miles')
                            ->label('Delivery Radius')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('miles'),
                        Textarea::make('delivery_fee_tiers')
                            ->label('Delivery Fee Tiers')
                            ->rows(3)
                            ->helperText('Format: range:fee per line. e.g. 0-5:5.00,5-10:8.00,10+:12.00')
                            ->placeholder('0-5:5.00,5-10:8.00,10+:12.00'),
                        TextInput::make('free_delivery_minimum')
                            ->label('Free Delivery Minimum Order ($)')
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01)
                            ->prefix('$')
                            ->helperText('Orders above this amount get free delivery. Set to 0 to disable.'),
                    ])
                    ->columns(2),

                Section::make('Notification Settings')
                    ->description('Configure email notifications.')
                    ->schema([
                        Toggle::make('send_order_emails')
                            ->label('Send order status emails')
                            ->helperText('Customers receive email notifications when their order status changes.'),
                        Toggle::make('send_review_followup_emails')
                            ->label('Send review follow-up emails')
                            ->helperText('Send customers a follow-up email asking for a review after order completion.'),
                        TextInput::make('admin_notification_email')
                            ->label('Admin Notification Email')
                            ->email()
                            ->maxLength(255)
                            ->helperText('New order alerts are sent to this address.'),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Store Information
        Setting::set('business_name', $data['business_name'] ?? '');
        Setting::set('tagline', $data['tagline'] ?? '');
        Setting::set('store_phone', $data['store_phone'] ?? '');
        Setting::set('store_email', $data['store_email'] ?? '');
        Setting::set('store_address', $data['store_address'] ?? '');
        Setting::set('operating_hours', $data['operating_hours'] ?? '');
        Setting::set('social_instagram', $data['social_instagram'] ?? '');
        Setting::set('social_facebook', $data['social_facebook'] ?? '');
        Setting::set('social_tiktok', $data['social_tiktok'] ?? '');

        // Order Settings
        Setting::set('minimum_order_amount', $data['minimum_order_amount'] ?? '0');
        Setting::set('max_advance_order_days', $data['max_advance_order_days'] ?? '14');
        Setting::set('default_prep_time_hours', $data['default_prep_time_hours'] ?? '24');
        Setting::set('auto_confirm_orders', ($data['auto_confirm_orders'] ?? false) ? '1' : '0');

        // Delivery Settings
        Setting::set('delivery_enabled', ($data['delivery_enabled'] ?? true) ? '1' : '0');
        Setting::set('delivery_radius_miles', $data['delivery_radius_miles'] ?? '10');
        Setting::set('delivery_fee_tiers', $data['delivery_fee_tiers'] ?? '');
        Setting::set('free_delivery_minimum', $data['free_delivery_minimum'] ?? '50');

        // Notification Settings
        Setting::set('send_order_emails', ($data['send_order_emails'] ?? true) ? '1' : '0');
        Setting::set('send_review_followup_emails', ($data['send_review_followup_emails'] ?? true) ? '1' : '0');
        Setting::set('admin_notification_email', $data['admin_notification_email'] ?? '');

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Save Settings')
                ->action('save')
                ->icon('heroicon-o-check'),
        ];
    }
}
