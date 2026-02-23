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
            ->spa()
            ->navigationGroups([
                \Filament\Navigation\NavigationGroup::make('Shop'),
                \Filament\Navigation\NavigationGroup::make('Tools'),
                \Filament\Navigation\NavigationGroup::make('Finances'),
                \Filament\Navigation\NavigationGroup::make('Communication'),
            ])
            ->databaseNotifications()
            ->renderHook('panels::head.end', fn () => new \Illuminate\Support\HtmlString(
                '<link rel="stylesheet" href="' . asset('css/filament-custom.css') . '">'
            ))
            ->renderHook('panels::body.end', fn () => new \Illuminate\Support\HtmlString('
                <script>
                    (() => {
                        // Find all scrollable ancestors of sidebar
                        function getScrollables() {
                            const results = [];
                            const sidebar = document.querySelector("aside");
                            if (!sidebar) return results;
                            // Check aside itself and all children
                            const all = [sidebar, ...sidebar.querySelectorAll("*")];
                            for (const el of all) {
                                const style = getComputedStyle(el);
                                const overflowY = style.overflowY;
                                if ((overflowY === "auto" || overflowY === "scroll") && el.scrollHeight > el.clientHeight) {
                                    results.push(el);
                                }
                            }
                            // Also check window/body scroll
                            return results;
                        }

                        let saved = [];

                        document.addEventListener("livewire:navigate", () => {
                            saved = getScrollables().map(el => ({ className: el.className, top: el.scrollTop }));
                        });

                        document.addEventListener("livewire:navigated", () => {
                            if (!saved.length) return;
                            // Use multiple frames to ensure DOM is settled
                            requestAnimationFrame(() => {
                                requestAnimationFrame(() => {
                                    const scrollables = getScrollables();
                                    // Try matching by class name first, fall back to index
                                    for (const s of saved) {
                                        const match = scrollables.find(el => el.className === s.className) || scrollables[0];
                                        if (match) match.scrollTop = s.top;
                                    }
                                    saved = [];
                                });
                            });
                        });
                    })();
                </script>
            '))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
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
