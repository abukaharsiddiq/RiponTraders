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
        Schema::create('bank_calculations', function (Blueprint $table) {
            $table->id();
            $table->integer('bank_information_id');
            $table->string('date');
            $table->string('cal_month');
            $table->float('amount');
            $table->string('type')->comment('deposit=joma and widthdraw=utha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_calculations');
    }
};
