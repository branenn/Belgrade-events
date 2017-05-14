<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Hash;
use Auth;
use App\User;

class PasswChangeKontroler extends Controller
{
   // public function password() {
   //     return view('home');
        
   // }
    
   protected function updatePassword(Request $request){
       $rules= [
            'password' => 'required',
           // 'new_password' => 'required|confirmed|min:6',
           'new_password' => 'required|min:6',
           'new_password_confirmation'=> 'required|same:new_password'
              
       ]; 
    /*   $messages=[
           'password.required' => 'Niste uneli trenutni password',
           'new_password.required' => 'Niste uneli novi password',
           'new_password.confirmed' => 'Niste uneli isti novi password',
           'new_password.min' => 'Password mora da bude min. 6 karaktera',
       ];
     
       $validator = Validator::make($request->all(),$rules,$messages);
    */
       $validator = Validator::make($request->all(),$rules);
       if($validator->fails()){
           return redirect()->back()->withErrors($validator);
                   
       }
       else{
           
           if(Hash::check($request->new_password,Auth::user()->password)){
               return redirect()->back()->with('message','Lozinka ne može biti ista kao i prethodna');
               exit();
           }
           else if(Hash::check($request->password,Auth::user()->password)){
                $user= new User;
                $user->where('username','=', Auth::User()->username)
                     ->update(['password' => bcrypt($request->new_password)]);
            /*Ovo dole ne moze 
               User::update(['password' => bcrypt($request->new_password)])
               ->where('username','=', Auth::User()->username);
            */
              
                return redirect()->back()->with('message','Pasword uspešno promenjen. Prijavite se sa novim passwordom.')->with(Auth::logout());
                //return redirect('logout')->with('message','Pasword uspešno promenjen. Prijavite se sa novim passwordom.')->with(Auth::logout());
           }
           else{
               return redirect()->back()->with('message','Pogrešna Lozinka');
           }
       }
       
       
        
        
    }
    
}
