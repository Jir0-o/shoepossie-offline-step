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
        Schema::create('cart_temporary_items', function (Blueprint $table) {
            $table->comment('');
            $table->integer('temp_cart_item_id', true);
            $table->integer('temp_cart_id')->nullable()->index('temp_cart_id');
            $table->integer('product_id')->nullable()->index('product_id');
            $table->integer('quantity')->nullable();
            $table->integer('total_discount')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->float('temp_net_amount', 10, 0)->nullable();
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
        Schema::dropIfExists('cart_temporary_items');
    }
};
