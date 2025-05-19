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
        Schema::create('cart_payment_methods', function (Blueprint $table) {
            $table->comment('');
            $table->integer('payment_method_id', true);
            $table->string('payment_method', 64);
            $table->string('payment_method_symbol', 16);
            $table->float('payment_method_charge', 10, 0);
            $table->integer('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_payment_methods');
    }
};
