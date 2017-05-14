<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PromenaImenaTabeleUsers2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
        public function up()
    {       
        Schema::rename('users', 'users_old');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('users_old', 'users');
    }
    
}
