<?php

namespace App\Http\Controllers\Admin;


use App\Dogadjaj;
use App\Functions;
use App\Kategorija;
use App\Komentar;
use App\Rezervacija;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Mesto;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Stmt\Switch_;
use Validator;
use App\User;
use Hash;
use DB;




class AdminHomeKontroler extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {

            if (Auth::user()->uloga == 2) {
                return redirect('/admin/adminhome');
                //return view('admin.adminhome');
            } elseif (Auth::user()->uloga == 1) {
                return view('admin.blagajnik.blagajnikhome');
              
            } else {
                return redirect('/');
            }

        } else {
            return view('admin.login2');
        }

    }

    public function getAdminHome(){

        $users = User::all();
        $korisnici = array();
        foreach ($users as $user) {
            if ($user->created_at==$user->updated_at){
            $korisnici[] = $user;
            }
        }

        return view('admin.adminhome')
            ->with('korisnici', $korisnici);
    }

    public function getListaMesta(){

        $mesta=Mesto::all();
        
           return view('admin.listamesta')->with('mesta', $mesta);
    }

    public function getUpdateMesto($id)
    {
        $mestorada = Mesto::find($id);

        return view('admin.updatemesto')->with('mesto', $mestorada);
    }


    public function postUpdateMesto(Request $request)
    {

        $pravila = [
            'naziv' => 'required|max:40',
            'adresa' => 'required|max:50',
        ];

        $validator = Validator::make($request->all(), $pravila);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        } else {
            $mestorada = Mesto::find($request->id);


            $poruke=array();
            if ($request->naziv!= $mestorada->naziv) {
                $mestorada->naziv=$request->naziv;
                $poruke[]='Naziv mesta je promenjen.';
            }

            if ($request->adresa != $mestorada->adresa) {
                $mestorada->adresa=$request->adresa;
                $poruke[]='Adresa je promenjena.';
            }


            $mestorada->save();
            return redirect()->back()
                ->with('poruke', $poruke)
                ->withInput();


        }

    }




    public function getNovoMesto(){
        return view('admin.novomesto');
    }

    public function postNovoMesto(Request $request){

        $pravila = [
            'naziv' => 'required|max:40',
            'adresa' => 'required|max:50',
        ];

        $validator = Validator::make($request->all(), $pravila);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            if (!$this->upisMesta($request->all())) {
                return redirect()->back()->with('poruka', 'Greška prilikom dodavanja mesta u bazu.');
                exit();
            } else {
                return redirect()->back()->with('poruka', 'Mesto uspešno dodato u bazu.');

            }
        }

    }

    protected function upisMesta(array $data)
    {
        return Mesto::create([
            'naziv' => $data['naziv'],
            'adresa' => $data['adresa'],

        ]);
    }

    public function noviKorisnik()
    {
        if (Auth::check()) {
            $mesta = Mesto::all();
            return view('admin.novikorisnik')->with('mesta', $mesta);
        } else {
            return view('admin.login2');
        }
    }

    /*
        public function radnoMesto(){
            if(Auth::check()) {
                $mesta=Mesto::all();
                return view('admin.novikorisnik')->with('mesta', $mesta);
            }else{
                return view('admin.login2');
            }
        }
      */

    protected function dodajKorisnika(Request $request)
    {
        $rules = [
            'ime' => 'required|max:255',
            'prezime' => 'required|max:255',
            'username' => 'required|min:6|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'tel' => 'required|regex:/^\+?[^a-zA-Z]{5,}$/',

        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            if (!$this->upisKorisnika($request->all())) {
                return redirect()->back()->with('message', 'Greška prilikom dodavanja korisnika u bazu.');
                exit();
            } else {
                return redirect()->back()->with('message', 'Korisnik uspešno dodat u bazu.');

            }
        }
    }


    protected function upisKorisnika(array $data)
    {
        return User::create([
            'uloga' => $data['uloga'],
            'ime' => $data['ime'],
            'prezime' => $data['prezime'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'tel' => $data['tel'],
            'adresa' => $data['adresa'],
            'grad' => $data['grad'],
            'status' => $data['status'],
            'mesto_id' => $data['mesto_id'],

        ]);
    }

    public function listaKorisnika()
    {
        $users = User::all();

        $korisnici = array();
        foreach ($users as $user) {
            switch ($user->uloga) {
                case '0':
                    $user->uloga = 'Korisnik';
                    break;
                case '1':
                    $user->uloga = 'Blagajnik';
                    break;
                case '2':
                    $user->uloga = 'Administrator';
                    break;
                default:
                    $user->uloga = 'Nepoznata';
            }
            switch ($user->status) {
                case '0':
                    $user->status = 'Neaktivan';
                    break;
                case '1':
                    $user->status = 'Aktivan';
                    break;
                case '2':
                    $user->status = 'Blokiran';
                    break;
                default:
                    $user->status = 'Nepoznat';
            }
            $korisnici[] = $user;
        }
        return view('admin.listakorisnika')->with('korisnici', $korisnici);
    }

    public function updateKorisnik($id)
    {
        $user = User::find($id);
        $mestorada = Mesto::find($user->mesto_id);
       // if($mestorada==null){
        //    $mestorada->naziv='Nije postavljeno';
       // }

        $uloga = $this->switchUloga($user->uloga);
        $status = $this->switchStatus($user->status);


        return view('admin.updatekorisnik')
            ->with('user', $user)
            ->with('mestorada', $mestorada)
            ->with('status', $status)
            ->with('uloga', $uloga);
    }

    public function switchUloga($uloga)
    {
        switch ($uloga) {
            case '0':
                $uloga = 'Korisnik';
                break;
            case '1':
                $uloga = 'Blagajnik';
                break;
            case '2':
                $uloga = 'Administrator';
                break;
            default:
                $uloga = 'Nepoznata';
        }
        return $uloga;
    }

    public function switchStatus($status)
    {
        switch ($status) {
            case '0':
                $status = 'Neaktivan';
                break;
            case '1':
                $status = 'Aktivan';
                break;
            case '2':
                $status = 'Blokiran';
                break;
            default:
                $status = 'Nepoznat';
        }
        return $status;
    }

    public function postUpdateKorisnik(Request $request)
        {

        $pravila = [
            'ime' => 'required|max:255',
            'prezime' => 'required|max:255',
            'password' => 'min:6',
            'password_confirmation'=> 'same:password',
            'tel' => 'regex:/^\+?[^a-zA-Z]{5,}$/',

        ];

          $validator = Validator::make($request->all(), $pravila);
          if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput();

           } else {

                $korisnik = User::find($request->id);
                 
                 $poruke=array();
                        if ($request->ime!= $korisnik->ime) {
                            $korisnik->ime=$request->ime;
                            $poruke[]='Ime je promenjeno.';
                        }

                        if ($request->prezime != $korisnik->prezime) {
                            $korisnik->prezime=$request->prezime;
                            $poruke[]='Prezime je promenjeno.';
                        }
                       
                        if ($request->tel != $korisnik->tel) {
                            $korisnik->tel=$request->tel;
                            $poruke[]='Telefon je promenjen.';
                        }
                        if ($request->adresa != $korisnik->adresa) {
                            $korisnik->adresa=$request->adresa;
                            $poruke[]='Ulica i broj su promenjeni.';
                        }
                        if ($request->grad != $korisnik->grad) {
                            $korisnik->grad=$request->grad;
                            $poruke[]='Grad je promenjen.';
                        }
                        if ($request->password!=null){
                            if (Hash::check($request->password,$korisnik->password)){
                                $poruke[]='Lozinka je ista kao i prethodna.';
                            }else{
                                $korisnik->password=bcrypt($request->password);
                                $poruke[]='Lozinka je promenjena.';
                            }
                        }
                        if ($request->status != $korisnik->status) {
                            $korisnik->status=$request->status;
                            $poruke[]='Status je promenjen.';
                        }
                        if ($request->uloga != $korisnik->uloga) {
                            $korisnik->uloga=$request->uloga;
                            $poruke[]='Uloga je promenjena.';
                        }
                        if ($request->mesto_id != $korisnik->mesto_id) {
                            $korisnik->mesto_id=$request->mesto_id;
                            $poruke[]='Mesto rada je promenjeno.';
                        }

                        $korisnik->save();
                        return redirect()->back()
                            ->with('poruke', $poruke)
                            ->withInput();


                    }

    }

    public function getKorisniciTop10(){
        $rezervacije=Rezervacija::where('status_rezervacije',2)->where('user_id','!=',0)->get();
        $rezervacija=array();
        $nizID=array();
        foreach ($rezervacije as $rez){
            $nizID[] = $rez->user_id;
        }

        $bezduplihId=array_unique($nizID);
        foreach ($bezduplihId as $b){
            $rezervacija[$b]=Rezervacija::where('user_id',$b)->where('status_rezervacije',2)->sum('kolicina');

        }

        $korisnici=array();

             arsort($rezervacija);
             $rezervacija=array_slice($rezervacija, 0, 10, true);
             foreach ($rezervacija as $userid=>$brkuplj){
                 $korisnik=User::find($userid);
                $korisnik->brkuplj=$brkuplj;
                $korisnici[]=$korisnik;
            }


        return view('admin.korisnicitop10')->with('korisnici', $korisnici);
    }

    public function getKorisniciTop10M(){

        setlocale(LC_ALL,'serbian');
        $proslimesec=iconv('ISO-8859-2', 'UTF-8', strftime('%B', strtotime('-1 month', time())));
        $from = date("Y-m-d 00:00:00", strtotime("first day of previous month"));
        $to = date("Y-m-d 23:59:59", strtotime("last day of previous month"));


        $rezervacije=Rezervacija::where('status_rezervacije',2)->where('user_id','!=',0)->whereBetween('updated_at', array($from, $to))->get();
        $rezervacija=array();
        $nizID=array();
        foreach ($rezervacije as $rez){
            $nizID[] = $rez->user_id;
        }

        $bezduplihId=array_unique($nizID);
        foreach ($bezduplihId as $b){
            $rezervacija[$b]=Rezervacija::where('user_id',$b)->where('status_rezervacije',2)->whereBetween('updated_at', array($from, $to))->sum('kolicina');

        }

        $korisnici=array();

        arsort($rezervacija);
        $rezervacija=array_slice($rezervacija, 0, 10, true);
        foreach ($rezervacija as $userid=>$brkuplj){
            $korisnik=User::find($userid);
            $korisnik->brkuplj=$brkuplj;
            $korisnici[]=$korisnik;
        }


        return view('admin.korisnicitop10m')->with('korisnici', $korisnici)->with('proslimesec',$proslimesec);
    }


    public function getDogadjaji()
    {


        $komentar=Komentar::all();
        $dog1=array();
        foreach ($komentar as $kom){
        $dogNaziv = Dogadjaj::select('naziv')
            ->where('id',$kom->dogadjaj_id)
            ->groupBy('naziv')
             ->pluck('naziv');

        $dog1[]=$dogNaziv;
        }
        $dogiocenaUn=array();
        $dogiocena=array();
        foreach ($dog1 as $d1){

        $dddd = Dogadjaj::where('naziv', $d1)->get();

            foreach ($dddd as $dd){
            $komocena=Komentar::where('dogadjaj_id',$dd->id)->avg('ocena');

            $dd->ocena=$komocena;

                if ($dd->slike != null || $dd->slike != '') {
                    $slika = explode('**', $dd->slike);
                    $dd->malaslika = $slika[0];
                } else {
                    $dd->malaslika = 'malaprazna.jpg';
                }

                $dogiocenaUn[]=$dd;

            }
        }
            $dogiocena=array_unique($dogiocenaUn);
            $dogiocenasort=array();
            foreach ($dogiocena as $n=>$dog) {

                $dogiocenasort[] = $dog->orderBy('naziv');
            }

        $sortiranje='';
        if(isset($_GET['sortiranje'])) {
            $sortiranje=$_GET['sortiranje'];

            if($sortiranje==1){
                usort($dogiocena, function($a, $b) { //Sort the array using a user defined function
                    return $a->naziv > $b->naziv ? 1 : -1; //Compare the scores
                });
            }
            if($sortiranje==2){
                usort($dogiocena, function($a, $b) { //Sort the array using a user defined function
                    return $a->naziv > $b->naziv ? -1 : 1; //Compare the scores
                });
            }
            if($sortiranje==3){
                usort($dogiocena, function($a, $b) { //Sort the array using a user defined function
                    return $a->ocena > $b->ocena ? 1 : -1; //Compare the scores
                });
            }
            if($sortiranje==4){
                usort($dogiocena, function($a, $b) { //Sort the array using a user defined function
                    return $a->ocena > $b->ocena ? -1 : 1; //Compare the scores
                });
            }
            if($sortiranje==5){
                usort($dogiocena, function($a, $b) { //Sort the array using a user defined function
                    return $a->id > $b->id ? 1 : -1; //Compare the scores
                });
            }
            if($sortiranje==6){
                usort($dogiocena, function($a, $b) { //Sort the array using a user defined function
                    return $a->id > $b->id ? -1 : 1; //Compare the scores
                });
            }

        }


        return view('admin.dogadjaji')->with('dog',$dogiocena)->with('sortiranje',$sortiranje);
        
    }



}
