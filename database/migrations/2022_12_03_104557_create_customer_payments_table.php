<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->bigIncrements('customer_payment_id');
            $table->string('date')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('sales_info_id')->nullable();
            $table->float('payable_amount')->nullable();
            $table->float('adjustment_amount')->nullable();
            $table->float('adjust_payable')->nullable();
            $table->float('paid_amount')->nullable();
            $table->float('revised_due')->nullable();
            $table->integer('payment_method')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('cheque_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_payments');
    }
};
