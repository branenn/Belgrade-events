<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentars';
    protected $fillable = [
        'komentar', 'datum', 'ocena', 'dogadjaj_id','user_id',
    ];

    public function dogadjaj(){
        return $this->hasOne('App\Dogadjaj');
    }
}
