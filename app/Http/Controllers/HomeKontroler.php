<?php

namespace App\Http\Controllers;

use App\Komentar;
use App\Rezervacija;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Dogadjaj;
use App\Mesto;
use Auth;
use App\Functions;
use App\Ulaznica;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Validator;
use App\Kategorija;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use DB;

class HomeKontroler extends Controller
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


        $dog=array();
        $dogadjaji=Dogadjaj::all()->where('arhiva',0)->reverse()->take(5);

        foreach ($dogadjaji as $dogadjaj) {
            if ($dogadjaj->slike!=null || $dogadjaj->slike!=''){
                $slika = explode('**', $dogadjaj->slike);
                $dogadjaj->malaslika = $slika[0];
            }
            else{
                $dogadjaj->malaslika = 'malaprazna.jpg';
            }
            $mesta = Mesto::find($dogadjaj->mesto_id);
            $dogadjaj->mesto = $mesta->naziv;
            $dogadjaj->vreme_odr_dan=Functions::ispisDatuma2($dogadjaj->vreme_odr);
            $dogadjaj->vreme_odr_sat=Functions::ispisVremena($dogadjaj->vreme_odr);

            $dog[]=$dogadjaj;

        }

        return view('home')
            ->with('dog',$dog);

    }
    public function getSviDogadjaji(){

        $dog=array();
        $dogadjaji=Dogadjaj::all()->where('arhiva',0)->reverse();

        foreach ($dogadjaji as $dogadjaj) {
            if ($dogadjaj->slike!=null || $dogadjaj->slike!=''){
                $slika = explode('**', $dogadjaj->slike);
                $dogadjaj->malaslika = $slika[0];
            }
            else{
                $dogadjaj->malaslika = 'malaprazna.jpg';
            }
            $mesta = Mesto::find($dogadjaj->mesto_id);
            $dogadjaj->mesto = $mesta->naziv;
            $dogadjaj->vreme_odr_dan=Functions::ispisDatuma2($dogadjaj->vreme_odr);
            $dogadjaj->vreme_odr_sat=Functions::ispisVremena($dogadjaj->vreme_odr);

            $dog[]=$dogadjaj;

        }

        $stranice=$this->promenastrane($dog,5);

        return view('svidogadjaji')
            //->with('dog',$dog)
            ->with('stranice', $stranice);

    }

   // public function promenastrane($niz,$poStrani,$prvaStrana=1){
        public function promenastrane($items,$perPage)
        {
            $pageStart = \Request::get('page', 1);
            // Start displaying items from this number;
            $offSet = ($pageStart * $perPage) - $perPage;

            // Get only the items you need using array_slice
            $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

            return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
        }

    public function detaljiDogadjaj($id){

        if (Auth::check()) {
            $dogadjaj = Dogadjaj::find($id);
            $mesto = Mesto::find($dogadjaj->mesto_id);

            if ($dogadjaj->slike!=null || $dogadjaj->slike!=''){
                $slika = explode('**', $dogadjaj->slike);
                $dogadjaj->velikaslika = $slika[1];
            }
            else{
                $dogadjaj->velikaslika = 'velikaprazna.jpg';
            }
            $dogadjaj->vreme_odr_dan = Functions::ispisDatuma2($dogadjaj->vreme_odr);
            $dogadjaj->vreme_odr_sat = Functions::ispisVremena($dogadjaj->vreme_odr);

            if($dogadjaj->max_rez_date == null || $dogadjaj->max_rez_date ==''){
                $dogadjaj->max_rez_date = Functions::minusTriDana($dogadjaj->vreme_odr);
            }
            $dogadjaj->max_rez_date_dan = Functions::ispisDatuma2($dogadjaj->max_rez_date);
            $dogadjaj->max_rez_date_cas = Functions::ispisVremena($dogadjaj->max_rez_date);



            $ulaznica = Ulaznica::where('dogadjaj_id', $id)->firstOrFail();

            $kategorija = Kategorija::where('ulaznica_id', $ulaznica->id)->get();
            $sveRezervacijeDogadjaja= Rezervacija::where('ulaznica_id', $ulaznica->id)->where('status_rezervacije',1)->where('vazi_do','>=',Carbon::now())->get();

            $zbirrezervisanih=0;
            foreach ($sveRezervacijeDogadjaja as $svekey=>$svevalue){

                $zbirrezervisanih+=$svevalue->kolicina;
            }
            $rezervacija= Rezervacija::where('ulaznica_id', $ulaznica->id)->where('user_id',Auth::user()->id)->get();



                if (!$rezervacija->isEmpty()){


                foreach($rezervacija as $r=>$p){
                   if($p->status_rezervacije==1 || $p->status_rezervacije==2){
                        $rez=true;
                        //postoji rezervacija, ne moze da rezervise ulaznice
                       // $poruka='Postoji rezervacija. Ne možete opet rezervisati ulaznice ako prethodne niste kupili';

                    }else{
                        $rez=false;
                    }

                }

            }
            else{

                $rez=false;
            }
            $korkomentar=Komentar::where('dogadjaj_id',$dogadjaj->id)->where('user_id', Auth::user()->id)->get();
            if (!$korkomentar->isEmpty()){
            $korkom=true;
            }else{
            $korkom=false;
        }
            $komDog=Dogadjaj::where('naziv',$dogadjaj->naziv)->get();
            $svikomentari=array();
            foreach ($komDog as $komd){
            $komentariPoNazivuDog=Komentar::where('dogadjaj_id',$komd->id)->get();
                foreach ($komentariPoNazivuDog as $kmn){
                    $kmn->username=User::where('id',$kmn->user_id)->pluck('username')->first();
                    $kmn->dan=Functions::ispisDatuma2($kmn->datum);
                    $kmn->vreme=Functions::ispisVremena($kmn->datum);
                    $kmn->vreme_odr_dan=Functions::ispisDatuma2($komd->vreme_odr);
                    $kmn->vreme_odr_sat=Functions::ispisVremena($komd->vreme_odr);
                    $svikomentari[]=$kmn;
                }

            }

                return view('dogdetalji')
                ->with('dogadjaj', $dogadjaj)
                ->with('mesto', $mesto)
                ->with('ulaznica', $ulaznica)
                ->with('rez',$rez)
                ->with('rezervacija',$rezervacija)
                ->with('kategorija', $kategorija)
                ->with('zbirrezervisanih',$zbirrezervisanih)
                ->with('korkom',$korkom)
                ->with('svikomentari',$svikomentari);

        }
        else{
            return view('auth.register');
            
        }

    }
    
    public function postPostaviKomentar(Request $request){

        $pravila = [
            'tekst_komentara'=>'max:400',
        ];

        $validator = Validator::make($request->all(), $pravila);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            if (!$this->upisKomentara($request->all())) {
                return redirect()->back()->with('komporuka', 'Greška prilikom dodavanja komentara.');
                exit();
            }else {
                return Redirect::to(URL::previous() . "#komentar")->with('komporuka', 'Hvala vam na komentaru.');
                //return Redirect::to(URL::previous() . "#whatever");
            }
        }

    }

    protected function upisKomentara(array $data)
    {

        return Komentar::create([
            'komentar' => $data['tekst_komentara'],
            'datum' => Carbon::now(),
            'ocena' => $data['ocena'],
            'user_id' => Auth::user()->id,
            'dogadjaj_id' => $data['dogid'],

        ]);
    }

    public function postRezervacijaUlaznica(Request $request){


        $rules = [

            'kolicina'=>'required|numeric',
            'kategorija'=>'required',

        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

// mora prvo provera ako je vec rezervisao taj dogadjaj pa cak mislim da ne treba da mu se prikaze mogucnost da ponovo rezervise taj dogadjaj vec samo da ga je rezervisao ili samo mozda link ka rezervacijama
            /*
            status rezervacije = rezervisan, otkazan, kupljen
ako je status korisnika blokiran nema pravo da rezervise ulaznice(moze u rezervacijama taj status a moze i u users, bolje u users zato sto moze da se odblokira)
provera ako je status= rezervisan(1) korisnik nemoze da rezervise ulaznice za isti dogadjaj(ako nije rezervisan ili je kupljen ida moze)
provera po korisnickom id ako postoje trri rezeervacije u kojima je status rezervisan = 1 a datum isteka manji od danas onda se status korisnika menja u blokiran

*/
            if (Auth::user()->status!=1){
                return redirect()->back()->with('message', 'Greška! Korisnički nalog blokiran ili neaktivan.');
                exit();
            }else{

                $sveRezervacije=Rezervacija::all()->where('user_id',Auth::user()->id)->where('status_rezervacije',1);
                $brojac=0;
                foreach ($sveRezervacije as $kljuc=>$vrednost){
                    if(strtotime($vrednost->vazi_do)<time()){
                         $brojac++;
                     }
                }
                    if ($brojac>=3){
                        $korisnik=User::where('id',Auth::user()->id)->firstOrFail();
                        $korisnik->status=2;
                        $korisnik->save();
                        Auth::logout();
                        return redirect('/login')->with('message', 'Vaš nalog je blokiran! Imate tri nerealizovane rezervacije.');
                    exit();
                }else{

                        $sveRezervacijeDogadjaja= Rezervacija::where('ulaznica_id', $request->ulaznica_id)->where('status_rezervacije',1)->where('vazi_do','>=',Carbon::now())->get();
                        $zbirrezervisanih=0;
                            foreach ($sveRezervacijeDogadjaja as $svekey=>$svevalue){
                                $zbirrezervisanih+=$svevalue->kolicina;
                            }
                        $kat=Kategorija::where('id',$request->kategorija)->firstOrFail();
                        $raspolozivoUlaznica=$kat->kolicina-$zbirrezervisanih;

                            if(($raspolozivoUlaznica-$request->kolicina)<0){
                                return redirect()->back()->with('message', 'Greška! Možete rezervisati samo ' .$raspolozivoUlaznica . ' ulaznica.');
                            }else{
                                if (!$this->upisRezervacije($request->all())) { //i napraviti ako ispunjava uslove sto se tice datuma i dr
                                return redirect()->back()->with('message', 'Greška prilikom dodavanja rezervacije u bazu.');
                                exit();
                                }else {
                                    return redirect()->back()->with('message', 'Dogadjaj uspešno rezervisan.');
                                }

                            }
                    }

            }

        }



    }

    protected function upisRezervacije(array $data)
    {

        return Rezervacija::create([
            'datum_rezervacije' => date('Y-m-d H:i:s'),
            'vazi_do' => Functions::zaDvaDana(),
            'status_rezervacije' => 1,
            'user_id' => Auth::user()->id,
            'ulaznica_id' => $data['ulaznica_id'],
            'kategorija_id' => $data['kategorija'],
            'kolicina' => $data['kolicina'],
        ]);
    }


    public function mojeRezervacije(){

        $mojerez=Rezervacija::all()->where('user_id', Auth::user()->id)->where('status_rezervacije',1);


        $brojac=0;
        foreach ($mojerez as $kljuc=>$vrednost){
            if(strtotime($vrednost->vazi_do)<time()){
                $brojac++;
            }
        }
        if ($brojac>=3) {
            $korisnik = User::where('id', Auth::user()->id)->firstOrFail();
            $korisnik->status = 2;
            $korisnik->save();

            $poruka='Vaš nalog je blokiran! Imate tri nerealizovane rezervacije.';
            Auth::logout();
            return redirect('/login')->with('message',$poruka);
            exit();
        }
        else {


            $mojerezniz = array();
            $kategorijaniz = array();
            $dogadjajniz = array();

            foreach ($mojerez as $rezkey => $rezvalue) {
                $rezvalue->datum_rez = Functions::ispisDatuma2($rezvalue->datum_rezervacije);
                $rezvalue->vreme_rez = Functions::ispisVremena($rezvalue->datum_rezervacije);
                $rezvalue->datum_vazi_do = Functions::ispisDatuma2($rezvalue->vazi_do);
                $rezvalue->vreme_vazi_do = Functions::ispisVremena($rezvalue->vazi_do);
                $mojerezniz[] = $rezvalue;


                $ulaznica = Ulaznica::all()->where('id', $rezvalue->ulaznica_id);
                foreach ($ulaznica as $ulazkey => $ulazvalue) {

                    $kategorija = Kategorija::all()->where('ulaznica_id', $ulazvalue->id);
                    foreach ($kategorija as $katkey => $katvalue) {
                        $kategorijaniz[] = $katvalue;
                    }

                    $dogadjaj = Dogadjaj::all()->where('id', $ulazvalue->dogadjaj_id);
                    foreach ($dogadjaj as $dogkey => $dogvalue) {
                        if ($dogvalue->slike != null || $dogvalue->slike != '') {
                            $slika = explode('**', $dogvalue->slike);
                            $dogvalue->malaslika = $slika[0];
                        } else {
                            $dogvalue->malaslika = 'malaprazna.jpg';
                        }
                        $dogvalue->datum_odr = Functions::ispisDatuma2($dogvalue->vreme_odr);
                        $dogvalue->vreme_odr = Functions::ispisVremena($dogvalue->vreme_odr);


                        $mesto = Mesto::all()->where('id', $dogvalue->mesto_id);
                        foreach ($mesto as $mestokey => $mestovalue) {
                            $dogvalue->mesto = $mestovalue->naziv;
                        }

                        $dogadjajniz[] = $dogvalue;
                    }
                }

            }

            return view('mojerezervacije')
                ->with('mojerezniz', $mojerezniz)
                ->with('kategorijaniz', $kategorijaniz)
                ->with('dogadjajniz', $dogadjajniz);

        }
    }

    public function kupljeneUlaznice(){

        $mojerez1=Rezervacija::all()->where('user_id', Auth::user()->id)->where('status_rezervacije',2);

        $mojerezniz1=array();
        $kategorijaniz1=array();
        $dogadjajniz1=array();

        foreach ($mojerez1 as $rezkey1=>$rezvalue1){

            $mojerezniz1[]=$rezvalue1;

            $ulaznica1=Ulaznica::all()->where('id',$rezvalue1->ulaznica_id);
            foreach ($ulaznica1 as $ulazkey1=>$ulazvalue1) {

                $kategorija1=Kategorija::all()->where('ulaznica_id',$ulazvalue1->id);
                foreach ($kategorija1 as $katkey1=>$katvalue1){
                    $kategorijaniz1[]=$katvalue1;
                }

                $dogadjaj1=Dogadjaj::all()->where('id',$ulazvalue1->dogadjaj_id);
                foreach ($dogadjaj1 as $dogkey1=>$dogvalue1){
                    if ($dogvalue1->slike!=null || $dogvalue1->slike!=''){
                        $slika1 = explode('**', $dogvalue1->slike);
                        $dogvalue1->malaslika = $slika1[0];
                    }
                    else{
                        $dogvalue1->malaslika = 'malaprazna.jpg';
                    }
                    $dogvalue1->datum_odr = Functions::ispisDatuma2($dogvalue1->vreme_odr);
                    $dogvalue1->cas_odr = Functions::ispisVremena($dogvalue1->vreme_odr);
                    $mesto1=Mesto::all()->where('id',$dogvalue1->mesto_id);
                    foreach ($mesto1 as $mestokey1=>$mestovalue1){
                        $dogvalue1->mesto=$mestovalue1->naziv;
                    }
                    $dogadjajniz1[]=$dogvalue1;
                }
            }

        }



        return view('kupljeneulaznice')
            ->with('mojerezniz',$mojerezniz1)
            ->with('kategorijaniz',$kategorijaniz1)
            ->with('dogadjajniz',$dogadjajniz1);
    }

    public function otkazivanjeRezervacija($id){
        $rezid=$id;
        $rezer=Rezervacija::find($rezid);
        $rezer->status_rezervacije=0;
        $rezer->save();


        $poruka='Rezervacija br. '.$rezid.' uspešno otkazana';
        
             return back()->with('poruka',$poruka);

    }

    public function getPretraga(){

        $izbor='1';
        if(isset($_GET['izbor'])) {
            $izbor=$_GET['izbor'];

        }




        return view('pretraga')->with('izbor',$izbor);

    }

    public function autocompletePretraga(Request $request){
        $term = $request->term;
        $data = Dogadjaj::where('naziv', 'LIKE', '%' . $term . '%')
            ->where('arhiva',0)
            ->where('vreme_odr', '>', Carbon::now())
            ->take(10)
            ->get();

        $results = array();
        $rezresults = array();
        foreach ($data as $key => $v) {
            $mesto=Mesto::where('id',$v->mesto_id)->get();
            foreach ($mesto as $mestokey1=>$mestovalue1){
                $v->mesto=$mestovalue1->naziv;
            }

            if ($v->slike!=null || $v->slike!=''){
                $slika1 = explode('**', $v->slike);
                $v->slika = $slika1[0];
            }
            else{
                $v->slika = 'malaprazna.jpg';
            }
            $v->dan = Functions::ispisDatuma2($v->vreme_odr);
            $v->sat = Functions::ispisVremena($v->vreme_odr);

            $results[] = ['value' => $v->naziv, 'id' => $v->id, 'slika' => $v->slika, 'opis' => $v->opis_s, 'mesto' => $v->mesto, 'dan' => $v->dan, 'sat' => $v->sat];


        }
        return response()->json($results);
    }

    public function autocompletePretragaMesto(Request $request){
        $term = $request->term;


        $data = Dogadjaj::where('dogadjajs.arhiva','=','0')
            ->where('dogadjajs.vreme_odr', '>', Carbon::now())
            ->join('mestos', function ($join) use($term) {
                $join->on('dogadjajs.mesto_id', '=', 'mestos.id')
                    ->where('mestos.naziv', 'LIKE', '%'.$term . '%');


            })
            ->take(10)
            ->get();

        $results = array();
        foreach ($data as $key => $v) {
            $mesto=Mesto::where('id',$v->mesto_id)->get();
            foreach ($mesto as $mestokey1=>$mestovalue1){
                $v->mesto=$mestovalue1->naziv;
            }

            if ($v->slike!=null || $v->slike!=''){
                $slika1 = explode('**', $v->slike);
                $v->slika = $slika1[0];
            }
            else{
                $v->slika = 'malaprazna.jpg';
            }
            $v->dan = Functions::ispisDatuma2($v->vreme_odr);
            $v->sat = Functions::ispisVremena($v->vreme_odr);

            $results[] = ['value' => $v->naziv, 'id' => $v->id, 'slika' => $v->slika, 'opis' => $v->opis_s, 'mesto' => $v->mesto, 'dan' => $v->dan, 'sat' => $v->sat];


        }
        return response()->json($results);
    }

    public function autocompletePretragaOd(Request $request){
        $term = $request->term;
        $data = Dogadjaj::where('vreme_odr', '>',Functions::upisDatuma($term))
            ->where('dogadjajs.vreme_odr', '>', Carbon::now())
            ->where('dogadjajs.arhiva','=','0')
            ->take(10)
            ->get();

        $results = array();

        foreach ($data as $key => $v) {
            $mesto=Mesto::where('id',$v->mesto_id)->get();
            foreach ($mesto as $mestokey1=>$mestovalue1){
                $v->mesto=$mestovalue1->naziv;
            }

            if ($v->slike!=null || $v->slike!=''){
                $slika1 = explode('**', $v->slike);
                $v->slika = $slika1[0];
            }
            else{
                $v->slika = 'malaprazna.jpg';
            }
            $v->dan = Functions::ispisDatuma2($v->vreme_odr);
            $v->sat = Functions::ispisVremena($v->vreme_odr);

            $results[] = ['value' => $v->naziv, 'id' => $v->id, 'slika' => $v->slika, 'opis' => $v->opis_s, 'mesto' => $v->mesto, 'dan' => $v->dan, 'sat' => $v->sat];


        }
        return response()->json($results);
    }

    public function autocompletePretragaDo(Request $request){
        $term = $request->term;
        $data = Dogadjaj::where('vreme_odr', '<', Functions::upisDatuma($term))
            ->where('dogadjajs.vreme_odr', '>', Carbon::now())
            ->where('dogadjajs.arhiva','=','0')
            ->take(10)
            ->get();

        $results = array();

        foreach ($data as $key => $v) {
            $mesto=Mesto::where('id',$v->mesto_id)->get();
            foreach ($mesto as $mestokey1=>$mestovalue1){
                $v->mesto=$mestovalue1->naziv;
            }

            if ($v->slike!=null || $v->slike!=''){
                $slika1 = explode('**', $v->slike);
                $v->slika = $slika1[0];
            }
            else{
                $v->slika = 'malaprazna.jpg';
            }
            $v->dan = Functions::ispisDatuma2($v->vreme_odr);
            $v->sat = Functions::ispisVremena($v->vreme_odr);

            $results[] = ['value' => $v->naziv, 'id' => $v->id, 'slika' => $v->slika, 'opis' => $v->opis_s, 'mesto' => $v->mesto, 'dan' => $v->dan, 'sat' => $v->sat];


        }
        return response()->json($results);
    }

}
