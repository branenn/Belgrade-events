<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Mesto;
use App\Dogadjaj;
use App\Ulaznica;
use App\Kategorija;
use App\User;

//dole za autocompletet
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;


//svi kor
Route::auth();

Route::get('auth.register', function () {
   return view('register');
});

Route::get('/', 'HomeKontroler@index');
Route::get('login', 'HomeKontroler@index');

Route::get('admin/login', 'Admin\AdminHomeKontroler@index');
Route::get('503', function () {
    return view('errors.503');
});
Route::get('/admin', 'Admin\AdminHomeKontroler@index');

Route::get('logout', function () {
    Auth::logout();
    return redirect('/');

});
Route::get('admin/logout', function () {
    Auth::logout();
    return view('admin.login2');
});
Route::get('passres', 'HomeKontroler@index');
Route::get('admin/passres', 'Admin\AdminHomeKontroler@index');
Route::get('dogadjaj/{id}', 'HomeKontroler@detaljiDogadjaj');
Route::get('pretraga', 'HomeKontroler@getPretraga');
Route::get('svidog', 'HomeKontroler@getSviDogadjaji');
Route::get('autocompletepretraga', array('as'=>'autocompletepretraga', 'uses'=>'HomeKontroler@autocompletePretraga'));
Route::get('autocompletepretragamesto', array('as'=>'autocompletepretragamesto', 'uses'=>'HomeKontroler@autocompletePretragaMesto'));
Route::get('autocompletepretragavremeod', array('as'=>'autocompletepretragavremeod', 'uses'=>'HomeKontroler@autocompletePretragaOd'));
Route::get('autocompletepretragavremedo', array('as'=>'autocompletepretragavremedo', 'uses'=>'HomeKontroler@autocompletePretragaDo'));

// samo registrovan
Route::group(['middleware' => 'App\Http\Middleware\Registrovani'], function()
{

    Route::post('passreset','PasswChangeKontroler@updatePassword');
    Route::post('rezervacija/{id}', 'HomeKontroler@postRezervacijaUlaznica');
    Route::get('mojerez', 'HomeKontroler@mojeRezervacije');
    Route::get('kupljeneulaznice', 'HomeKontroler@kupljeneUlaznice');
    Route::get('mojerez/otkazi/{id}', 'HomeKontroler@otkazivanjeRezervacija');
    Route::post('dogadjaj/postavikomentar', 'HomeKontroler@postPostaviKomentar');

});

// samo admin i blagajnik
Route::group(['middleware' => 'App\Http\Middleware\AdminIBlagajnik'], function()
{

    Route::post('admin/passreset','PasswChangeKontroler@updatePassword');

});

//samo admin
Route::group(['middleware' => 'App\Http\Middleware\Admin'], function()
{
    Route::get('admin/adminhome', 'Admin\AdminHomeKontroler@getAdminHome');
    Route::get('admin/korisnik/aktivacija/{id}', function ($id){
        $korisnik=User::find($id);
        if($korisnik->status==0){
            $korisnik->status=1;
            $korisnik->save();
            return redirect()->back()->with('poruka', 'Korisnički nalog je uspešno aktiviran.');
        }
        else {
            return redirect()->back()->with('poruka', 'Greška! Korisnički nalog je već aktiviran ili blokiran.');
        }
    });
    Route::get('admin/korisnik/odbaci/{id}', function ($id){
        $korisnik=User::find($id);
        if($korisnik->status==0){
            $korisnik->delete();

            return redirect()->back()->with('poruka', 'Korisnički zahtev je uspešno obrisan.');
        }
        else {
            return redirect()->back()->with('poruka', 'Greška! Korisnički nalog nije obrisan.');
        }
    });
    Route::get('admin/novikorisnik', 'Admin\AdminHomeKontroler@noviKorisnik');
    Route::post('admin/dodajnovogkor', 'Admin\AdminHomeKontroler@dodajKorisnika');
    Route::get('admin/listakorisnika', 'Admin\AdminHomeKontroler@listaKorisnika');
    Route::get('admin/korisnik/{id}', 'Admin\AdminHomeKontroler@updateKorisnik');
    Route::post('admin/korisnik/{id}', 'Admin\AdminHomeKontroler@postUpdateKorisnik');
    Route::get('admin/korisnici/top10', 'Admin\AdminHomeKontroler@getKorisniciTop10');
    Route::get('admin/korisnici/top10m', 'Admin\AdminHomeKontroler@getKorisniciTop10M');
    Route::get('admin/listamesta', 'Admin\AdminHomeKontroler@getListaMesta');
    Route::get('admin/mesto/{id}', 'Admin\AdminHomeKontroler@getUpdateMesto');
    Route::post('admin/mesto/{id}', 'Admin\AdminHomeKontroler@postUpdateMesto');
    Route::get('admin/novomesto', 'Admin\AdminHomeKontroler@getNovoMesto');
    Route::post('admin/novomesto', 'Admin\AdminHomeKontroler@postNovoMesto');
    Route::get('admin/dogadjaji', 'Admin\AdminHomeKontroler@getDogadjaji');

});



