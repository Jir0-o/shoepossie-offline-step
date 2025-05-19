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
        Schema::table('attribute_definition', function (Blueprint $table) {
            $table->foreign(['attribute_type_id'], 'attribute_definition_ibfk_1')->references(['attribute_type_id'])->on('attribute_type_definition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_definition', function (Blueprint $table) {
            $table->dropForeign('attribute_definition_ibfk_1');
        });
    }
};
