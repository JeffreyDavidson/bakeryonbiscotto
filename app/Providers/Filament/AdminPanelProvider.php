<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Bakery on Biscotto')
            ->brandLogo(asset('images/logo-admin.png'))
            ->brandLogoHeight('80px')
            ->darkMode(false)
            ->maxContentWidth('full')
            ->colors([
                'primary' => [
                    50 => '253, 248, 242',
                    100 => '245, 230, 208',
                    200 => '232, 208, 176',
                    300 => '212, 165, 116',
                    400 => '193, 127, 78',
                    500 => '139, 94, 60',
                    600 => '107, 76, 59',
                    700 => '90, 61, 46',
                    800 => '74, 50, 37',
                    900 => '61, 35, 20',
                    950 => '42, 26, 14',
                ],
                'danger' => Color::Rose,
                'info' => Color::Sky,
                'success' => Color::Emerald,
                'warning' => Color::Amber,
            ])
            ->font('Inter')
            ->renderHook('panels::head.end', fn () => new \Illuminate\Support\HtmlString(
                '<link rel="stylesheet" href="' . asset('css/filament-custom.css') . '">'
            ))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
