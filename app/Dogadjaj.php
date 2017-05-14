<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dogadjaj extends Model
{
    protected $table = 'dogadjajs';
    protected $fillable = [
       'naziv', 'vreme_odr', 'opis_s', 'opis_p', 'slike', 'arhiva', 'mesto_id', 'max_br_ul', 'max_rez_date',
    ];

    public function mesto(){
        return $this->belongsTo('App\Dogadjaj');
    }

    public function ulaznica(){
        return $this->hasMany('App\Ulaznica');
    }

    public function komentar(){
        return $this->hasMany('App\Komentar');
    }



}
