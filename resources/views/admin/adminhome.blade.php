@extends('layouts.admin')

@section('main')
    <div id="central">
        <div class="block">
            <h1>Lista zahteva za registraciju</h1>
            <br />
            @if(Session::has('poruka'))
               <span class="crvenaslova">{{Session::get('poruka')}}</span>
                <br /><br />
            @endif




            @if($korisnici)
            @foreach($korisnici as $kor)

                <img src="/images/user.jpg" alt="" width="120" height="120" />
                <div>

                    <h4>Id: {{$kor->id}} </h4>
                    <h5>Kor.Ime: {{$kor->username}}</h5>
                    <h5>Email: {{$kor->email}} </h5>

                    <br /><h5>Ime: {{$kor->ime}} </h5>
                    <h5>Prezime: {{$kor->prezime}} </h5>
                    <h5>Adresa: {{$kor->adresa}}</h5>
                    <h5>Grad: {{$kor->grad}}</h5>
                    <h5>Tel: {{$kor->tel}}</h5>

                    <br />&nbsp;

                    {{--samo funkcija u routes ako moze sa porukom koja se vraca nazad--}}
                    <input type="button" value="Aktiviraj nalog" onclick="location.href='{{url('/admin/korisnik/aktivacija/'.$kor->id)}}'">
                    &nbsp;
                    <input type="button" value="Odbaci zahtev" onclick="if(confirm('Nakon ove radnje svi podaci o zahtevu će biti obrisani.\nDa li ste sigurni da želite da odbacite zahtev za registraciju?')){location.href='{{url('/admin/korisnik/odbaci/'.$kor->id)}}'}else{return false;}">

                    <p></p>
                    <br />&nbsp;



                </div>
            @endforeach
                @else
                <br />
            <h4>Nema novih zahteva za registraciju</h4>
                @endif







    </div>
    </div>
@endsection