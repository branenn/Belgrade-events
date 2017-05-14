@extends('layouts.admin')

@section('main')
<div id="central">

    <h1>Lista korisnika</h1>
    <br />
    <div class="block">

@foreach($korisnici as $kor)
        <img src="/images/user.jpg" alt="" width="120" height="120" />
        <div>

            <h4>Id: {{$kor->id}} </h4>
            <h5>Kor.Ime: {{$kor->username}}</h5>
            @if($kor->uloga=='Korisnik')
                <h5>Uloga: {{$kor->uloga}}</h5>
            @elseif($kor->uloga=='Blagajnik')
                <h5>Uloga:<font color="green"> {{$kor->uloga}}</font></h5>
            @elseif($kor->uloga=='Administrator')
                <h5>Uloga: <font color="blue">{{$kor->uloga}}</font></h5>
            @endif
            <br /><h5>Ime: {{$kor->ime}} </h5>
            <h5>Prezime: {{$kor->prezime}} </h5>
            @if($kor->status=='Neaktivan')
               <h5>Status:  <font color="#ff8c00">{{$kor->status}} </font></h5>
            @elseif($kor->status=='Aktivan')
                <h5>Status: {{$kor->status}} </h5>
            @elseif($kor->status=='Blokiran')
               <h5>Status:  <font color="red">{{$kor->status}}</font> </h5>
            @endif

            <br />&nbsp;
            <input type="button" value="Uredi korisnika" onclick="location.href='{{url('/admin/korisnik/'.$kor->id)}}'">

            <p></p>
            <br />&nbsp;



        </div>
        @endforeach

    </div>

</div>
@endsection