<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IzmenaKolonaUTabeliUlaznica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ulaznicas', function (Blueprint $table) {
            $table->renameColumn('kategorija','cena1')->double();
            $table->renameColumn('cena','cena2');
            $table->double('cena3');

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
            $table->renameColumn('cena1','kategorija')->integer();
            $table->renameColumn('cena2','cena');
            $table->dropColumn('cena3');
        });
    }
}