//samo blagajnik
Route::group(['middleware' => 'App\Http\Middleware\Blagajnik'], function()

{
    Route::get('/admin/listadogadjaja', 'Admin\BlagajnikHomeKontroler@listaDogadjaja');
    Route::get('/admin/listaotkazanihdogadjaja', 'Admin\BlagajnikHomeKontroler@listaOtkazanihDogadjaja');
    Route::get('/admin/dogadjaj/otkazi/{id}', 'Admin\BlagajnikHomeKontroler@otkaziDogadjaj');
    Route::get('/admin/dogadjaj/objavi/{id}', 'Admin\BlagajnikHomeKontroler@objaviDogadjaj');

    
    Route::get('admin/novidogadjaj', 'Admin\BlagajnikHomeKontroler@noviDogadjaj');
    Route::post('admin/novidogadjaj', 'Admin\BlagajnikHomeKontroler@postDodajNoviDogadjaj');
    Route::get('autocomplete', array('as'=>'autocomplete', 'uses'=>'Admin\BlagajnikHomeKontroler@autocomplete'));

    Route::get('admin/prodaja/rezervacije', 'Admin\BlagajnikHomeKontroler@getRezervacije');
    Route::get('autocompleterez', array('as'=>'autocompleterez', 'uses'=>'Admin\BlagajnikHomeKontroler@autocompleteRezervisane'));
    Route::post('admin/prodaja/rezervacije', 'Admin\BlagajnikHomeKontroler@postRezervacijeKorisnik');
    Route::get('admin/prodaja/rezervacije/{id}', 'Admin\BlagajnikHomeKontroler@getProdajaRezervacijeKorisniku');
    Route::get('admin/prodaja/rezervacije/{id}/placeno', 'Admin\BlagajnikHomeKontroler@getProdajaRezervacijeKorisnikuPlaceno');
    

    Route::get('admin/prodaja/slobodne', 'Admin\BlagajnikHomeKontroler@getProdajaSlobodnih');
    Route::get('autocompleteslob', array('as'=>'autocompleteslob', 'uses'=>'Admin\BlagajnikHomeKontroler@autocompleteSlobodne'));
    Route::post('admin/prodaja/slobodne', 'Admin\BlagajnikHomeKontroler@postProdajaSlobodnih');
    Route::get('admin/prodaja/slobodne/{id}', 'Admin\BlagajnikHomeKontroler@getProdajaSlobodnihDogadjaj');
    Route::post('admin/prodaja/slobodne/placanje', 'Admin\BlagajnikHomeKontroler@postProdajaSlobodnihDogadjajPlacanje');



    Route::get('admin/dogadjaj/{id}', 'Admin\BlagajnikHomeKontroler@updateDogadjaj');
    Route::post('admin/dogadjaj/{id}', 'Admin\BlagajnikHomeKontroler@postUpdateDogadjaj');

});

 /*
    Route::post('admin/novidogadjaj', function (){

        $test=$_POST['ime_kategorije'];
        $velniza=sizeof($test);
        $bezpraznih = array_filter($test, function($value) { return $value !== ''; });
        $velniza2=sizeof($bezpraznih);
     $noviniz=array();
        foreach ($bezpraznih as $kljuc=>$vrednost){
            $noviniz[]=$vrednost;
        }

        $velniza4=sizeof($noviniz);
        echo '<br>ispod<br>';
        echo $test[1].'<br>';
        var_dump($test);
        echo '<br>';
        var_dump($bezpraznih);
        echo '<br>';
        var_dump($noviniz);
        for ($i=0;$i<=$velniza4-1;$i++){
            echo '<br />'. ($i+1) .' : '.$noviniz[$i];
        }
        echo '<br>Velicina: '.$velniza;
        echo '<br>Velicina2: '.$velniza2;
        echo '<br>Prva: '.$test[0];
        echo '<br>Druga: '.$test[1];
        echo '<br>Treca: '.$test[2];
        echo '<br>Cetvrta: '.$test[3];
        echo '<br>Peta: '.$test[4];
    });
*/

//    Route::post('admin/dogadjaj/{id}', function (){
//$test=$_POST['ime_kategorije'];


//        $ulaz= App\Ulaznica::where('dogadjaj_id', '107')->firstOrFail();
//       $kategorija = App\Kategorija::where('ulaznica_id', $ulaz->id)->get();
//       var_dump($kategorija);

//    });



/*
Route::get('admin/novikorisnik', function(){
   // $mesta=Mesto::all();
    //return view('admin.novikorisnik')->with('mesta', $mesta);
    return view('admin.novikorisnik');
});
*/
//treba definisati nepostojece sttranice u App/Excepitions/Handler.php


/*
Route::get('/testemail', function () {




  
    Mail::send('emails.test', ['name' => 'Brankice'], function ($poruka) {
        $test = array('branka74cici@gmail.com' => 'Branka', 'brankamilacic@gmail.com' => 'Brankica');
        foreach($test as $key => $v) {
            $poruka->to($key, $v)->subject('Pozdrav!');
        }
    });



});
*/

