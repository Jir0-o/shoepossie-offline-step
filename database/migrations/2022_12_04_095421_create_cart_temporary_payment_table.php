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
        Schema::create('cart_temporary_payment', function (Blueprint $table) {
            $table->comment('');
            $table->integer('cart_temporary_payment_id', true);
            $table->integer('cart_temporary_id');
            $table->integer('cart_temporary_total');
            $table->integer('discount_amount');
            $table->integer('total_payable');
            $table->integer('payment_method_id');
            $table->integer('paid_amount');
            $table->integer('due_amount');
            $table->integer('change_amount');
            $table->float('vat', 10, 0)->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_temporary_payment');
    }
};
