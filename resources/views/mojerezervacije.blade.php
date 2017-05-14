@extends('layouts.app')
@include('levimeni')
@section('main')
    <div id="big">
        <h1>Rezervisani dogadjaji</h1>
        <br/>
@if(Session::has('poruka'))
    <span class="crvenaslova">{{Session::get('poruka')}}</span>
    <br />
@endif
        <div class="block">
            <br />
            @if($mojerezniz == null || $mojerezniz == '')
                Nemate nijedan rezervisan dogadjaj!
            @else

                @for($i=0;$i<=count($mojerezniz)-1;$i++)
                    <img src="/uploads/dogslike/male/{{$dogadjajniz[$i]->malaslika}}" alt="" width="180" height="126" />

                    <div>

                        <h4>Naziv: {{$dogadjajniz[$i]->naziv}} </h4>

                        <br><h5>Mesto odrzavanja: {{$dogadjajniz[$i]->mesto}} </h5>

                        <h5>Vreme odrzavanja: {{$dogadjajniz[$i]->datum_odr}} u {{$dogadjajniz[$i]->vreme_odr}} čas.</h5>

                        <h5>Broj rezervacije: {{$mojerezniz[$i]->id}}</h5>
                        <h5>Datum rezervacije: {{$mojerezniz[$i]->datum_rez}} u {{$mojerezniz[$i]->vreme_rez}} čas.</h5>
                        <h5>Važi do: {{$mojerezniz[$i]->datum_vazi_do}} do {{$mojerezniz[$i]->vreme_vazi_do}} čas.</h5>

                        <h5>Kategorija: {{$kategorijaniz[$i]->naziv}}</h5>

                        <h5>Količina: {{$mojerezniz[$i]->kolicina}} kom.</h5>

                        <h5>Cena: {{number_format($kategorijaniz[$i]->cena,2)}} din.</h5>
                        <h5>&nbsp;-----------------------------</h5>
                        <h5>UKUPNO: {{number_format($kategorijaniz[$i]->cena*$mojerezniz[$i]->kolicina,2)}} din.</h5>
                        <br />

                        @if($dogadjajniz[$i]->arhiva==1)
                            <h5><span class="crvenaslova">OTKAZAN DOGADJAJ</span> </h5>
                        @endif
                        @if(time()>strtotime($mojerezniz[$i]->vazi_do))
                            <h5><span class="crvenaslova">REZERVACIJA JE ISTEKLA</span> </h5>
                        @endif

                        @if($dogadjajniz[$i]->arhiva==1 || time()>strtotime($mojerezniz[$i]->vazi_do))
                        @else
                            <input type="button" value="Otkaži Rezervaciju" onclick="if(confirm('Da li ste sigurni da želite da otkažete ovu rezervaciju?')) location.href='{{url('/mojerez/otkazi/'.$mojerezniz[$i]->id)}}'">
                        @endif

                         <p></p>
                        <br />&nbsp;

                    </div>
                @endfor
            @endif

        </div>
    </div>
@endsection