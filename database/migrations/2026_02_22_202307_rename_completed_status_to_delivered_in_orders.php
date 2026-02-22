<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            // SQLite: drop the check constraint by recreating the column approach
            // First disable foreign keys, then update data after removing constraint
            DB::statement('PRAGMA foreign_keys=OFF');
            DB::statement("CREATE TABLE orders_tmp AS SELECT * FROM orders");
            DB::statement("DROP TABLE orders");

            // Recreate with the new enum value - get the original schema but swap completed for delivered
            $createSql = "CREATE TABLE orders (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                order_number VARCHAR NOT NULL,
                customer_name VARCHAR NOT NULL,
                customer_email VARCHAR NOT NULL,
                customer_phone VARCHAR NOT NULL,
                customer_address TEXT,
                fulfillment_type VARCHAR NOT NULL DEFAULT 'pickup' CHECK (fulfillment_type IN ('pickup', 'delivery')),
                delivery_fee DECIMAL(8,2) NOT NULL DEFAULT 0,
                requested_date DATE NOT NULL,
                requested_time VARCHAR,
                notes TEXT,
                subtotal DECIMAL(8,2) NOT NULL,
                total DECIMAL(8,2) NOT NULL,
                status VARCHAR NOT NULL DEFAULT 'pending' CHECK (status IN ('pending', 'confirmed', 'baking', 'ready', 'delivered', 'cancelled')),
                payment_status VARCHAR NOT NULL DEFAULT 'unpaid' CHECK (payment_status IN ('unpaid', 'paid', 'refunded')),
                stripe_session_id VARCHAR,
                stripe_payment_intent VARCHAR,
                paid_at TIMESTAMP,
                delivered_at TIMESTAMP,
                follow_up_sent BOOLEAN NOT NULL DEFAULT 0,
                created_at TIMESTAMP,
                updated_at TIMESTAMP
            )";
            DB::statement($createSql);

            // Copy data, replacing completed with delivered
            DB::statement("INSERT INTO orders SELECT
                id, order_number, customer_name, customer_email, customer_phone,
                customer_address, fulfillment_type, delivery_fee, requested_date, requested_time,
                notes, subtotal, total,
                CASE WHEN status = 'completed' THEN 'delivered' ELSE status END,
                payment_status, stripe_session_id, stripe_payment_intent, paid_at,
                delivered_at, follow_up_sent, created_at, updated_at
            FROM orders_tmp");

            DB::statement("DROP TABLE orders_tmp");
            DB::statement('PRAGMA foreign_keys=ON');
        } else {
            // MySQL: simple update + alter
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
