<?php

namespace App\Http\Controllers\Admin;

use App\Dogadjaj;
use App\Kategorija;
use App\Rezervacija;
use App\Ulaznica;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PhpParser\Node\Stmt\Foreach_;
use Validator;
use Image;
use App\Mesto;
use App\Functions;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Mail;


class BlagajnikHomeKontroler extends Controller
{
    private $slikadog;


    public function listaDogadjaja()
    {


        $dog = array();

        $dogadjaji = Dogadjaj::where('mesto_id', Auth::user()->mesto_id)->where('arhiva', 0)->get();
        // $dogadjaji=Dogadjaj::all();

        foreach ($dogadjaji->reverse() as $dogadjaj) {
            if ($dogadjaj->slike != null || $dogadjaj->slike != '') {
                $slika = explode('**', $dogadjaj->slike);
                $dogadjaj->malaslika = $slika[0];
            } else {
                $dogadjaj->malaslika = 'malaprazna.jpg';
            }
            $mesta = Mesto::find($dogadjaj->mesto_id);
            $dogadjaj->mesto = $mesta->naziv;
            $dogadjaj->datum_odr = Functions::ispisDatuma2($dogadjaj->vreme_odr);
            $dogadjaj->vreme_odr = Functions::ispisVremena($dogadjaj->vreme_odr);


            $dog[] = $dogadjaj;

        }

        return view('admin.blagajnik.listadogadjaja')
            ->with('dog', $dog);
    }

    public function otkaziDogadjaj($id)
    {


        $dogadjaj = Dogadjaj::find($id);
        $mesto = Mesto::find($dogadjaj->mesto_id);
        if (Auth::user()->mesto_id == $dogadjaj->mesto_id) {
            $dogadjaj->arhiva = 1;
            $dogadjaj->save();
            $ulaznice = Ulaznica::where('dogadjaj_id', $dogadjaj->id)->get();
            foreach ($ulaznice as $ulkey => $ulvalue) {

                $sverezervisane = Rezervacija::where('ulaznica_id', $ulvalue->id)->where('status_rezervacije', 1)->where('user_id','!=','0')->get();
                foreach ($sverezervisane as $rezkljuc => $rezvalue) {
                    $korisnicirezer = User::all()->where('id', $rezvalue->user_id);
                    foreach ($korisnicirezer as $korkey => $korisnik1) {
                        $podaci1 = array('email' => $korisnik1->email, 'ime' => $korisnik1->ime, 'dogime' => $dogadjaj->naziv);
                        Mail::send('emails.otkazrezervisane', ['name' => $korisnik1->ime, 'imedog' => $dogadjaj->naziv, 'dogmesto' => $mesto->naziv, 'dogdan' => Functions::ispisDatuma2($dogadjaj->vreme_odr), 'dogsat' => Functions::ispisVremena($dogadjaj->vreme_odr)], function ($poruka1) use ($podaci1) {
                            $poruka1->to($podaci1['email'], $podaci1['ime'])->subject('Otkazan je dogadjaj ' . $podaci1['dogime']);
                        });
                    }
                }

                $svekupljene = Rezervacija::where('ulaznica_id', $ulvalue->id)->where('status_rezervacije', 2)->where('user_id','!=','0')->get();
                foreach ($svekupljene as $kupljkey => $kupljvalue) {
                    $korisnicikuplj = User::all()->where('id', $kupljvalue->user_id);
                    foreach ($korisnicikuplj as $korkkey => $korisnik2) {
                        $podaci2 = array('email' => $korisnik2->email, 'ime' => $korisnik2->ime, 'dogime' => $dogadjaj->naziv);
                        Mail::send('emails.otkazkupljene', ['name' => $korisnik2->ime, 'imedog' => $dogadjaj->naziv, 'dogmesto' => $mesto->naziv, 'dogdan' => Functions::ispisDatuma2($dogadjaj->vreme_odr), 'dogsat' => Functions::ispisVremena($dogadjaj->vreme_odr)], function ($poruka2) use ($podaci2) {
                            $poruka2->to($podaci2['email'], $podaci2['ime'])->subject('Otkazan je dogadjaj ' . $podaci2['dogime']);
                        });
                    }
                }
            }


            return redirect('/admin/listaotkazanihdogadjaja')->with('por', 'Dogadjaj ' . $dogadjaj->naziv . ' uspešno otkazan');
        } else {
            return redirect('/admin/listadogadjaja')->with('por', 'Možete otkazati događaj samo za Vaše mesto rada');
        }
    }

