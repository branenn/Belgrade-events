<?php

use Illuminate\Database\Seeder;

class podaci_za_tabelu_mesto extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mesto=array('naziv'=>'Kombank Arena', 'adresa'=>'Novi Beograd');
        DB::table('mestos')->insert($mesto);
    }
}
