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
        Schema::create('salary_infos', function (Blueprint $table) {
            $table->bigIncrements('salary_info_id');
            $table->unsignedBigInteger('back_office_login_id')->nullable();
            $table->unsignedBigInteger('salary_type_id');
            $table->foreign('salary_type_id')->references('salary_type_id')->on('salary_types');
            $table->bigInteger('salary_amount');
            $table->bigInteger('due')->default(0);
            $table->bigInteger('paid')->default(0);
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('salary_infos');
    }
};