    public function listaOtkazanihDogadjaja()
    {

        $dog = array();

        $dogadjaji = Dogadjaj::where('mesto_id', Auth::user()->mesto_id)->where('arhiva', 1)->get();
        // $dogadjaji=Dogadjaj::all();

        foreach ($dogadjaji->reverse() as $dogadjaj) {
            if ($dogadjaj->slike != null || $dogadjaj->slike != '') {
                $slika = explode('**', $dogadjaj->slike);
                $dogadjaj->malaslika = $slika[0];
            } else {
                $dogadjaj->malaslika = 'malaprazna.jpg';
            }
            $mesta = Mesto::find($dogadjaj->mesto_id);
            $dogadjaj->mesto = $mesta->naziv;
            $dogadjaj->datum_odr = Functions::ispisDatuma2($dogadjaj->vreme_odr);
            $dogadjaj->vreme_odr = Functions::ispisVremena($dogadjaj->vreme_odr);


            $dog[] = $dogadjaj;

        }

        return view('admin.blagajnik.listaotkazanihdogadjaja')
            ->with('dog', $dog);
    }

    /* ne treba da objavljuje
    public function objaviDogadjaj($id){

        $dogadjaj = Dogadjaj::find($id);
        $dogadjaj->arhiva=0;
        $dogadjaj->save();

        return redirect('/admin/listadogadjaja');
    }
    */

    public function noviDogadjaj()
    {
        $mestorada = Mesto::where('id', Auth::user()->mesto_id)->firstOrFail();

        return view('admin.blagajnik.novidogadjaj')
            ->with('mestorada', $mestorada);
    }


    public function postDodajNoviDogadjaj(Request $request)
    {

        $rules = [
            'naziv' => 'required|min:5|max:255',
            'vreme_odrzavanja' => 'required|date|after:danas',
            'opis_sazetak' => 'required|min:20|max:255',
            'opis_detalji' => 'required|min:20',
            'poslednji_rok_rezervisanja' => 'date|before:vreme_odrzavanja',
            'slike' => 'image|mimes:jpeg,bmp,png|required',
            'cena.*' => 'required|numeric',
            'ime_kategorije.*' => 'required|distinct',
            'kolicina.*' => 'required|numeric',
            'max_ulaznica' => 'required|numeric',

        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('katpolja', Input::get('katpolja'));

        } else {

            if ($request->slike->isValid()) {
                $extension = $request->slike->getClientOriginalExtension();
                $vreme = time();
                $fileName = $vreme . '-' . rand(11111, 99999);
                $fileNameBig = $fileName . '.' . $extension;
                $fileNameThumb = $fileName . '_thumb.' . $extension;


                $velikePutanja = 'uploads/dogslike/velike/' . $fileNameBig;
                $malePutanja = 'uploads/dogslike/male/' . $fileNameThumb;
                $this->slikadog = $fileNameThumb . '**' . $fileNameBig;


                Image::make($request->slike)->resize(578, 361)->save($velikePutanja);
                Image::make($request->slike)->resize(180, 112)->save($malePutanja);


                //    $request->kategorija = $this->bezPraznihPolja($request->kategorija);
                //   $request->imekat = $this->bezPraznihPolja($request->imekat);
                //    $request->kolicina = $this->bezPraznihPolja($request->kolicina);
                //     $request->cena = $this->bezPraznihPolja($request->cena);


                if (!$this->upisDogadjaja($request->all())) {
                    $messagedog = 'Greška prilikom dodavanja događaja u bazu.';
                    return redirect()->back()->with('messagedog', $messagedog);
                    exit();
                } else {
                    if (!$this->upisUlaznica($request->all())) {
                        $messagedog = 'Greška prilikom dodavanja ulaznica u bazu.';
                        return redirect()->back()->with('messagedog', $messagedog);
                        exit();
                    } else {
                        if (!$this->upisKategorija($request->all())) {
                            $messagedog = 'Greška prilikom dodavanja kategorija u bazu.';
                            return redirect()->back()->with('messagedog', $messagedog);
                            exit();
                        } else {
                            $messagedog = 'Događaj uspešno dodat u bazu.';
                            return redirect()->back()->with('messagedog', $messagedog);
                        }

                    }
                }
            } else {
                // sending back with error message.
                $messagedog = 'Upload slike neuspesan';
                return redirect()->back()->with('messagedog', $messagedog)->withInput();
            }

        }
    }

