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
        Schema::table('cart_item_return', function (Blueprint $table) {
            $table->foreign(['login_id'], 'cart_item_return_ibfk_2')->references(['login_id'])->on('consumer_login')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['received_by_id'], 'cart_item_return_ibfk_4')->references(['login_id'])->on('backoffice_login');
            $table->foreign(['cart_id'], 'cart_item_return_ibfk_1')->references(['cart_id'])->on('cart_informtion')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['cart_item_id'], 'cart_item_return_ibfk_3')->references(['cart_item_id'])->on('cart_items')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_item_return', function (Blueprint $table) {
            $table->dropForeign('cart_item_return_ibfk_2');
            $table->dropForeign('cart_item_return_ibfk_4');
            $table->dropForeign('cart_item_return_ibfk_1');
            $table->dropForeign('cart_item_return_ibfk_3');
        });
    }
};
