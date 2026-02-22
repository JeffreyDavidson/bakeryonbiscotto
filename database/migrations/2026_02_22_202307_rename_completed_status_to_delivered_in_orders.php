<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=OFF');

            // Get the original CREATE TABLE statement
            $originalSql = DB::selectOne("SELECT sql FROM sqlite_master WHERE type='table' AND name='orders'")->sql;

            // Replace the check constraint for status
            $newSql = str_replace(
                ["'completed'", "'pending', 'confirmed', 'baking', 'ready', 'completed', 'cancelled'"],
                ["'delivered'", "'pending', 'confirmed', 'baking', 'ready', 'delivered', 'cancelled'"],
                $originalSql
            );

            // Rename original, create new, copy data, drop old
            DB::statement('ALTER TABLE orders RENAME TO orders_backup');
            DB::statement($newSql);

            // Get column list dynamically
            $columns = collect(DB::select('PRAGMA table_info(orders)'))->pluck('name')->toArray();
            $columnList = implode(', ', $columns);

            // Build select with CASE for status column
            $selectColumns = array_map(function ($col) {
                if ($col === 'status') {
                    return "CASE WHEN status = 'completed' THEN 'delivered' ELSE status END AS status";
                }
                return $col;
            }, $columns);
            $selectList = implode(', ', $selectColumns);

            DB::statement("INSERT INTO orders ({$columnList}) SELECT {$selectList} FROM orders_backup");
            DB::statement('DROP TABLE orders_backup');
            DB::statement('PRAGMA foreign_keys=ON');
        } else {
            DB::table('orders')->where('status', 'completed')->update(['status' => 'delivered']);
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'confirmed', 'baking', 'ready', 'delivered', 'cancelled') DEFAULT 'pending'");
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            DB::table('orders')->where('status', 'delivered')->update(['status' => 'completed']);
        } else {
            DB::table('orders')->where('status', 'delivered')->update(['status' => 'completed']);
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'confirmed', 'baking', 'ready', 'completed', 'cancelled') DEFAULT 'pending'");
        }
    }
};
