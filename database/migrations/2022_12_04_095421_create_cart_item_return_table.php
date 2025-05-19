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
        Schema::create('cart_item_return', function (Blueprint $table) {
            $table->comment('');
            $table->integer('cart_item_return_id', true);
            $table->integer('login_id')->nullable()->index('consumer_id');
            $table->integer('cart_id')->nullable()->index('cart_id');
            $table->integer('cart_item_id')->index('cart_item_id');
            $table->integer('received_by_id')->nullable()->index('received_by_id');
            $table->string('reason_of_return', 128)->nullable();
            $table->string('total_amount', 128)->nullable();
            $table->string('non_refundable_vat', 128)->nullable();
            $table->string('refund_amount', 128)->nullable();
            $table->string('return_date', 32)->nullable();
            $table->integer('authorized_by')->nullable();
            $table->string('authorize_date', 32)->nullable();
            $table->string('return_status', 11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_item_return');
    }
};
