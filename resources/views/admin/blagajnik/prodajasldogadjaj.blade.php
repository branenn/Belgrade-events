@extends('layouts.blagajnik')

@section('main')
    <div id="central">
        <div class="block">
            <div>
                <br />
                <div>
                    <u>Prodaja ulaznica</u>
                    <br />
                    <br />
                    @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error=>$value)
                                <li class="crvenaslova"> {{$value}}</li>
                            @endforeach
                        </ul>
                        <br />
                    @endif
                    @if(Session::has('sporuke'))
                        <ul>

                                <li class="crvenaslova"> {{Session::get('sporuke')}}</li>

                        </ul>
                        <br />
                    @endif
                    <form name="formaplacanje" method="post" action="{{url('/admin/prodaja/slobodne/placanje')}}" onsubmit="if(!confirm('Da li ste sigurni da zelite da izvrsite plaćanje?')){return false;}" onreset="window.history.back();">
                        <table border="0" cellspacing="10" cellpadding="10">
                            <tr><td>Naziv dogadjaja:</td><td>{{$dogadjaj->naziv}} </td></tr>
                            <tr><td>Mesto održavanja:</td><td>{{$mesto->naziv}}</td></tr>
                            <tr><td>Vreme održavanja:</td><td>{{$dogadjaj->dan_odr}} u {{$dogadjaj->vreme_odr}} čas.</td></tr>
                            <tr><td>Kategorija ulaznica:</td><td>
                                    <select name="kategorija_ulaznica">
                                            <option value="{{old('kat')}}" default> </option>
                                        @foreach($kategorije as $kategorija)
                                            <option value="{{$kategorija->id}}">{{$kategorija->naziv}}</option>
                                        @endforeach
                                    </select>
                                </td></tr>
                            <tr><td>Broj ulaznica:</td>
                                <td>
                                    <input type="number" name="kolicina" value="{{old('kolicina')}}" min="1" max="100" required>
                                </td></tr>
                            <tr> <td colspan="2" align="center"><br>
                            <tr>
                                    @if(Auth::user()->mesto_id != $dogadjaj->mesto_id)
                                 <td colspan="2" align="center">
                                        Možete prodati ulaznice samo za svoje mesto rada<br /><input type="reset" value="Nazad">

                                </td>
                                    @else

                                    <td colspan="2" align="center"><br>
                                <input type="hidden" name="dogid" value="{{$dogadjaj->id}}">
                                <input type="submit" value="Plaćanje">&nbsp;<input type="reset" value="Nazad">
                                    </td>

                                   @endif
                            </tr>
                        </table>
                    </form>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
@endsection