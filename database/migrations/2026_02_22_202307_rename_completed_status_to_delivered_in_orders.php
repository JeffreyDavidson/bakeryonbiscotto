<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Only needed for existing databases that have 'completed' in the enum.
        // Fresh installs already use 'delivered' in the create migration.
        $hasCompleted = DB::table('orders')->where('status', 'completed')->exists();

        if (! $hasCompleted) {
            return;
        }

        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=OFF');

            $originalSql = DB::selectOne("SELECT sql FROM sqlite_master WHERE type='table' AND name='orders'")->sql;
            $newSql = str_replace(
                "'completed'",
                "'delivered'",
                $originalSql
            );

            DB::statement('ALTER TABLE orders RENAME TO orders_backup');
            DB::statement($newSql);

            $columns = collect(DB::select('PRAGMA table_info(orders)'))->pluck('name')->toArray();
            $columnList = implode(', ', $columns);
            $selectColumns = array_map(fn ($col) => $col === 'status'
                ? "CASE WHEN status = 'completed' THEN 'delivered' ELSE status END AS status"
                : $col, $columns);

            DB::statement("INSERT INTO orders ({$columnList}) SELECT " . implode(', ', $selectColumns) . " FROM orders_backup");
            DB::statement('DROP TABLE orders_backup');
            DB::statement('PRAGMA foreign_keys=ON');
        } else {
            DB::table('orders')->where('status', 'completed')->update(['status' => 'delivered']);
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'confirmed', 'baking', 'ready', 'delivered', 'cancelled') DEFAULT 'pending'");
        }
    }

    public function down(): void
    {
        // no-op: not worth reversing
    }
};
