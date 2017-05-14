@extends('layouts.app')
@include('levimeni')
@section('main')
    <div id="big1">
        <h1>Kupljene ulaznice</h1>
        <br/>

        <div class="block1">
            <br />
            @if($mojerezniz == null || $mojerezniz == '')
                Nemate nijednu kupljenu ulaznicu!
            @else
                @for($i=0;$i<=count($mojerezniz)-1;$i++)
               {{-- @for($i=count($mojerezniz)-1;$i>=0;$i--)   --}}
                    <img src="/uploads/dogslike/male/{{$dogadjajniz[$i]->malaslika}}" alt="" width="180" height="126" />

                    <div>
                        @if(strtotime($dogadjajniz[$i]->vreme_odr)<time())
                        <span class="sivaslova">
                        @else
                         <span>
                         @endif

                        <h4>Naziv: {{$dogadjajniz[$i]->naziv}} </h4>

                        <br><h5>Mesto odrzavanja: {{$dogadjajniz[$i]->mesto}} </h5>

                        <h5>Vreme odrzavanja: {{$dogadjajniz[$i]->datum_odr}} u {{$dogadjajniz[$i]->cas_odr}} čas.</h5>
                        @if($dogadjajniz[$i]->arhiva==1)
                            <h5><span class="crvenaslova">OTKAZAN DOGADJAJ</span> </h5>
                        @endif
                        <h5>Kategorija: {{$kategorijaniz[$i]->naziv}}</h5>
                        <h5>Količina: {{$mojerezniz[$i]->kolicina}} kom.</h5>
                        <h5>Cena: {{number_format($kategorijaniz[$i]->cena,2)}} din.</h5>
                        <h5>-----------------------------</h5>
                        <h5>NAPLAĆENO: {{number_format($kategorijaniz[$i]->cena*$mojerezniz[$i]->kolicina,2)}} din.</h5>
                       </span>

                        <p></p>
                        <br />&nbsp;
                    </div>
                @endfor
             @endif

        </div>
    </div>
@endsection