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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->comment('');
            $table->integer('purchase_details_id', true);
            $table->integer('purchase_id')->index('Purchase_Info_Foreign_Key');
            $table->integer('product_id')->index('P_Foreign');
            $table->integer('brand_id')->index('Brand_Foreign_Key');
            $table->integer('unit_id')->index('unit_fk');
            $table->float('quantity', 10, 0)->nullable();
            $table->float('purchase_price', 10, 0)->nullable();
            $table->float('wholesale_price', 10, 0)->nullable();
            $table->float('sales_price', 10, 0)->nullable();
            $table->integer('total_purchase_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_details');
    }
};
