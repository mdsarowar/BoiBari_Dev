<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmincustomisations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admincustomisations', function (Blueprint $table) {
            $table->id();
            $table->string('bg_grey_color', 191);
            $table->string('bg_white_color', 191);
            $table->string('text-grey-color', 191);
            $table->string('text_dark_color', 191);
            $table->string('text_white_color', 191);
            $table->string('text_blue_color', 191);
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
        Schema::dropIfExists('admincustomisations');
    }
}
