@extends('layouts.blagajnik')

@section('main')
    <div id="central">

        <h1>Pregled događaja</h1>
        <br />
        <div class="block">
            @if(Session::has('por'))
                <ul>
               <li><span class="crvenaslova">{{Session::get('por')}}</span></li>
                </ul>
                <br />
            @endif

            @foreach($dog as $dog1)

                <img src="/uploads/dogslike/male/{{$dog1->malaslika}}" alt="" width="180" height="126" />

                <div>

                    <h4>Naziv: {{$dog1->naziv}} </h4>

                    <br><h5>Mesto odrzavanja: {{$dog1->mesto}} </h5>

                    <h5>Vreme odrzavanja: {{$dog1->datum_odr}} u {{$dog1->vreme_odr}} čas.</h5>
                    @if($dog1->arhiva==1)
                    <h5><span class="crvenaslova">OTKAZAN</span> </h5>
                    @endif
                    <br />&nbsp;
                    <input type="button" value="Izmeni" onclick="location.href='{{url('admin/dogadjaj/'.$dog1->id)}}'">&nbsp;
                    <input type="button" value="Otkaži" onclick="if(confirm('UPOZORENJE!\nOva radnja se ne može poništiti.\nSvi korisnici koji su rezervisali/kupili ulaznice će dobiti email obaveštenje.\nDa li ste sigurni da želite da otkažete dogadjaj?')){location.href='{{url('admin/dogadjaj/otkazi/'.$dog1->id)}}';}return false;">

                    <p></p>
                    <br />&nbsp;

                </div>
            @endforeach

        </div>


    </div>
@endsection