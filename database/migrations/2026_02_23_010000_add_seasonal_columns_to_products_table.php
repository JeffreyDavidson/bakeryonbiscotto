<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->date('seasonal_start')->nullable()->after('weekly_limit');
            $table->date('seasonal_end')->nullable()->after('seasonal_start');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['seasonal_start', 'seasonal_end']);
        });
    }
};
