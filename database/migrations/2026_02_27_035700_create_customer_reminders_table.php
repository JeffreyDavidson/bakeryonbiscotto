<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_reminders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_email');
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('type')->default('repeat_order');
            $table->timestamp('sent_at');
            $table->timestamps();

            $table->index(['customer_email', 'type', 'sent_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_reminders');
    }
};
