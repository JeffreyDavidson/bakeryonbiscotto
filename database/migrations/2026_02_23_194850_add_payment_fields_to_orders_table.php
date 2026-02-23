<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->default(null)->after('payment_status');
            $table->string('paypal_invoice_id')->nullable()->after('payment_method');
            $table->string('paypal_invoice_url')->nullable()->after('paypal_invoice_id');
            $table->date('payment_deadline')->nullable()->after('paypal_invoice_url');
            $table->boolean('payment_reminder_sent')->default(false)->after('payment_deadline');
        });

        // Update existing orders: change payment_status default behavior
        // SQLite doesn't support ALTER COLUMN for enum changes, but since we use string type it just works
        // Set existing 'pending' payment_status rows to 'paid' (storefront orders were paid via PayPal checkout)
        \DB::table('orders')->where('payment_status', 'pending')->update(['payment_status' => 'paid']);

        // Drop stripe columns - SQLite needs separate calls
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('stripe_session_id');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('stripe_payment_intent');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('stripe_session_id')->nullable();
            $table->string('stripe_payment_intent')->nullable();
            $table->dropColumn([
                'payment_method',
                'paypal_invoice_id',
                'paypal_invoice_url',
                'payment_deadline',
                'payment_reminder_sent',
            ]);
        });
    }
};
