<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandlingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handling_charges', function (Blueprint $table) {
            $table->id();
            $table->string('payment_getway_name', 255);
            $table->string('price', 255);
            $table->string('global_price', 255);
			$table->enum('Type_of_charge', array('global','custom'));
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
        Schema::dropIfExists('handling_charges');
    }
}
