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
        Schema::create('sub_category_one', function (Blueprint $table) {
            $table->comment('');
            $table->increments('sc_one_id');
            $table->integer('category_id')->index('Foreign Key');
            $table->string('sc_one_name', 512);
            $table->text('sc_one_description')->nullable();
            $table->string('sc_one_image', 32)->nullable();
            $table->integer('is_active');
            $table->text('sc_one_image_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_category_one');
    }
};
