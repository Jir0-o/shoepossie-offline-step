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
        Schema::create('cart_cancel', function (Blueprint $table) {
            $table->comment('');
            $table->integer('cancel_id', true);
            $table->integer('cart_id');
            $table->integer('cancelled_by_id');
            $table->text('cancel_note');
            $table->date('cancel_time');
            $table->integer('last_delivery_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_cancel');
    }
};
