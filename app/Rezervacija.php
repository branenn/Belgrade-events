<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rezervacija extends Model
{
    protected $table = 'rezervacijas';
    protected $fillable = [
        'datum_rezervacije', 'vazi_do', 'status_rezervacije', 'user_id', 'ulaznica_id', 'kategorija_id', 'kolicina',
    ];
    public function ulaznica(){
        return $this->belongsTo('App\Ulaznica');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