    /*
        public function bezPraznihPolja($nekiniz){
            $bezpraznih = array_filter($nekiniz, function($value) { return $value !== ''; });
            $noviniz=array();
            foreach ($bezpraznih as $kljuc=>$vrednost){
                $noviniz[]=$vrednost;
            }
            return $noviniz;
        }
    */
    public function autocomplete(Request $request)
    {
        $term = $request->term;
        $data = Dogadjaj::where('naziv', 'LIKE', '%' . $term . '%')
            ->take(10)
            ->get();

        $results = array();
        foreach ($data as $key => $v) {
            $results[] = ['value' => $v->naziv];
        }
        return response()->json($results);
    }


    protected function upisDogadjaja(array $data)
    {

        if ($data['poslednji_rok_rezervisanja'] != null || $data['poslednji_rok_rezervisanja'] != '') {
            $max_rez_date = Functions::upisDatuma($data['poslednji_rok_rezervisanja']);
        } else {
            $max_rez_date = null;
        }
        return Dogadjaj::create([
            'naziv' => $data['naziv'],
            'vreme_odr' => Functions::upisDatuma($data['vreme_odrzavanja']),
            'opis_s' => $data['opis_sazetak'],
            'opis_p' => $data['opis_detalji'],
            'slike' => $this->slikadog,
            'arhiva' => $data['arhiva'],
            'max_br_ul' => $data['max_ulaznica'],
            'max_rez_date' => $max_rez_date,
            'mesto_id' => $data['mesto_id'],

        ]);
    }

    protected function upisUlaznica(array $data)
    {
        $dog_id = Dogadjaj::all()->last()->id;
        return Ulaznica::create([
            'dogadjaj_id' => $dog_id,

        ]);


    }

    protected function upisKategorija(array $data)
    {

        $kategorija = array();
        $naziv = array();
        $cena = array();
        $kolicina = array();

        foreach ($data['kategorija'] as $kat => $vrcat) {
            $kategorija[] = $vrcat;
        }

        foreach ($data['ime_kategorije'] as $imekat => $vrimekat) {
            $naziv[] = $vrimekat;
        }

        foreach ($data['cena'] as $cen => $vrcen) {
            $cena[] = $vrcen;
        }

        foreach ($data['kolicina'] as $kol => $vrkol) {
            $kolicina[] = $vrkol;
        }


        for ($i = 0; $i <= sizeof($kategorija) - 1; $i++) {

            $upis = Kategorija::create([

                'kategorija' => $kategorija[$i],
                'naziv' => $naziv[$i],
                'cena' => $cena[$i],
                'kolicina' => $kolicina[$i],
                'ulaznica_id' => Ulaznica::all()->last()->id, //nece da upise u bazu proveriti

            ]);
        }
        return $upis;

    }

