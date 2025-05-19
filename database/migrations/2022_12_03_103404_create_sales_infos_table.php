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
        Schema::create('sales_infos', function (Blueprint $table) {
            $table->bigIncrements('sales_info_id');
            $table->string('date')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->float('total_item_price')->nullable();
            $table->float('vat')->nullable();
            $table->float('discount')->nullable();
            $table->float('total_payable')->nullable();
            $table->string('sales_type')->nullable();
            $table->string('paid_status')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('sales_infos');
    }
};
