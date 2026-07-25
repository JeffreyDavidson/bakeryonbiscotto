<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            return static::where('key', $key)->value('value') ?? $default;
        } catch (QueryException $exception) {
            if (static::isMissingSettingsTableException($exception)) {
                return $default;
            }

            throw $exception;
        }
    }

    private static function isMissingSettingsTableException(QueryException $exception): bool
    {
        $message = strtolower($exception->getMessage());

        return str_contains($message, 'no such table: settings')
            || (str_contains($message, 'base table or view not found') && str_contains($message, 'settings'))
            || (str_contains($message, 'undefined table') && str_contains($message, 'settings'))
            || str_contains($message, 'relation "settings" does not exist');
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
