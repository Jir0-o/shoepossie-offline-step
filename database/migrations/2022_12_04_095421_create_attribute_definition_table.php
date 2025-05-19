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
        Schema::create('attribute_definition', function (Blueprint $table) {
            $table->comment('');
            $table->integer('attribute_id', true);
            $table->string('attribute_name', 32)->nullable();
            $table->integer('attribute_type_id')->nullable()->index('attribute_type_id');
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
        Schema::dropIfExists('attribute_definition');
    }
};
