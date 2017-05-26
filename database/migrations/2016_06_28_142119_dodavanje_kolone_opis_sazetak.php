<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DodavanjeKoloneOpisSazetak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dogadjajs', function (Blueprint $table) {
            $table->renameColumn('opis', 'opis_s');
            $table->renameColumn('video', 'opis_p')->after('opis_s');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dogadjajs', function (Blueprint $table) {
            $table->renameColumn('opis_s', 'opis');
            $table->renameColumn('opis_p', 'video');
        });
    }
}
