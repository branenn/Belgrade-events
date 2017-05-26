<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NapraviTabeluUlaznica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulaznicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kategorija');
            $table->double('cena');
            $table->integer('kolicina');
            $table->integer('max_br');
            $table->integer('dogadjaj_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ulaznicas');
    }
}
