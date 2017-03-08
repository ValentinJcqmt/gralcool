<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceUserVirtuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_user_virtues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
//            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('place_id')->unsigned();
//            $table->foreign('place_id')->references('id')->on('places');
            $table->integer('virtue_id')->unsigned();
//            $table->foreign('virtue_id')->references('id')->on('virtues');
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
        Schema::dropIfExists('place_user_virtues');
    }
}
