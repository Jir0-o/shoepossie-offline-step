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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->bigIncrements('sales_details_id');
            $table->unsignedBigInteger('sales_info_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->float('sales_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->float('item_total')->nullable();
            $table->float('discount')->nullable();
            $table->float('revised_price')->nullable();
            $table->float('vat')->nullable();
            $table->float('item_final_price')->nullable();
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
        Schema::dropIfExists('sales_details');
    }
};
