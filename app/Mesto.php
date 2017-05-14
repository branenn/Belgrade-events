<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Mesto extends Model
{
    protected $table = 'mestos';
    protected $fillable = [
       'naziv', 'adresa',
    ];

    public function user(){
        return $this->hasMany('App\User');
    }

    public function dogadjaj(){
        return $this->hasMany('App\Dogadjaj');
    }

}
