@extends('layouts.admin')

@section('main')
    <div id="central">
        <div class="block">
            <h1>Lista dogadjaja sa ocenama</h1>
            <br />
            <form name="sortiranje" action="{{url('/admin/dogadjaji')}}" method="get">
            <label for="sortiranje">Sortiraj:</label>

            <select name="sortiranje" onchange="submit()">
                <option value="1" @if($sortiranje == '1') {{'selected="selected"'}} @endif >Po nazivu rastuće</option>
                <option value="2" @if($sortiranje == '2') {{'selected="selected"'}} @endif>Po nazivu opadajuće</option>
                <option value="3" @if($sortiranje == '3') {{'selected="selected"'}} @endif>Po oceni rastuće</option>
                <option value="4" @if($sortiranje == '4') {{'selected="selected"'}} @endif>Po oceni opadajuće</option>
                <option value="5" @if($sortiranje == '5') {{'selected="selected"'}} @endif>Po ID-u rastuće</option>
                <option value="6" @if($sortiranje == '6') {{'selected="selected"'}} @endif>Po ID-u opadajuće</option>
            </select>
             </form>
            <br />
            <br />
            @if($stranice)
                @foreach($stranice as $dog1)
                    <img src="/uploads/dogslike/male/{{$dog1->malaslika}}" alt="" width="180" height="126" />
                    <div>
                        <h4>ID: {{$dog1->id}}</h4>
                        <br>
                        <h5>Naziv: {{$dog1->naziv}} </h5>
                        <h5>Ocena: <span class="crvenaslova">{{number_format($dog1->ocena,1)}}</span>  </h5>
                        <br />&nbsp;
                        <p></p>
                        <br />&nbsp;
                    </div>
                @endforeach
                    <br />
                    <ul id="stranice">{!! $stranice->render() !!}</ul>
            @else
                <br />
                <h4>Nema ocenjenih dogadjaja</h4>
            @endif
        </div>
    </div>
@endsection