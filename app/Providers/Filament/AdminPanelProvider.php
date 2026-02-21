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
use Illuminate\Support\HtmlString;
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
            ->renderHook('panels::styles.after', fn () => new HtmlString('
                <style>
                    /* Login page */
                    .fi-simple-layout {
                        background: #FDF8F2 !important;
                        background-image:
                            radial-gradient(circle at 20% 50%, rgba(193,127,78,0.06) 0%, transparent 50%),
                            radial-gradient(circle at 80% 30%, rgba(212,165,116,0.08) 0%, transparent 50%) !important;
                    }
                    .fi-simple-main {
                        border: 1px solid rgba(212,165,116,0.2) !important;
                        box-shadow: 0 20px 60px rgba(61,35,20,0.08) !important;
                        border-radius: 16px !important;
                    }

                    /* Sidebar warm dark */
                    .fi-sidebar {
                        background: #3D2314 !important;
                        border-right: 1px solid rgba(212,165,116,0.1) !important;
                    }
                    .fi-sidebar-header {
                        border-bottom: 1px solid rgba(212,165,116,0.1) !important;
                    }
                    .fi-sidebar-nav-groups .fi-sidebar-group-label,
                    .fi-sidebar-item-label {
                        color: #F5E6D0 !important;
                    }
                    .fi-sidebar-item-icon {
                        color: #D4A574 !important;
                    }
                    .fi-sidebar-item.fi-active {
                        background: rgba(212,165,116,0.15) !important;
                    }
                    .fi-sidebar-item:hover {
                        background: rgba(212,165,116,0.08) !important;
                    }

                    /* Topbar */
                    .fi-topbar {
                        background: #FDF8F2 !important;
                        border-bottom: 1px solid rgba(212,165,116,0.15) !important;
                    }

                    /* Main content area warm background */
                    .fi-main {
                        background: #FDF8F2 !important;
                    }

                    /* Page headings */
                    .fi-page-heading-heading,
                    .fi-header-heading {
                        font-family: "Playfair Display", serif !important;
                        color: #3D2314 !important;
                    }
                    .fi-breadcrumbs-item span,
                    .fi-breadcrumbs-item a {
                        color: #8B5E3C !important;
                    }

                    /* Table styling */
                    .fi-ta-table {
                        border: 1px solid rgba(212,165,116,0.2) !important;
                        border-radius: 12px !important;
                        overflow: hidden !important;
                    }
                    .fi-ta-header-cell {
                        background: #F5E6D0 !important;
                        color: #3D2314 !important;
                        font-weight: 600 !important;
                        text-transform: uppercase !important;
                        font-size: 0.7rem !important;
                        letter-spacing: 0.05em !important;
                    }
                    .fi-ta-row:hover {
                        background: rgba(245,230,208,0.4) !important;
                    }
                    .fi-ta-row {
                        border-bottom: 1px solid rgba(212,165,116,0.1) !important;
                    }

                    /* Action buttons */
                    .fi-ta-actions .fi-link {
                        font-weight: 500 !important;
                    }

                    /* Cards and sections */
                    .fi-section, .fi-ta-ctn {
                        border: 1px solid rgba(212,165,116,0.15) !important;
                        border-radius: 12px !important;
                        box-shadow: 0 4px 20px rgba(61,35,20,0.04) !important;
                    }

                    /* Badge colors */
                    .fi-badge-warning {
                        background: rgba(212,165,116,0.15) !important;
                        color: #8B5E3C !important;
                    }

                    /* Search input */
                    .fi-ta-search-field input {
                        border: 1px solid rgba(212,165,116,0.25) !important;
                        border-radius: 8px !important;
                    }
                    .fi-ta-search-field input:focus {
                        border-color: #D4A574 !important;
                        box-shadow: 0 0 0 2px rgba(212,165,116,0.15) !important;
                    }

                    /* Navigation badge */
                    .fi-sidebar-item-badge {
                        background: #D4A574 !important;
                        color: #3D2314 !important;
                        font-weight: 700 !important;
                    }

                    /* Stat widgets */
                    .fi-wi-stats-overview-stat {
                        border: 1px solid rgba(212,165,116,0.15) !important;
                        border-radius: 12px !important;
                    }

                    /* Pagination */
                    .fi-pagination-item-btn.fi-active {
                        background: #8B5E3C !important;
                        color: white !important;
                    }

                    /* Google font for headings */
                    @import url("https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap");
                </style>
            '))
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
