<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategorija extends Model
{
    protected $table = 'kategorijas';
    protected $fillable = [
        'kategorija', 'naziv', 'cena', 'kolicina','ulaznica_id',
    ];

    public function ulaznica(){
        return $this->belongsTo('App\Ulaznica');
    }

}
