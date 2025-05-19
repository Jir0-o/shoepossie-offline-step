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
        Schema::create('salary_details', function (Blueprint $table) {
            $table->bigIncrements('salary_details_id');
            $table->unsignedBigInteger('salary_info_id');
            $table->foreign('salary_info_id')->references('salary_info_id')->on('salary_infos');
            $table->date('pay_date');
            $table->bigInteger('paid_amount');
            $table->bigInteger('extra_allowence_amount');
            $table->string('paid_for_month');
            $table->text('description');
            $table->bigInteger('salary_amount');
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
        Schema::dropIfExists('salary_details');
    }
};
