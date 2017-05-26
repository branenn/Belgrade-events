<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


use DB;
use Auth;



class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    
    protected $fillable = [
        'ime', 'prezime', 'username', 'password', 'adresa', 'grad', 'tel', 'email','status', 'uloga', 'mesto_id', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function mesto(){
        return $this->belongsTo('App\Mesto');
    }
    public function rezervacija(){
        return $this->hasMany('App\Rezervacija');
    }


  






 /*   protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password', 'status');
    }
   */

    
    
    /*
    
    public function roles() 
{
   return $this->belongsToMany(App\Role::class);
}
public function isAdmin() 
{
   return $this->roles()->where('role_id', 1)->first();
}
    
    public function proveraStatusa($korisnik){



         $status=DB::table('users')->select('status')->where('username','=',$korisnik)->first();


             switch ($status->status){
                 case "0":
                            $korstatus='neaktivan';
                     break;
                 case "1":
                            $korstatus='aktivan';
                     break;
                 case "2":
                            $korstatus='blokiran';
                     break;
                 default:
                            $korstatus='neaktivan';
             }
        return $korstatus;
    }


    public static function uloga($korisnik){
        $uloga= DB::table('users')->select('uloga')->where('username','=',$korisnik)->first();
        switch ($uloga->uloga){
            case "0":
                $uloga='korisnik';
                break;
            case "1":
                $uloga='blagajnik';
                break;
            case "2":
                $uloga='administrator';
                break;
            default:
                $uloga='korisnik';
        }

    }

*/


}