<?php

use Illuminate\Database\Seeder;

class podaci_za_tabelu_mesto5 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $five=array('naziv'=>'Dom omladine', 'adresa'=>'Makedonska 22/IV');
        //$six=array('naziv'=>'Atelje 212', 'adresa'=>'Svetogorska 21');
        DB::table('mestos')->insert($five);
    }
}
