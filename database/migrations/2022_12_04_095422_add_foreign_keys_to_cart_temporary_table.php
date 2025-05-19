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
        Schema::table('cart_temporary', function (Blueprint $table) {
            $table->foreign(['consumer_id'], 'cart_temporary_ibfk_1')->references(['login_id'])->on('consumer_login')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_temporary', function (Blueprint $table) {
            $table->dropForeign('cart_temporary_ibfk_1');
        });
    }
};
