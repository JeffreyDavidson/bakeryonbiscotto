<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
            'owner_name' => Setting::get('owner_name', 'Cassie'),
            'store_city' => Setting::get('store_city', 'Davenport'),
            'store_state' => Setting::get('store_state', 'FL'),
            'store_state_full' => Setting::get('store_state_full', 'Florida'),
            'store_timezone' => Setting::get('store_timezone', 'America/New_York'),

            // Branding
            'brand_color_900' => Setting::get('brand_color_900', '#3d2314'),
            'brand_color_800' => Setting::get('brand_color_800', '#4a3225'),
            'brand_color_700' => Setting::get('brand_color_700', '#6b4c3b'),
            'brand_color_600' => Setting::get('brand_color_600', '#8b5e3c'),
            'brand_color_500' => Setting::get('brand_color_500', '#a08060'),
            'brand_color_400' => Setting::get('brand_color_400', '#c4a882'),
            'brand_color_300' => Setting::get('brand_color_300', '#d4a574'),
            'brand_color_200' => Setting::get('brand_color_200', '#e8d0b0'),
            'brand_color_150' => Setting::get('brand_color_150', '#f3ebe0'),
            'brand_color_100' => Setting::get('brand_color_100', '#f5e6d0'),
            'brand_color_50' => Setting::get('brand_color_50', '#fdf8f2'),
            'store_logo' => Setting::get('store_logo', ''),
            'store_favicon' => Setting::get('store_favicon', ''),

            // Compliance
            'revenue_cap' => Setting::get('revenue_cap', '250000'),
            'revenue_cap_label' => Setting::get('revenue_cap_label', 'FL Cottage Food Annual Cap'),

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
            'send_repeat_reminders' => Setting::get('send_repeat_reminders', '0') === '1',

            // Birthday Program
            'birthday_program_enabled' => Setting::get('birthday_program_enabled', '0') === '1',
            'birthday_discount_percent' => Setting::get('birthday_discount_percent', '15'),

            // PayPal Invoice Settings
            'paypal_template_id' => Setting::get('paypal_template_id', ''),
            'invoice_seller_note' => Setting::get('invoice_seller_note', ''),
            'invoice_terms' => Setting::get('invoice_terms', ''),
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
                        TextInput::make('owner_name')
                            ->label('Owner/Baker Name')
                            ->helperText('Used in email signatures and the About page'),
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
                        TextInput::make('store_city')
                            ->label('City'),
                        TextInput::make('store_state')
                            ->label('State Abbreviation')
                            ->maxLength(2)
                            ->placeholder('FL'),
                        TextInput::make('store_state_full')
                            ->label('State Full Name')
                            ->placeholder('Florida'),
                        Select::make('store_timezone')
                            ->label('Timezone')
                            ->options([
                                'America/New_York' => 'Eastern (America/New_York)',
                                'America/Chicago' => 'Central (America/Chicago)',
                                'America/Denver' => 'Mountain (America/Denver)',
                                'America/Los_Angeles' => 'Pacific (America/Los_Angeles)',
                                'America/Anchorage' => 'Alaska (America/Anchorage)',
                                'Pacific/Honolulu' => 'Hawaii (Pacific/Honolulu)',
                            ]),
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

                Section::make('Store Branding')
                    ->description('Customize your store\'s color palette. Changes apply to both the admin panel and your storefront.')
                    ->icon('heroicon-o-paint-brush')
                    ->schema([
                        ColorPicker::make('brand_color_900')
                            ->label('Primary (Darkest)')
                            ->helperText('Main headings, dark backgrounds'),
                        ColorPicker::make('brand_color_700')
                            ->label('Secondary')
                            ->helperText('Secondary text, borders'),
                        ColorPicker::make('brand_color_300')
                            ->label('Accent')
                            ->helperText('Buttons, highlights, gold accents'),
                        ColorPicker::make('brand_color_50')
                            ->label('Background')
                            ->helperText('Page backgrounds, light fills'),
                        Section::make('Advanced Colors')
                            ->description('Fine-tune the full palette.')
                            ->collapsed()
                            ->schema([
                                ColorPicker::make('brand_color_800')->label('Hover State'),
                                ColorPicker::make('brand_color_600')->label('Medium'),
                                ColorPicker::make('brand_color_500')->label('Muted Text'),
                                ColorPicker::make('brand_color_400')->label('Light Border'),
                                ColorPicker::make('brand_color_200')->label('Divider'),
                                ColorPicker::make('brand_color_150')->label('Subtle Background'),
                                ColorPicker::make('brand_color_100')->label('Light Fill'),
                            ])
                            ->columns(4),
                        FileUpload::make('store_logo')
                            ->label('Store Logo')
                            ->image()
                            ->directory('branding')
                            ->helperText('Displayed in the admin sidebar, emails, and storefront header.')
                            ->columnSpanFull(),
                        FileUpload::make('store_favicon')
                            ->label('Favicon')
                            ->image()
                            ->directory('branding')
                            ->helperText('Browser tab icon. Recommended: square, at least 192×192px.')
                            ->columnSpanFull(),
                    ])
                    ->columns(4),

                Section::make('Compliance')
                    ->description('State-specific cottage food regulations.')
                    ->icon('heroicon-o-shield-check')
                    ->schema([
                        TextInput::make('revenue_cap')
                            ->label('Annual Revenue Cap ($)')
                            ->numeric()
                            ->prefix('$')
                            ->helperText('Your state\'s cottage food revenue limit. Leave 0 for no limit.'),
                        TextInput::make('revenue_cap_label')
                            ->label('Revenue Cap Label')
                            ->placeholder('FL Cottage Food Annual Cap')
                            ->helperText('Displayed on the Finance Summary dashboard.'),
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

                Section::make('PayPal Invoice Settings')
                    ->description('Customize text that appears on PayPal invoices. Sync pulls from PayPal, Push updates PayPal with what\'s here.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TextInput::make('paypal_template_id')
                            ->label('PayPal Template ID')
                            ->helperText('Auto-detected when you sync. Leave blank to skip template usage.')
                            ->placeholder('TEMP-XXXX...')
                            ->columnSpanFull(),
                        Textarea::make('invoice_seller_note')
                            ->label('Seller Note to Customer')
                            ->rows(3)
                            ->maxLength(2000)
                            ->helperText('Allergy disclaimers, special notes, etc. Shows on every invoice.'),
                        Textarea::make('invoice_terms')
                            ->label('Terms & Conditions')
                            ->rows(5)
                            ->maxLength(4000)
                            ->helperText('Payment terms, cancellation/refund policy, etc.'),
                    ])
                    ->columns(1),

                Section::make('Notification Settings')
                    ->description('Configure email notifications.')
                    ->schema([
                        Toggle::make('send_order_emails')
                            ->label('Send order status emails')
                            ->helperText('Customers receive email notifications when their order status changes.'),
                        Toggle::make('send_review_followup_emails')
                            ->label('Send review follow-up emails')
                            ->helperText('Send customers a follow-up email asking for a review after order completion.'),
                        Toggle::make('send_repeat_reminders')
                            ->label('Send repeat order reminders')
                            ->helperText('Automatically email customers ~30 days after their last order with a friendly reorder reminder.'),
                        TextInput::make('admin_notification_email')
                            ->label('Admin Notification Email')
                            ->email()
                            ->maxLength(255)
                            ->helperText('New order alerts are sent to this address.'),
                    ])
                    ->columns(2),

                Section::make('Birthday Program')
                    ->description('Automatically send birthday discount coupons to customers.')
                    ->icon('heroicon-o-cake')
                    ->schema([
                        Toggle::make('birthday_program_enabled')
                            ->label('Enable Birthday Program')
                            ->helperText('When enabled, customers with a birthday on file receive a discount coupon on their birthday.'),
                        TextInput::make('birthday_discount_percent')
                            ->label('Birthday Discount (%)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(100)
                            ->suffix('%')
                            ->helperText('Percentage discount for the birthday coupon (default 15%).'),
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
        Setting::set('owner_name', $data['owner_name'] ?? '');
        Setting::set('store_city', $data['store_city'] ?? '');
        Setting::set('store_state', $data['store_state'] ?? '');
        Setting::set('store_state_full', $data['store_state_full'] ?? '');
        Setting::set('store_timezone', $data['store_timezone'] ?? 'America/New_York');

        // Compliance
        Setting::set('revenue_cap', $data['revenue_cap'] ?? '250000');
        Setting::set('revenue_cap_label', $data['revenue_cap_label'] ?? '');

        // Branding colors
        foreach (['900','800','700','600','500','400','300','200','150','100','50'] as $shade) {
            $key = "brand_color_{$shade}";
            if (isset($data[$key])) {
                Setting::set($key, $data[$key]);
            }
        }

        // Logo/Favicon
        if (isset($data['store_logo'])) Setting::set('store_logo', $data['store_logo']);
        if (isset($data['store_favicon'])) Setting::set('store_favicon', $data['store_favicon']);

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

        // PayPal Invoice Settings
        Setting::set('paypal_template_id', $data['paypal_template_id'] ?? '');
        Setting::set('invoice_seller_note', $data['invoice_seller_note'] ?? '');
        Setting::set('invoice_terms', $data['invoice_terms'] ?? '');

        // Notification Settings
        Setting::set('send_order_emails', ($data['send_order_emails'] ?? true) ? '1' : '0');
        Setting::set('send_review_followup_emails', ($data['send_review_followup_emails'] ?? true) ? '1' : '0');
        Setting::set('admin_notification_email', $data['admin_notification_email'] ?? '');
        Setting::set('send_repeat_reminders', ($data['send_repeat_reminders'] ?? false) ? '1' : '0');

        // Birthday Program
        Setting::set('birthday_program_enabled', ($data['birthday_program_enabled'] ?? false) ? '1' : '0');
        Setting::set('birthday_discount_percent', $data['birthday_discount_percent'] ?? '15');

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }

    public function syncFromPayPal(): void
    {
        try {
            $paypal = app(\App\Services\PayPalService::class);
            $templates = $paypal->listTemplates();

            if (empty($templates)) {
                Notification::make()
                    ->title('No templates found in PayPal')
                    ->body('You can create one by filling in the fields below and clicking "Push to PayPal".')
                    ->warning()
                    ->send();
                return;
            }

            $template = $templates[0];
            $templateId = $template['id'] ?? '';
            $note = $template['detail']['note'] ?? '';
            $terms = $template['detail']['terms_and_conditions'] ?? '';

            $this->data['paypal_template_id'] = $templateId;
            $this->data['invoice_seller_note'] = $note;
            $this->data['invoice_terms'] = $terms;

            Setting::set('paypal_template_id', $templateId);
            Setting::set('invoice_seller_note', $note);
            Setting::set('invoice_terms', $terms);

            Notification::make()
                ->title('Synced from PayPal')
                ->body("Template: {$templateId}")
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('PayPal sync failed')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function pushToPayPal(): void
    {
        try {
            $paypal = app(\App\Services\PayPalService::class);
            $note = $this->data['invoice_seller_note'] ?? '';
            $terms = $this->data['invoice_terms'] ?? '';
            $templateId = $this->data['paypal_template_id'] ?? '';

            if ($templateId) {
                $paypal->updateTemplate($templateId, $note, $terms);
                Notification::make()
                    ->title('PayPal template updated')
                    ->body("Template {$templateId} has been updated.")
                    ->success()
                    ->send();
            } else {
                $result = $paypal->createTemplate(\App\Models\Setting::get('business_name', 'Bakery on Biscotto'), $note, $terms);
                $newId = $result['id'] ?? '';
                if ($newId) {
                    $this->data['paypal_template_id'] = $newId;
                    Setting::set('paypal_template_id', $newId);
                }
                Notification::make()
                    ->title('PayPal template created')
                    ->body("New template: {$newId}")
                    ->success()
                    ->send();
            }

            Setting::set('invoice_seller_note', $note);
            Setting::set('invoice_terms', $terms);
        } catch (\Exception $e) {
            Notification::make()
                ->title('PayPal push failed')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('syncPayPal')
                ->label('Sync from PayPal')
                ->action('syncFromPayPal')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info')
                ->requiresConfirmation()
                ->modalDescription('This will pull the seller note and terms from your PayPal template and overwrite what\'s here.'),
            Actions\Action::make('pushPayPal')
                ->label('Push to PayPal')
                ->action('pushToPayPal')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('warning')
                ->requiresConfirmation()
                ->modalDescription('This will update your PayPal template with the seller note and terms shown here.'),
            Actions\Action::make('save')
                ->label('Save Settings')
                ->action('save')
                ->icon('heroicon-o-check'),
        ];
    }
}
