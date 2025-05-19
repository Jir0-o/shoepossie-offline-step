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
        Schema::create('foot_ware_categories', function (Blueprint $table) {
            $table->bigIncrements('foot_ware_categories_id');
            $table->string('foot_ware_categories_name');
            $table->string('foot_ware_categories_code');
            $table->boolean('foot_ware_categories_is_active')->default(1);
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
        Schema::dropIfExists('foot_ware_categories');
    }
};
