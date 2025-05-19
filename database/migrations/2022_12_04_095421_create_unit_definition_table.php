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
        Schema::create('unit_definition', function (Blueprint $table) {
            $table->comment('');
            $table->integer('unit_id', true);
            $table->string('unit_name', 64);
            $table->string('unit_symbol', 32);
            $table->integer('is_fractional');
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
        Schema::dropIfExists('unit_definition');
    }
};
