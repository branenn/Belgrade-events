@extends('layouts.blagajnik')

@section('main')
    <div id="central">
        <h1>Pregled otkazanih događaja</h1>
        <br />
        <div class="block">
            @if(Session::has('por'))
                <ul>
                    <li><span class="crvenaslova">{{Session::get('por')}}</span></li>
                </ul>
                <br />
            @endif
            @foreach($stranice as $dog1)
                <img src="/uploads/dogslike/male/{{$dog1->malaslika}}" alt="" width="180" height="126" />
                <div>
                    <h4>Naziv: {{$dog1->naziv}} </h4>
                    <br><h5>Mesto odrzavanja: {{$dog1->mesto}} </h5>
                    <h5>Vreme odrzavanja: {{$dog1->datum_odr}} u {{$dog1->vreme_odr}} čas.</h5>
                    @if($dog1->arhiva==1)
                        <h5><span class="crvenaslova">OTKAZAN</span> </h5>
                    @endif
                    <br />&nbsp;
                    <p></p>
                    <br />&nbsp;
                </div>
            @endforeach
                <br />
                <ul id="stranice">{!! $stranice->render() !!}</ul>
        </div>
    </div>
@endsection