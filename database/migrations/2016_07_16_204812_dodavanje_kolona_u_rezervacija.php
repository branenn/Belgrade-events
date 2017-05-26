<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DodavanjeKolonaURezervacija extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rezervacijas', function (Blueprint $table) {
           $table->integer('kol1');
           $table->integer('kol2');
           $table->integer('kol3');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rezervacijas', function (Blueprint $table) {
           $table->dropColumn('kol1');
           $table->dropColumn('kol2');
           $table->dropColumn('kol3');
        });
    }
}
