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
        Schema::table('cart_payment_information', function (Blueprint $table) {
            $table->foreign(['payment_method_id'], 'cart_payment_information_ibfk_2')->references(['payment_method_id'])->on('cart_payment_methods');
            $table->foreign(['cart_id'], 'cart_payment_information_ibfk_1')->references(['cart_id'])->on('cart_informtion')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_payment_information', function (Blueprint $table) {
            $table->dropForeign('cart_payment_information_ibfk_2');
            $table->dropForeign('cart_payment_information_ibfk_1');
        });
    }
};
