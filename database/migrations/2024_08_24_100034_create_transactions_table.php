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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type')
                   ->comment('sale,purchase,cashin,cashout,factory,advance salary,bank etc');

            $table->integer('reference_id')
                   ->comment('sale id,purchase id,cashin id, cashout id etc id');
                   
            $table->integer('customer_group_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('memo_no')->nullable();
            $table->string('reason')->nullable();
            $table->float('debit')->nullable()->comment('khoros');
            $table->float('credit')->nullable()->comment('joma');
            $table->float('balance')->nullable();
            $table->string('date');
            $table->string('month_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
