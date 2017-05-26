@extends('layouts.admin')

@section('main')
    <div id="central">

        <h1>Lista Top 10 korisnika za mesec <span class="zelenaslova">{{$proslimesec}}</span>
        </h1>
        <br /><br />
        <div class="block">
            @foreach($korisnici as $kor)
                <img src="/images/user.jpg" alt="" width="120" height="120" />
                <div>
                    <h4>Id: {{$kor->id}} </h4>
                    <h5>Broj kupljenih ulaznica: <span class="crvenaslova">{{$kor->brkuplj}}</span> </h5>

                    <h5>Kor.Ime: {{$kor->username}}</h5>
                    <h5>Email:{{$kor->email}}</h5>
                    <br /><h5>Ime: {{$kor->ime}} </h5>
                    <h5>Prezime: {{$kor->prezime}} </h5>
                    <h5>Adresa:  {{$kor->adresa}}</h5>
                    <h5>Grad: {{$kor->grad}} </h5>

                    <p></p>
                    <br />&nbsp;



                </div>
            @endforeach
        </div>
    </div>
@endsection