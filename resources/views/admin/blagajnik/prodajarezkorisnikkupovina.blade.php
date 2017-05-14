@extends('layouts.blagajnik')

@section('main')
<div id="central">
    <br />
    <h1>Prodaja rezervisanih ulaznica:</h1>
    <br />
    <div class="block">
    @if(Session::has('poruka'))
        <ul>
            <li><span class="crvenaslova"> {{Session::get('poruka')}}</span></li>

        </ul>
        <br />
        <input type="button" value="Nazad" onclick="location.href='/admin/prodaja/rezervacije'">
        <br />
    @else
        <div>

            <form name="formaplacanjerez" method="get" action="{{url('admin/prodaja/rezervacije/'.$rezervacija->id.'/placeno')}}" onsubmit="if(!confirm('Ulaznice su naplacene?')){return false;}" onreset="window.history.back();">
                <table border="0" cellspacing="10" cellpadding="10">

                    <tr><td>Broj rezervacije:</td><td>{{$rezervacija->id}}</td></tr>
                    <tr><td>Naziv dogadjaja:</td><td>{{$dogadjaj->naziv}} </td></tr>
                    <tr><td>Mesto održavanja:</td><td>{{$mesto->naziv}}</td></tr>
                    <tr><td>Vreme održavanja:</td><td>{{$dogadjaj->datum_odr}} u {{$dogadjaj->vreme_odr}} čas.</td></tr>
                    <tr><td>Ime:</td><td>{{$korisnik->ime}}</td></tr>
                    <tr><td>Prezime:</td><td>{{$korisnik->prezime}}</td></tr>
                    <tr><td>Adresa:</td><td>{{$korisnik->adresa}}</td></tr>
                    <tr><td>Mesto:</td><td>{{$korisnik->grad}}</td></tr>
                    <tr><td>Br.tel:</td><td>{{$korisnik->tel}}</td></tr>
                    <tr><td>Kategorija ulaznica:</td><td>{{$kategorija->naziv}}</td></tr>
                    <tr><td>Broj ulaznica:</td><td>{{$rezervacija->kolicina}}</td></tr>
                    <tr><td>Datum rezervacije:</td><td>{{$rezervacija->dan_rez}} u {{$rezervacija->vreme_rez}}</td></tr>
                    <tr><td>Ukupno:</td><td>{{number_format($kategorija->cena*$rezervacija->kolicina,2)}} din.</td></tr>


                    <tr> <td colspan="2" align="center"><br>
                            <input type="submit" value="Plaćanje">&nbsp;<input type="reset" value="Otkaži"></td>
                    </tr>

                </table>
            </form>
            <p></p>



        </div>

        @endif
    </div>

</div>

@endsection