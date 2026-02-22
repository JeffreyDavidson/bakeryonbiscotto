<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Update existing data first
        DB::table('orders')->where('status', 'completed')->update(['status' => 'delivered']);

        // Alter the enum
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'confirmed', 'baking', 'ready', 'delivered', 'cancelled') DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::table('orders')->where('status', 'delivered')->update(['status' => 'completed']);
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'confirmed', 'baking', 'ready', 'completed', 'cancelled') DEFAULT 'pending'");
    }
};
