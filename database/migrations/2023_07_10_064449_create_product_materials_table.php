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
        Schema::create('product_materials', function (Blueprint $table) {
            $table->bigIncrements('product_material_id');
            $table->string('product_material_name');
            $table->unsignedBigInteger('foot_ware_categories_id');
            $table->foreign('foot_ware_categories_id')->references('foot_ware_categories_id')->on('foot_ware_categories');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('type_id')->on('types');
            $table->unsignedBigInteger('material_type_id');
            $table->foreign('material_type_id')->references('material_type_id')->on('material_types');
            $table->unsignedBigInteger('brand_type_id');
            $table->foreign('brand_type_id')->references('brand_type_id')->on('brand_types');
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
        Schema::dropIfExists('product_materials');
    }
};
