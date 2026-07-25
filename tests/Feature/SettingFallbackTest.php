<?php

use App\Models\Setting;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

it('returns the default value when the settings table is not available during early boot', function () {
    Schema::dropIfExists('settings');

    expect(Setting::get('business_name', 'Bakery on Biscotto'))->toBe('Bakery on Biscotto');
});

it('only treats missing settings table errors as recoverable', function () {
    $method = (new ReflectionClass(Setting::class))->getMethod('isMissingSettingsTableException');

    $missingTableException = new QueryException(
        'sqlite',
        'select value from settings where key = ?',
        ['business_name'],
        new Exception('SQLSTATE[HY000]: General error: 1 no such table: settings')
    );

    $invalidColumnException = new QueryException(
        'sqlite',
        'select value from settings where key = ?',
        ['business_name'],
        new Exception('SQLSTATE[HY000]: General error: 1 no such column: key')
    );

    expect($method->invoke(null, $missingTableException))->toBeTrue();
    expect($method->invoke(null, $invalidColumnException))->toBeFalse();
});
