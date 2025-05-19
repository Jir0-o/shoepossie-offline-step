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
        Schema::create('cart_temporary', function (Blueprint $table) {
            $table->comment('');
            $table->integer('temp_cart_id', true);
            $table->integer('temporary_consumer_id')->nullable();
            $table->integer('consumer_id')->nullable()->index('consumer_id');
            $table->string('create_date', 32)->nullable();
            $table->string('from_ip', 15)->nullable();
            $table->integer('created_by');
            $table->string('table_no', 32)->nullable();
            $table->integer('waiter_id')->nullable();
            $table->string('expected_delivery_date', 32)->nullable();
            $table->integer('sales_type')->default(1);
            $table->integer('is_suspended')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_temporary');
    }
};
