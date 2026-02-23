<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('capacity_limits', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('day_of_week')->nullable();
            $table->date('specific_date')->nullable();
            $table->unsignedInteger('max_orders')->default(0);
            $table->boolean('is_blocked')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique('day_of_week');
            $table->unique('specific_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('capacity_limits');
    }
};
