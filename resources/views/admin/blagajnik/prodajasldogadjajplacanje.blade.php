@extends('layouts.blagajnik')

@section('main')
    <div id="central">
        <div class="block">
            <div>
                <br>
                <div>
                    <span class="crvenaslova">Ulaznice uspešno plaćene.</span>
                    <br /><br />
                    <u>Račun</u>
                    <br>
                    <br>
                    <table border="0" cellspacing="10" cellpadding="10">

                        <tr><td>Naziv dogadjaja:</td><td>{{$dogadjaj->naziv}} </td></tr>
                        <tr><td>Mesto održavanja:</td><td>{{$dogadjaj->nazivmesta}}</td></tr>
                        <tr><td>Vreme održavanja:</td><td>{{$dogadjaj->dan_odr}} u {{$dogadjaj->vreme_odr}} čas.</td></tr>
                        <tr><td>Kategorija ulaznica:</td><td>{{$kategorija->naziv}}</td></tr>
                        <tr><td>Količina ulaznica:</td><td>{{$kolicina}}</td></tr>
                        <tr><td>Cena (jed.):</td><td>{{$kategorija->cena}} din.</td></tr>
                        <tr><td>UKUPNO::</td><td>{{$kategorija->cena*$kolicina}} din.</td></tr>


                        <tr> <td colspan="2" align="center"><br>
                                <input type="button" value="OK" onclick="location.href='/admin/prodaja/slobodne';"></td>
                        </tr>

                    </table>


                    <p></p>
                </div>
            </div>
        </div>
    </div>
@endsection