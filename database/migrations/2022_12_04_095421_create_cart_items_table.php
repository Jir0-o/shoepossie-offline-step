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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->comment('');
            $table->integer('cart_item_id', true);
            $table->integer('cart_id')->nullable()->index('cart_id');
            $table->integer('product_id')->nullable()->index('product_id');
            $table->string('size_id', 128)->nullable();
            $table->integer('unit_id')->nullable()->index('unit_id');
            $table->float('unit_purchase_cost', 10, 0)->nullable();
            $table->float('quantity', 10, 0)->nullable();
            $table->float('unit_sales_cost', 10, 0)->nullable();
            $table->float('total_price', 10, 0)->nullable();
            $table->float('vat', 10, 0)->nullable();
            $table->float('net_amount', 10, 0)->nullable();
            $table->string('is_confirmed', 11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
