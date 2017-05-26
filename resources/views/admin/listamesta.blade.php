@extends('layouts.admin')

@section('main')
    <div id="central">

        <h1>Lista mesta rada</h1>
        <br /><br />
        <div class="block1">

            @foreach($mesta as $mesto)

                <div>

                    <h4>Id: {{$mesto->id}} </h4>
                    <h5>Naziv: {{$mesto->naziv}}</h5>
                    <h5>Adresa: {{$mesto->adresa}}</h5>

                    <br />&nbsp;
                    <input type="button" value="Izmeni" onclick="location.href='{{url('/admin/mesto/'.$mesto->id)}}'">


                    <p></p>
                    <br />&nbsp;



                </div>
            @endforeach

        </div>

    </div>
@endsection