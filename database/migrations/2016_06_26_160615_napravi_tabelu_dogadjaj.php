<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NapraviTabeluDogadjaj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dogadjajs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naziv');
            $table->string('vreme_odr_od');
            $table->string('vreme_odr_do');
            $table->text('opis');
            $table->text('uploads');
            $table->text('video');
            $table->integer('arhiva');
            $table->integer('mesto_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dogadjajs');
    }
}
