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
        Schema::create('cart_informtion', function (Blueprint $table) {
            $table->comment('');
            $table->integer('cart_id', true);
            $table->integer('consumer_id')->nullable();
            $table->string('cart_date', 32)->nullable();
            $table->integer('cart_status')->nullable();
            $table->integer('payment_method_id')->nullable()->index('payment_method_id');
            $table->float('total_cart_amount', 10, 0)->nullable();
            $table->float('vat_amount', 10, 0)->nullable()->default(0);
            $table->float('total_discount', 10, 0)->nullable()->default(0);
            $table->float('total_payable_amount', 10, 0)->nullable();
            $table->float('gross_profit', 10, 0)->nullable();
            $table->float('payment_method_charge', 10, 0)->nullable();
            $table->float('final_total_amount', 10, 0)->nullable();
            $table->double('paid_amount')->nullable();
            $table->double('due_amount')->nullable()->default(0);
            $table->float('net_profit', 10, 0)->nullable();
            $table->string('delivery_date', 32)->nullable();
            $table->string('table_no', 32)->nullable();
            $table->integer('waiter_id')->nullable();
            $table->integer('sales_type')->default(1);
            $table->integer('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_informtion');
    }
};
