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
        Schema::create('product_attribute', function (Blueprint $table) {
            $table->comment('');
            $table->integer('product_attribute_id', true);
            $table->integer('product_id')->nullable()->index('product_id');
            $table->string('attribute_id', 32)->nullable();
            $table->string('attribute_image', 128)->nullable();
            $table->text('attribute_value')->nullable();
            $table->integer('is_active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute');
    }
};