    public function updateDogadjaj($id)
    {
        $dogadjaj = Dogadjaj::find($id);
        $mesto = Mesto::find($dogadjaj->mesto_id);
        $svamesta = Mesto::all();
        if (Auth::user()->mesto_id != $dogadjaj->mesto_id) {
            $greskaDogadjaj = 'Ne možete da promenite ovaj događaj';
            return view('admin.blagajnik.greska')
                ->with('greskaDogadjaj', $greskaDogadjaj);
        } else {


            if ($dogadjaj->slike != null || $dogadjaj->slike != '') {
                $slika = explode('**', $dogadjaj->slike);
                $dogadjaj->malaslika = $slika[0];
            } else {
                $dogadjaj->malaslika = 'malaprazna.jpg';
            }

            $dogadjaj->vreme_odr = Functions::ispisDatuma($dogadjaj->vreme_odr);
            //  $dogadjaj->vreme_odr_do = Functions::ispisDatuma($dogadjaj->vreme_odr_do);
            if ($dogadjaj->max_rez_date != null || $dogadjaj->max_rez_date != '') {
                $dogadjaj->max_rez_date = Functions::ispisDatuma($dogadjaj->max_rez_date);
            } else {
                $dogadjaj->max_rez_date = '';
            }


            $ulaznica = Ulaznica::where('dogadjaj_id', $id)->firstOrFail();

            $kategorija = Kategorija::where('ulaznica_id', $ulaznica->id)->get();
            //var_dump($kategorija);


            return view('admin.blagajnik.updatedogadjaj')
                ->with('dogadjaj', $dogadjaj)
                ->with('mesto', $mesto)
                ->with('svamesta', $svamesta)
                ->with('ulaznica', $ulaznica)
                ->with('kategorija', $kategorija);

        }
    }


