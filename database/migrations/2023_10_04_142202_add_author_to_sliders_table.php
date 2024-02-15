<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorToSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('short_description', 191)->nullable();
            $table->string('short_description_color', 191)->nullable();
            $table->enum('call_support_status', array('1','0'))->default('0');
            $table->string('call_title', 191)->nullable();
            $table->string('call_title_color', 191)->nullable();
            $table->string('call_no', 191)->nullable();
            $table->string('call_no_color', 191)->nullable();
            $table->string('call_icon_color', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            //
        });
    }
}
