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
        Schema::create('banner_information', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('banner_url', 32);
            $table->string('banner_address')->nullable();
            $table->string('banner_mobile', 20)->nullable();
            $table->string('banner_email', 32)->default('contact@yyooss.com');
            $table->string('banner_name', 128);
            $table->string('banner_logo', 512);
            $table->integer('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_information');
    }
};
