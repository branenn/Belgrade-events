@extends('layouts.blagajnik')

@section('main')
    <div id="central">

        <h1>Pregled rezervisanih ulaznica <br > korisnika: <span class="crvenaslova2">{{$korisnik->prezime}} {{$korisnik->ime}}</span> </h1>
        <br />
        <div class="block">

           @if($rezkorisnika == null || $rezkorisnika == '')
                Korisnik nema rezervisan nijedan događaj!
           @else


                    @for($i=0;$i<=count($rezkorisnika)-1;$i++)
                        <img src="/uploads/dogslike/male/{{$dogadjaj[$i]->malaslika}}" alt="" width="180" height="126" />

                        <div>

                            <h4>Naziv: {{$dogadjaj[$i]->naziv}} </h4>

                            <br /><h5>Mesto odrzavanja: {{$dogadjaj[$i]->mesto}} </h5>

                            <h5>Vreme odrzavanja: {{$dogadjaj[$i]->datum_odr}} u {{$dogadjaj[$i]->vreme_odr}} čas.</h5>

                            <h5>Broj rezervacije: {{$rezkorisnika[$i]->id}}</h5>

                            <h5>Važi do: {{$rezkorisnika[$i]->datum_vazi_do}} do {{$rezkorisnika[$i]->vreme_vazi_do}} čas.</h5>

                            <h5>Kategorija: {{$kategorija[$i]->naziv}}</h5>

                            <h5>Količina: {{$rezkorisnika[$i]->kolicina}} kom.</h5>

                            <h5>Cena: {{number_format($kategorija[$i]->cena,2)}} din.</h5>
                            <h5>-----------------------------</h5>
                            <h5>UKUPNO: {{number_format($kategorija[$i]->cena*$rezkorisnika[$i]->kolicina,2)}} din.</h5>
                            <br />


                            @if(Auth::user()->mesto_id == $dogadjaj[$i]->mesto_id)

                                @if($dogadjaj[$i]->arhiva==1)
                                    <h5><span class="crvenaslova">OTKAZAN DOGADJAJ</span> </h5>
                                @endif
                                @if(time()>strtotime($rezkorisnika[$i]->vazi_do))
                                    <h5><span class="crvenaslova">REZERVACIJA JE ISTEKLA</span> </h5>
                                @endif



                                @if($dogadjaj[$i]->arhiva==1 || time()>=strtotime($rezkorisnika[$i]->vazi_do))
                                @else
                                    <form name="prodajaraz" method="get" action="{{url('/admin/prodaja/rezervacije/'.$rezkorisnika[$i]->id)}}" onreset="location.href='/admin/prodaja/rezervacije'">

                                        <input type="submit" value="Kupovina">&nbsp;<input type="reset" value="Otkaži">
                                    </form>

                                @endif

                            @endif

                            <p></p>

                        </div>
                    @endfor
                @endif



        </div>


    </div>


@endsection