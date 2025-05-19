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
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign(['product_id'], 'cart_items_ibfk_2')->references(['product_id'])->on('products');
            $table->foreign(['cart_id'], 'cart_items_ibfk_1')->references(['cart_id'])->on('cart_informtion')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['unit_id'], 'cart_items_ibfk_4')->references(['unit_id'])->on('unit_definition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign('cart_items_ibfk_2');
            $table->dropForeign('cart_items_ibfk_1');
            $table->dropForeign('cart_items_ibfk_4');
        });
    }
};
