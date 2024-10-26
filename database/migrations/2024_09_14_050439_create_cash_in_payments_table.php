<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cash_in_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type');
            $table->integer('cash_in_type_id');
            $table->string('reason');
            $table->float('amount');
            $table->string('month_year');
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_in_payments');
    }
};
