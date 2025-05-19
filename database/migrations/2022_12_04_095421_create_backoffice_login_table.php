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
        Schema::create('backoffice_login', function (Blueprint $table) {
            $table->comment('');
            $table->integer('login_id', true);
            $table->integer('office_user_id');
            $table->string('full_name', 256)->nullable();
            $table->string('user_email', 128);
            $table->string('login_user_name', 32);
            $table->string('login_user_pass', 512);
            $table->string('user_image', 32)->nullable();
            $table->integer('role_id');
            $table->string('token', 512)->nullable();
            $table->date('last_login')->nullable();
            $table->integer('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('backoffice_login');
    }
};
