<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingCoupans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_coupans', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name', 255);
            $table->enum('status', array('0','1'));
            $table->string('coupan_type', 255);
            $table->integer('number_of_price', 11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_coupans');
    }
}
