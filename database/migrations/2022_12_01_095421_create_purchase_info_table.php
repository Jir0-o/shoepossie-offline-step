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
        Schema::create('purchase_info', function (Blueprint $table) {
            $table->bigIncrements('purchase_id');
            $table->string('ref_no', 128)->nullable();
            $table->integer('supplier_id')->index('supplier_id');
            $table->string('pur_date', 128)->nullable();
            $table->float('total_item_price',128)->nullable();
            $table->float('discount', 128)->nullable();
            $table->float('total_payable', 128)->nullable();
            $table->float('paid_status', 10)->nullable();
            $table->text('notes')->nullable();
            $table->integer('store_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_info');
    }
};
