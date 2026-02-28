# CLAUDE.md — Bakery on Biscotto (KneadIt SaaS)

## Project Overview
Laravel 12 + Filament 5 bakery management app. Currently powering Bakery on Biscotto, being converted to KneadIt SaaS for cottage food bakers.

## Tech Stack
- PHP 8.4, Laravel 12, Filament 5
- MySQL, Tailwind CSS (storefront), inline styles (admin)
- PayPal Invoicing API v2
- Nominatim geocoding + OSRM routing (free, no paid APIs)

## Git Workflow
- Simplified gitflow: `main` (production) ← `develop` (active work)
- Feature branches only for multi-commit work
- Commit format: `type: description` (feat/fix/hotfix/refactor/style/docs/chore/test)
- SaaS conversion work stays on `develop` — do NOT merge to main without explicit instruction

## Critical Filament 5 Rules
These namespace changes from Filament 3/4 WILL bite you:

### ❌ WRONG → ✅ RIGHT
- `Filament\Tables\Actions\*` → `Filament\Actions\*` (ALL actions)
- `Filament\Forms\Components\Actions\Action` → `Filament\Actions\Action`
- `Filament\Forms\Get` / `Filament\Forms\Set` → `Filament\Schemas\Components\Utilities\Get` / `Set`
- `form(Form $form): Form` → `form(Schema $form): Schema`
- `Section` → `Filament\Schemas\Components\Section`

### Property Types
- `$navigationGroup` → `protected static string|UnitEnum|null`
- `$navigationIcon` → `protected static string|BackedEnum|null`
- `$view` → `protected string $view` (NOT static)

### Custom Pages with Forms
MUST use `content(Schema)` + `Form::make([EmbeddedSchema::make('form')])` pattern.
Do NOT use custom `$view` with `{{ $this->form }}` — it bypasses schema lifecycle and breaks Livewire.

### Other Gotchas
- No `->clearable()` on Select
- No `->css()` on Panel — use `renderHook('panels::head.end')` with `<link>` tag
- `getTableRecordKey()` must be public
- `DeleteAction` and `DeleteBulkAction` both have name `'delete'` — potential collision
- No `InteractsWithForms`/`HasForms` needed on Pages — `BasePage` provides them

## Admin UI Rules
- All admin Blade views use inline `<style>` blocks — Tailwind classes from app CSS are NOT available in Filament admin
- 19 reusable Blade components in `resources/views/components/admin/`
- Warm bakery palette: `--brand-900` (#3d2314) through `--brand-50` (#fdf8f2)
- Colors now use CSS variables (SaaS conversion) — check `filament-custom.css`
- No emojis in headers — sidebar heroicons are the single visual identity
- Shared CSS attribute `[data-admin-gradient-header]` for table headers

## Key Patterns
- `Setting::get('key')` / `Setting::set('key', value)` for app config
- Order model: `orderNotes()` not `notes()` (collision with text column)
- Nominatim over Photon for FL address geocoding
- `content(Schema)` + `EmbeddedSchema` for custom pages with forms
- `Actions::make([Action::make(...)])->alignEnd()` for buttons (getFormActions is broken with content pattern)

## Order Statuses
`pending` → `confirmed` → `baking` → `ready` → `delivered` (+ `cancelled`)

## Payment
- Payment statuses: `unpaid`, `paid`, `cancelled`, `refunded`
- Methods: `cash`, `paypal`, `other`
- PayPal invoicing via `PayPalService` (app/Services/PayPalService.php)
- Cash accepted at order creation; PayPal sends invoice automatically

## Testing
- Factories + seeders exist for all models
- Run `php artisan db:seed` for demo data
