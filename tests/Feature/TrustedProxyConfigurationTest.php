<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

it('honors the forwarded HTTPS scheme from a cloud proxy', function () {
    Route::get('/test/trusted-proxy', fn (Request $request): array => [
        'is_secure' => $request->isSecure(),
        'url' => url('/'),
    ]);

    $response = $this
        ->withServerVariables(['REMOTE_ADDR' => '10.0.0.1'])
        ->withHeader('X-Forwarded-Proto', 'https')
        ->get('/test/trusted-proxy');

    $response->assertOk();
    $response->assertJson([
        'is_secure' => true,
        'url' => 'https://localhost',
    ]);
});
