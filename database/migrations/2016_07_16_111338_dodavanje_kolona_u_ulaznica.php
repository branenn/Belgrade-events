<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DodavanjeKolonaUUlaznica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ulaznicas', function (Blueprint $table) {
            $table->integer('kol1')->after('cena1');
            $table->integer('kol2')->after('cena2');
            $table->renameColumn('kolicina','kol3');
            $table->dropColumn('cena1');
            
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
            $table->dropColumn('kol1');
            $table->dropColumn('kol2');
            $table->renameColumn('kol3','kolicina');
            $table->integer('cena1')->after('id');

        });
    }
}
