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
        Schema::create('delivery_status_definition', function (Blueprint $table) {
            $table->comment('');
            $table->integer('delivery_status_id', true);
            $table->string('delivery_status', 256);
            $table->string('delivery_status_client', 256)->nullable();
            $table->string('delivery_status_symbol', 16);
            $table->integer('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_status_definition');
    }
};
