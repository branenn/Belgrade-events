<?php

use Illuminate\Database\Seeder;

class podaci_za_tabelu_mesto6 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $six=array('naziv'=>'Atelje 212', 'adresa'=>'Svetogorska 21');
        DB::table('mestos')->insert($six);
    }
}
