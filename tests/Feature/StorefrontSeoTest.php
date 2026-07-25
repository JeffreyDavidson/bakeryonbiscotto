<?php

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders core SEO metadata and structured data on the storefront layout', function () {
    $this->withoutVite();

    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('<meta name="description"', false);
    $response->assertSee('<link rel="canonical"', false);
    $response->assertSee('<meta property="og:title"', false);
    $response->assertSee('<meta name="twitter:card" content="summary_large_image">', false);
    $response->assertSee('<script type="application/ld+json">', false);
    $response->assertSee('"@type":"Bakery"', false);
    $response->assertDontSee('alpinejs@', false);
});

it('escapes setting-backed JSON-LD values so they cannot break out of the script tag', function () {
    $this->withoutVite();

    Setting::set('business_name', 'Bad Bakery </script><script>alert(1)</script>');

    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('<script type="application/ld+json">', false);
    $response->assertSee('"@type":"Bakery"', false);
    $response->assertSee('Bad Bakery \\u003C/script\\u003E\\u003Cscript\\u003Ealert(1)\\u003C/script\\u003E', false);
    $response->assertDontSee('Bad Bakery </script><script>alert(1)</script>', false);
});