    public function postUpdateDogadjaj(Request $request)
    {

        $pravila = [
            'naziv' => 'required|min:5|max:255',
            'vreme_odrzavanja' => 'required|date|after:danas',
            'opis_sazetak' => 'required|min:20|max:255',
            'opis_detalji' => 'required|min:20',
            'cena.*' => 'required|numeric',
            'ime_kategorije.*' => 'required|distinct',
            'kolicina.*' => 'required|numeric',
            'poslednji_rok_rezervisanja' => 'date|before:vreme_odrzavanja',
            'slike' => 'image|mimes:jpeg,bmp,png',
            'max_ulaznica' => 'required|numeric',
        ];


        $validator = Validator::make($request->all(), $pravila);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('katpolja', Input::get('katpolja'));

            //return redirect()->back()->withErrors($validator)->withInput()->with('katpolja', Input::get('katpolja'));

        } else {

            $dogadjaj = Dogadjaj::find($request->id);

            $poruke = array();
            if ($request->naziv != $dogadjaj->naziv) {
                $dogadjaj->naziv = $request->naziv;
                $poruke[] = 'Naziv je promenjen.';
            }

            if ($request->mesta != $dogadjaj->mesto_id) {
                $dogadjaj->mesto_id = $request->mesta;
                $poruke[] = 'Mesto odražavanja je promenjeno.';
            }

            if (Functions::upisDatuma($request->vreme_odrzavanja) != $dogadjaj->vreme_odr) {
                $dogadjaj->vreme_odr = Functions::upisDatuma($request->vreme_odrzavanja);
                $poruke[] = 'Vreme održavanja je promenjeno.';
            }

            if ($request->slike) {
                $extension = $request->slike->getClientOriginalExtension();
                // $vreme=Carbon::now()->timestamp;
                $vreme = time();
                $fileName = $vreme . '-' . rand(11111, 99999);
                $fileNameBig = $fileName . '.' . $extension;
                $fileNameThumb = $fileName . '_thumb.' . $extension;


                $velikePutanja = 'uploads/dogslike/velike/' . $fileNameBig;
                $malePutanja = 'uploads/dogslike/male/' . $fileNameThumb;
                $dogadjaj->slike = $fileNameThumb . '**' . $fileNameBig;


                Image::make($request->slike)->resize(578, 361)->save($velikePutanja);
                Image::make($request->slike)->resize(180, 112)->save($malePutanja);
                $poruke[] = 'Slika je promenjena.';
            }

            if ($request->opis_sazetak != $dogadjaj->opis_s) {
                $dogadjaj->opis_s = $request->opis_sazetak;
                $poruke[] = 'Opis (sažetak) je promenjen.';
            }
            if ($request->opis_detalji != $dogadjaj->opis_p) {
                $dogadjaj->opis_p = $request->opis_detalji;
                $poruke[] = 'Opis (detalji) je promenjen.';
            }
            // ovo isto

            $ulaznice = Ulaznica::where('dogadjaj_id', $request->id)->firstOrFail();

            $kategorija = Kategorija::where('ulaznica_id', $ulaznice->id)->get();


            $broj_polja_u_bazi = count($kategorija);
            $brojpolja = count($request->kategorija);


            $brkatid = sizeof($request->katid);
            while ($broj_polja_u_bazi > $brkatid) {
                $obrisana = Kategorija::where('ulaznica_id', $ulaznice->id)->orderBy('kategorija', 'desc')->first();
                $poruke[] = 'Kategorija ' . $obrisana->naziv . ' je obrisana.';
                $obrisana->delete();
                $broj_polja_u_bazi--;

            }


            for ($i = 1; $i <= $broj_polja_u_bazi; $i++) {
                $kat = Kategorija::where('id', $request->katid[$i])->firstOrFail();


                if ($request->ime_kategorije[$i] != $kat->naziv) {
                    $kat->naziv = $request->ime_kategorije[$i];
                    $poruke[] = 'Naziv kategorije ' . $kat->kategorija . ' je promenjen.';
                }
                if ($request->cena[$i] != $kat->cena) {
                    $kat->cena = $request->cena[$i];
                    $poruke[] = 'Cena u kategoriji ' . $kat->kategorija . ' je promenjena.';
                }

                if ($request->kolicina[$i] != $kat->kolicina) {
                    $kat->kolicina = $request->kolicina[$i];
                    $poruke[] = 'Kolicina u kategoriji ' . $kat->kategorija . ' je promenjena.';
                }


                $kat->save();


            }

            while ($broj_polja_u_bazi < $brojpolja) {
                $x = $broj_polja_u_bazi + 1;
                Kategorija::create([

                    'kategorija' => $request->kategorija[$x],
                    'naziv' => $request->ime_kategorije[$x],
                    'cena' => $request->cena[$x],
                    'kolicina' => $request->kolicina[$x],
                    'ulaznica_id' => $ulaznice->id,
                ]);
                $poruke[] = 'Nova kategorija ' . $request->ime_kategorije[$x] . ' je dodata.';
                $x++;
                $broj_polja_u_bazi++;


            }


            if ($request->max_ulaznica != $dogadjaj->max_br_ul) {
                $dogadjaj->max_br_ul = $request->max_ulaznica;
                $poruke[] = 'Max ulaznica po 1 korisniku je promenjen.';
            }


            if ($request->poslednji_rok_rezervisanja != null || $request->poslednji_rok_rezervisanja != '') {
                if (Functions::upisDatuma($request->poslednji_rok_rezervisanja) != $dogadjaj->max_rez_date) {
                    $dogadjaj->max_rez_date = Functions::upisDatuma($request->poslednji_rok_rezervisanja);
                    $poruke[] = 'Poslednji rok rezervisanja je promenjen.';
                }
            } else {
                if ($request->poslednji_rok_rezervisanja != $dogadjaj->max_rez_date) {
                    $dogadjaj->max_rez_date = null;
                    $poruke[] = 'Poslednji rok rezervisanja je promenjen.';
                }
            }

            $dogadjaj->save();
            $ulaznice->save();


            return redirect()->back()
                ->with('poruke', $poruke)
                ->withInput();


        }

    }


    public function getRezervacije()
    {

        return view('admin.blagajnik.prodajarez');
    }


    public function autocompleteRezervisane(Request $request)
    {
        $term = $request->term;
        $data = User::where('prezime', 'LIKE', '%' . $term . '%')
            ->take(10)
            ->get();

        $results = array();
        foreach ($data as $key => $v) {

            $results[] = ['value' => $v->prezime . ' ' . $v->ime . ', ' . $v->adresa . ', ' . $v->grad, 'id' => $v->id, 'ime' => $v->ime, 'prezime' => $v->prezime];


        }
        return response()->json($results);
    }


    public function postRezervacijeKorisnik(Request $request)
    {

        $korisnik = User::find($request->id);
        $rezKorisnika = Rezervacija::where('user_id', $request->id)->where('status_rezervacije', 1)->get();

        $rezkorisnikaniz = array();
        $kategorijaniz = array();
        $dogadjajniz = array();

        foreach ($rezKorisnika as $rkey => $rvalue) {
            $rvalue->datum_vazi_do = Functions::ispisDatuma2($rvalue->vazi_do);
            $rvalue->vreme_vazi_do = Functions::ispisVremena($rvalue->vazi_do);
            $rezkorisnikaniz[] = $rvalue;


            $ulaznica = Ulaznica::all()->where('id', $rvalue->ulaznica_id);
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

        return view('admin.blagajnik.prodajarezkorisnik')
            ->with('rezkorisnika', $rezkorisnikaniz)
            ->with('kategorija', $kategorijaniz)
            ->with('dogadjaj', $dogadjajniz)
            ->with('korisnik', $korisnik);
    }


    public function getProdajaRezervacijeKorisniku($id)
    {


        $rezervacija = Rezervacija::find($id);
        $rezervacija->dan_rez = Functions::ispisDatuma2($rezervacija->datum_rezervacije);
        $rezervacija->vreme_rez = Functions::ispisVremena($rezervacija->datum_rezervacije);
        $ulaznica = Ulaznica::find($rezervacija->ulaznica_id);
        $dogadjaj = Dogadjaj::find($ulaznica->dogadjaj_id);
        $dogadjaj->datum_odr = Functions::ispisDatuma2($dogadjaj->vreme_odr);
        $dogadjaj->vreme_odr = Functions::ispisVremena($dogadjaj->vreme_odr);
        $mesto = Mesto::find($dogadjaj->mesto_id);
        $kategorija = Kategorija::find($rezervacija->kategorija_id);
        $korisnik = User::find($rezervacija->user_id);
        $mestoBlagajnik = Mesto::where(Auth::user()->mesto_id);


        return view('admin.blagajnik.prodajarezkorisnikkupovina')
            ->with('rezervacija', $rezervacija)
            ->with('dogadjaj', $dogadjaj)
            ->with('mesto', $mesto)
            ->with('kategorija', $kategorija)
            ->with('korisnik', $korisnik)
            ->with('mestoblag', $mestoBlagajnik);

    }


    public function getProdajaRezervacijeKorisnikuPlaceno($id)
    {


        $rezervacija = Rezervacija::find($id);
        $kategorija = Kategorija::find($rezervacija->kategorija_id);
        $ulaznica = Ulaznica::find($rezervacija->ulaznica_id);
        $dogadjaj = Dogadjaj::find($ulaznica->dogadjaj_id);


        if (Auth::user()->mesto_id != $dogadjaj->mesto_id) {


            $poruka = 'Greška! Možete prodati samo ulaznice za dogadjaj na svome mestu rada';

        } else {

            $kategorija->kolicina -= $rezervacija->kolicina;
            $rezervacija->status_rezervacije = 2;
            $kategorija->save();
            $rezervacija->save();
            $poruka = 'Rezervacija uspešno plaćena';
        }


        return redirect('/admin/prodaja/rezervacije/' . $id)->with('poruka', $poruka);
    }

    public function getProdajaSlobodnih()
    {

        return view('admin.blagajnik.prodajasl');
    }


    public function autocompleteSlobodne(Request $request)
    {
        $term = $request->term;

        $data = Dogadjaj::select('naziv')->where('naziv', 'LIKE', '%' . $term . '%')->where('arhiva', 0)->where('vreme_odr', '>', Carbon::now())->where('mesto_id', Auth::user()->mesto_id)
            ->take(30)
            ->distinct()
            ->get();

        $results = array();
        foreach ($data as $key => $v) {
            $v->dan_odr = Functions::ispisDatuma2($v->vreme_odr);
            $v->sat_odr = Functions::ispisVremena($v->vreme_odr);
            //$results[]=['value'=>$v->naziv .', '.$v->dan_odr.' u '.$v->sat_odr,'nazivdog'=>$v->ime, 'id'=>$v->id];
            $results[] = ['value' => $v->naziv];


        }
        return response()->json($results);
    }

    public function postProdajaSlobodnih(Request $request)
    {

        $pravila = [
            'dogadjaj' => 'required',
        ];


        $validator = Validator::make($request->all(), $pravila);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {



            $dogadjajiniz = array();


            $dogadjaji = Dogadjaj::where('naziv', 'LIKE', '%' . $request->dogadjaj . '%')
                ->where('arhiva', 0)
                ->where('vreme_odr', '>', Carbon::now())
                ->where('mesto_id', Auth::user()->mesto_id)
                ->get();
            foreach ($dogadjaji as $dogadjaj) {
                $dogadjaj->kategorija=array();

                if ($dogadjaj->slike != null || $dogadjaj->slike != '') {
                    $slika = explode('**', $dogadjaj->slike);
                    $dogadjaj->malaslika = $slika[0];
                } else {
                    $dogadjaj->malaslika = 'malaprazna.jpg';
                }
                $dogadjaj->datum_odr = Functions::ispisDatuma2($dogadjaj->vreme_odr);
                $dogadjaj->vreme_odr = Functions::ispisVremena($dogadjaj->vreme_odr);

                $mesta = Mesto::where('id', $dogadjaj->mesto_id)->get();
                foreach ($mesta as $mesto) {
                    $dogadjaj->mesto = $mesto->naziv;
                }


                $ulaznicaId=Ulaznica::where('dogadjaj_id',$dogadjaj->id)->pluck('id')->first();

                $kategorije=Kategorija::where('ulaznica_id',$ulaznicaId)->get();
                $kategorijeniz=array();

                $sveRezervacijeDogadjaja= Rezervacija::where('ulaznica_id', $ulaznicaId)->where('status_rezervacije',1)->where('vazi_do','>=',Carbon::now())->get();
                $zbirrezervisanih=0;
                foreach ($sveRezervacijeDogadjaja as $svekey=>$svevalue){
                    $zbirrezervisanih+=$svevalue->kolicina;

                }

                foreach ($kategorije as $kat) {
                    $kat->raspolozivo=array();
                    $raspolozivoUlaznica=$kat->kolicina-$zbirrezervisanih;
                    $kat->raspolozivo=$raspolozivoUlaznica;
                    $kategorijeniz[]=$kat;
                }


                $dogadjaj->kategorije=$kategorijeniz;

                $dogadjajiniz[] = $dogadjaj;
            }

            return view('admin.blagajnik.prodajasldogadjaji')
                             ->with('dogadjaj', $dogadjajiniz);

           
        }

    }

    public function getProdajaSlobodnihDogadjaj($id){

    $dogadjaj= Dogadjaj::find($id);
    $dogadjaj->dan_odr = Functions::ispisDatuma2($dogadjaj->vreme_odr);
    $dogadjaj->vreme_odr = Functions::ispisVremena($dogadjaj->vreme_odr);
    $mesto=Mesto::where('id',$dogadjaj->mesto_id)->first();
    $ulazniceId=Ulaznica::where('dogadjaj_id',$id)->pluck('id')->first();
    $kategorije=Kategorija::where('ulaznica_id',$ulazniceId)->get();


    return view('admin.blagajnik.prodajasldogadjaj')
                ->with('dogadjaj',$dogadjaj)
                ->with('mesto',$mesto)
                ->with('kategorije',$kategorije);
}

    public function postProdajaSlobodnihDogadjajPlacanje(Request $request){

        $pravila = [
            'kolicina' => 'required|numeric|min:1|max:100',
            'kategorija_ulaznica' => 'required',
        ];


        $validator = Validator::make($request->all(), $pravila);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        } else {
            $dogadjaj = Dogadjaj::find($request->dogid);
                        
            if (Auth::user()->mesto_id != $dogadjaj->mesto_id) {

                return redirect()->back()->with('sporuke','Greška! Možete prodati samo ulaznice za dogadjaj na svome mestu rada')->withInput();

            } else {

                $ulazniceId = Ulaznica::where('dogadjaj_id', $request->dogid)->pluck('id')->first();
                $sveRezervacijeDogadjaja= Rezervacija::where('kategorija_id', $request->kategorija_ulaznica)->where('status_rezervacije',1)->where('vazi_do','>=',Carbon::now())->get();
                $zbirrezervisanih=0;
                    foreach ($sveRezervacijeDogadjaja as $svekey=>$svevalue){
                    $zbirrezervisanih+=$svevalue->kolicina;

                    }
                    $kategorija = Kategorija::find($request->kategorija_ulaznica);
                    $raspolozivoUlaznica=$kategorija->kolicina-$zbirrezervisanih;

                        if (($raspolozivoUlaznica-$request->kolicina)<=0){
                            return redirect()->back()->with('sporuke', 'Greška! Preostalo je samo još '. $raspolozivoUlaznica . ' ulaznica.');
                        }
                         else{
                            $podaci=array('ulaznica_id' => $ulazniceId,'kat' => $request['kategorija_ulaznica'], 'kolicina' => $request['kolicina']);
                                if (!$this->upisProdaje($podaci)) {
                                    return redirect()->back()->with('sporuke', 'Greška prilikom dodavanja rezervacije u bazu.');
                                    exit();
                                }else {

                                    $dogadjaj->dan_odr = Functions::ispisDatuma2($dogadjaj->vreme_odr);
                                    $dogadjaj->vreme_odr = Functions::ispisVremena($dogadjaj->vreme_odr);
                                    $mesto=Mesto::where('id',$dogadjaj->mesto_id)->first();
                                    $dogadjaj->nazivmesta=$mesto->naziv;

                                   // $kategorija = Kategorija::find($request->kategorija_ulaznica);
                                    $kategorija->kolicina -= $request->kolicina;
                                    $kategorija->save();


                                    return view('admin.blagajnik.prodajasldogadjajplacanje')
                                        ->with('dogadjaj',$dogadjaj)
                                        ->with('kategorija',$kategorija)
                                        ->with('kolicina',$request->kolicina);
                                    // return redirect()->back()->with('sporuke', 'Ulaznice uspešno plaćene.');
                                    }
                            }

                    }
            }
    }

    protected function upisProdaje(array $data)
    {

        return Rezervacija::create([
            'datum_rezervacije' => date('Y-m-d H:i:s'),
            'vazi_do' => date('Y-m-d H:i:s'),
            'status_rezervacije' => 2,
            'user_id' => 0,
            'ulaznica_id' => $data['ulaznica_id'],
            'kategorija_id' => $data['kat'],
            'kolicina' => $data['kolicina'],
        ]);
    }

}