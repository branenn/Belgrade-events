<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PromenaKolonaUDogadjajs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dogadjajs', function (Blueprint $table) {
           $table->renameColumn('vreme_odr_od','vreme_odr');
            $table->dropColumn('vreme_odr_do');
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
            $table->renameColumn('vreme_odr','vreme_odr_od');
            $table->timestamp('vreme_odr_do');
        });
    }
}
