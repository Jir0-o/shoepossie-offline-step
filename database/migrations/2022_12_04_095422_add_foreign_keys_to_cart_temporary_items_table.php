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
        Schema::table('cart_temporary_items', function (Blueprint $table) {
            $table->foreign(['product_id'], 'cart_temporary_items_ibfk_2')->references(['product_id'])->on('products');
            $table->foreign(['temp_cart_id'], 'cart_temporary_items_ibfk_1')->references(['temp_cart_id'])->on('cart_temporary')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_temporary_items', function (Blueprint $table) {
            $table->dropForeign('cart_temporary_items_ibfk_2');
            $table->dropForeign('cart_temporary_items_ibfk_1');
        });
    }
};
