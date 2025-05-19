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
        Schema::create('purchase_temporaries', function (Blueprint $table) {
            $table->bigIncrements('purchase_temporary_id');
            $table->unsignedBigInteger('temporary_consumer_id');
            $table->unsignedBigInteger('consumer_id');
            $table->string('create_date');
            $table->string('from_ip');
            $table->string('created_by');
            $table->string('sales_type');
            $table->string('is_suspented');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_temporaries');
    }
};
