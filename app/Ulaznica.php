<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ulaznica extends Model
{
    protected $table = 'ulaznicas';
    protected $fillable = [
         'dogadjaj_id',
    ];

    public function dogadjaj(){
        return $this->belongsTo('App\Dogadjaj');
    }

    public function rezervacija(){
        return $this->hasMany('App\Rezervacija');
    }
    public function kategorija(){
        return $this->hasMany('App\Kategorija');
    }
}
