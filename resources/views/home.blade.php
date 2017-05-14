@extends('layouts.app')

@section('main')
<div id="big">
    <h1>Najnoviji dogadjaji</h1>
    <br/>

    <div class="block">
        <br />

        @foreach($dog as $dog1)

            <img src="/uploads/dogslike/male/{{$dog1->malaslika}}" alt="" width="180" height="126" />

            <div>

                <h4>Naziv: {{$dog1->naziv}} </h4>

                <br><h5>Mesto odrzavanja: {{$dog1->mesto}} </h5>

                <h5>Vreme odrzavanja: {{$dog1->vreme_odr_dan}} u {{$dog1->vreme_odr_sat}}</h5>
                <p>{{$dog1->opis_s}}
                <br />
                <a href="{{url('dogadjaj/'.$dog1->id)}}" class="more">Detaljnije</a>


                <br />&nbsp;
                </p>

            </div>
        @endforeach
    </div>
</div>
@endsection
