<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BrisanjeKolonaIzUlaznica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ulaznicas', function (Blueprint $table) {
            $table->dropColumn('max_br');
            $table->dropColumn('max_rez_date');
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
            $table->integer('max_br');
            $table->timestamp('max_rez_date');
        });
    }
}
