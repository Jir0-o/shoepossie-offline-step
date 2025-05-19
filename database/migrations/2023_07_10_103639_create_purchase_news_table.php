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
        Schema::create('purchase_news', function (Blueprint $table) {
            $table->bigIncrements('purchase_id');
            $table->unsignedBigInteger('product_material_id');
            $table->foreign('product_material_id')->references('product_material_id')->on('product_materials');
            $table->unsignedBigInteger('colors_id');
            $table->foreign('colors_id')->references('colors_id')->on('colors');
            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id')->references('size_id')->on('sizes');
            $table->string('batch');
            $table->bigInteger('purchase_price');
            $table->date('date');
            $table->integer('vat');
            $table->integer('qty');
            $table->string('purchase_code');
            $table->string('barcode');
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
        Schema::dropIfExists('purchase_news');
    }
};
