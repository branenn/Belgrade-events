<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RedosledKolonaUUlaznica2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ulaznicas', function (Blueprint $table) {
            $table->double('cena3')->after('cena2');
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
          $table->dropColumn('cena3');
        });
    }
}
