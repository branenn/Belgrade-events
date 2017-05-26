<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NapraviTabeluRezervacija extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rezervacijas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('datum_rezervacije');
            $table->string('vazi_do');
            $table->integer('status_rezervacije');
            $table->integer('user_id');
            $table->integer('ulaznica_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rezervacijas');
    }
}
