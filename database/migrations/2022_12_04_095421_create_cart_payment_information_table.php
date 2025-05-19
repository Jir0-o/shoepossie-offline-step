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
        Schema::create('cart_payment_information', function (Blueprint $table) {
            $table->comment('');
            $table->integer('payment_id', true);
            $table->integer('cart_id')->index('cart_payment_information_ibfk_1');
            $table->integer('payment_method_id')->index('payment_method_id');
            $table->float('paid_amount', 10, 0);
            $table->float('balance_amount', 10, 0);
            $table->integer('is_verified')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_payment_information');
    }
};
