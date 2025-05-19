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
        Schema::create('attribute_type_definition', function (Blueprint $table) {
            $table->comment('');
            $table->integer('attribute_type_id', true);
            $table->string('attribute_type_name', 32)->nullable();
            $table->integer('is_active')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_type_definition');
    }
};
