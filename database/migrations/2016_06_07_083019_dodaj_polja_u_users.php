<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DodajPoljaUUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->after('name');
            $table->string('username')->unique()->after('lastname');
            $table->string('adresa')->after('password');
            $table->string('tel')->after('adresa');
            $table->enum('status', ['0', '1','2'])->after('email');
            $table->enum('uloga', ['0','1','2','3'])->after('status');
            $table->string('radnomesto')->after('uloga');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
            
            
    $table->dropColumn(['lastname', 'username', 'adresa','tel','status','uloga','radnomesto']);
        
            
            
            
          
        });
    }
}
