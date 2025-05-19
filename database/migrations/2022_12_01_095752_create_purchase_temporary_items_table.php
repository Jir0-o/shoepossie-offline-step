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
        Schema::create('purchase_temporary_items', function (Blueprint $table) {
            $table->bigIncrements('temp_purchase_id');
            $table->unsignedBigInteger('purchase_temporary_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('quantity');
            $table->float('discount');
            $table->float('vat');
            $table->float('temp_net_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_temporary_items');
    }
};
