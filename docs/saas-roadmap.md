# SaaS Roadmap — Cottage Baker

## Overview
Transform the Bakery on Biscotto app into a multi-tenant SaaS platform for cottage food bakers.

## Phase 1: Configuration Abstraction (Do First)
Move all hardcoded business-specific values into the Settings system.

### Store Identity (Settings)
- [ ] Store name ("Bakery on Biscotto" → `store_name`)
- [ ] Store tagline
- [ ] Store phone, email, address
- [ ] Store logo (upload)
- [ ] Store favicon (upload or generate)
- [ ] Store timezone (hardcoded `America/New_York`)
- [ ] Social media links

### Branding / Theme (Settings)
- [ ] Primary color (#3d2314 → configurable)
- [ ] Secondary color (#6b4c3b → configurable)
- [ ] Accent color (#d4a574 → configurable)
- [ ] Light background (#fdf8f2 → configurable)
- [ ] Border color (#e8d0b0 → configurable)
- [ ] Muted text color (#a08060 → configurable)
- [ ] All 19 admin Blade components reference hardcoded hex colors
- [ ] `filament-custom.css` has ~100+ hardcoded color refs
- [ ] All 15+ custom Filament page templates have inline color refs
- [ ] Storefront layout + all pages reference brand colors

### Location / Compliance (Settings)
- [ ] State selection (drives cottage food rules)
- [ ] Revenue cap per state ($250K FL, varies by state)
- [ ] Cottage food disclaimer text (currently FL-specific)
- [ ] Delivery radius / zone config
- [ ] Geocoding viewbox bounds (hardcoded to FL)

### Hardcoded "Biscotto" References (~40 source files)
Files with literal "Biscotto" / "Bakery on Biscotto":
- `AdminPanelProvider.php` — panel brand name
- `layouts/storefront.blade.php` — site title, meta
- `components/site-footer.blade.php` — footer text
- `home.blade.php` — hero, about section
- `about.blade.php`, `contact.blade.php`, `faq.blade.php`, `menu.blade.php`
- `order.blade.php`, `review.blade.php`, `gallery.blade.php`
- All 7 email templates (mail/*.blade.php)
- `PayPalService.php` — invoice merchant info
- `CaptionGenerator.php` — Instagram caption templates
- `OrderController.php` — order confirmation
- `config/mail.php` — from name
- Seeders (demo data — fine to keep)

### Florida-Specific References (~15 source files)
- `FinanceSummary.php` — $250K cap, "Florida" text
- `finance-summary.blade.php` — FL cottage food law ref
- `OrderController.php` — `America/New_York` timezone
- `site-footer.blade.php` — FL cottage food disclaimer
- `faq.blade.php` — FL law references
- `home.blade.php` — location text
- `contact.blade.php` — address
- `address-autocomplete.blade.php` — Nominatim FL viewbox
- Seeders — FL addresses

## Phase 2: Multi-Tenancy Architecture
- [ ] Choose tenancy package (Stancl Tenancy vs custom)
- [ ] Database strategy: database-per-tenant (cleanest isolation)
- [ ] Tenant model + domain/subdomain routing
- [ ] Central app: marketing site, signup, billing
- [ ] Tenant provisioning: create DB, run migrations, seed defaults
- [ ] Custom domain support (each baker gets `mybakery.cottagebaker.com` + optional custom domain)

## Phase 3: Onboarding Flow
- [ ] Signup: name, email, password, store name
- [ ] Setup wizard: logo, colors, products, hours, payment method
- [ ] Storefront template selection (warm bakery is default theme)
- [ ] First product + category creation
- [ ] PayPal connection (OAuth, not raw credentials)
- [ ] "Preview your store" before going live

## Phase 4: Billing
- [ ] Stripe Subscriptions (Cashier)
- [ ] Pricing tiers (Free/Starter/Pro?)
- [ ] Free tier: limited products, no PayPal, basic storefront
- [ ] Pro tier: unlimited, PayPal, all admin tools, gallery, analytics
- [ ] Trial period (14 days?)

## Phase 5: State Compliance Engine
- [ ] Database of cottage food laws by state
- [ ] Revenue caps, labeling requirements, allowed products
- [ ] Auto-configure disclaimer text based on state
- [ ] Annual revenue tracking against state cap
- [ ] Compliance alerts when approaching limits

## Phase 6: Polish for Market
- [ ] Marketing/landing page
- [ ] Documentation / help center
- [ ] Storefront theme variations (not just bakery — could work for cottage food jams, candles, etc.)
- [ ] Customer support system
- [ ] Admin super-dashboard (your view of all tenants)

## Color Abstraction Strategy
The biggest single task is replacing ~200+ hardcoded hex colors with CSS custom properties.

### Approach
1. Define CSS variables on `:root` in `filament-custom.css`:
   ```css
   :root {
     --brand-primary: #3d2314;
     --brand-secondary: #6b4c3b;
     --brand-accent: #d4a574;
     --brand-light: #fdf8f2;
     --brand-border: #e8d0b0;
     --brand-muted: #a08060;
     --brand-hover: #4a3225;
   }
   ```
2. Replace all hex refs in admin components + templates with `var(--brand-*)`
3. Replace storefront hex refs similarly
4. Settings page generates CSS variables dynamically per tenant
5. Admin components become theme-agnostic instantly

### Files Requiring Color Abstraction
- 19 admin Blade components in `components/admin/`
- `filament-custom.css`
- 15+ Filament page templates in `filament/pages/`
- 2 Filament widget templates
- Storefront layout + pages
- Email templates

## Priority Order
1. **CSS variables** (biggest bang, makes everything else easier)
2. **Store identity in Settings** (name, contact, logo)
3. **Replace all "Biscotto" with `Setting::get('store_name')`**
4. **State/compliance config**
5. **Multi-tenancy architecture**
6. **Onboarding + billing**
