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
        Schema::create('cart_delivery', function (Blueprint $table) {
            $table->comment('');
            $table->integer('delivery_id', true);
            $table->integer('temp_cart_id');
            $table->integer('cart_id')->nullable();
            $table->integer('waiter_id')->nullable();
            $table->integer('payment_status')->nullable()->default(0);
            $table->integer('delivery_status_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_delivery');
    }
};
