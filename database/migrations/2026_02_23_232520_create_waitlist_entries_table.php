<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('waitlist_entries', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->date('requested_date');
            $table->text('product_interest')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('waiting');
            $table->dateTime('notified_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'requested_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waitlist_entries');
    }
};
