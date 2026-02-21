<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_bundle')->default(false)->after('is_featured');
            $table->unsignedInteger('bundle_pick_count')->nullable()->after('is_bundle');
            $table->foreignId('bundle_category_id')->nullable()->after('bundle_pick_count')
                  ->constrained('categories')->nullOnDelete();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->json('selections')->nullable()->after('line_total');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['bundle_category_id']);
            $table->dropColumn(['is_bundle', 'bundle_pick_count', 'bundle_category_id']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('selections');
        });
    }
};
