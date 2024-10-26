<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_group_id');
            $table->integer('customer_id');
            $table->string('purchase_no');
            $table->integer('purchase_id');
            $table->integer('product_group_id');
            $table->integer('product_id');
            $table->float('unit_price');
            $table->integer('quantity');
            $table->float('unit_total');
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
