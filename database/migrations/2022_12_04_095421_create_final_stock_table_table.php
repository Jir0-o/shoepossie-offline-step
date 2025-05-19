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
        Schema::create('final_stock_table', function (Blueprint $table) {
            $table->comment('');
            $table->integer('stock_id', true);
            $table->integer('product_id')->nullable()->index('product_id');
            $table->float('total_purchased_quantity', 10, 0)->nullable();
            $table->float('total_sold_quantity', 10, 0)->nullable();
            $table->float('total_ordered_quantity', 10, 0)->nullable();
            $table->float('in_order_queue', 10, 0)->nullable();
            $table->float('temp_quantity', 10, 0)->nullable();
            $table->float('final_quantity', 10, 0)->nullable();
            $table->integer('purchase_id')->nullable()->index('purchase_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('final_stock_table');
    }
};
