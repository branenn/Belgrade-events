<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PromenaImenaKolonaUUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          
          $table->dropColumn('status'); 
          $table->dropColumn('uloga');      
        
             
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
          
           $table->enum('status', ['0', '1','2'])->after('email');
          $table->enum('uloga', ['0','1','2','3'])->after('status');
            
        });
    }
}
