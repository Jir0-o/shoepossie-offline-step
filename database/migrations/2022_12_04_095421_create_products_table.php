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
        Schema::create('products', function (Blueprint $table) {
            $table->comment('');
            $table->integer('product_id', true);
            $table->integer('sc_one_id');
            $table->string('attribute_id')->nullable();
            $table->string('product_name', 512);
            $table->string('avg_rating', 11)->nullable();
            $table->text('product_description')->nullable();
            $table->integer('unit_type');
            $table->text('image_path')->nullable()->default('https://kaynat.nescostore.com/public/backend/kaynat.jpeg');
            $table->string('product_image')->nullable()->default('kaynat.jpeg');
            $table->string('sku_no', 11)->nullable();
            $table->integer('is_active');
            $table->float('cost_price', 10, 0)->nullable();
            $table->float('bulk_price', 10, 0)->nullable();
            $table->float('sales_price', 10, 0)->nullable();
            $table->float('vat', 10, 0)->nullable();
            $table->string('barcode', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
