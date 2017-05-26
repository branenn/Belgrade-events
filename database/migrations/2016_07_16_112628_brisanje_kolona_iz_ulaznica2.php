<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BrisanjeKolonaIzUlaznica2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ulaznicas', function (Blueprint $table) {
            $table->double('cena1')->after('id');
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
            $table->dropColumn('cena1');
        });
    }
}
