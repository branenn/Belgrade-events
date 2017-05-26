<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DodavanjeKoloneMaxRezDateUUlaznicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ulaznicas', function (Blueprint $table) {
            $table->integer('max_rez_date')->after('max_br');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ulaznicas', function (Blueprint $table) {
           $table->dropColumn('max_rez_date');
        });
    }
}
