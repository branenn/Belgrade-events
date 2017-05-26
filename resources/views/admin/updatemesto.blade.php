@extends('layouts.admin')

@section('main')


    <div id="central">
        <div class="block">

            <div>

                <div>

                    <h1>Uredjivanje mesta rada:<br /> <font color="blue">{{$mesto->naziv}}</font></h1>



                    <br>
                    <br>
                    <form name="formamesto" method="POST" action="{{url('/admin/mesto/'.$mesto->id)}}">
                        {{ csrf_field() }}
                        <table id="tabela " border="0" cellspacing="10" cellpadding="10">

                            @if(Session::has('poruke'))
                                @foreach(Session::get('poruke') as $poruka)
                                    <tr>
                                        <td colspan="2"><font color="red">{{$poruka}}</font></td>
                                    </tr>

                                @endforeach
                            @endif

                            <tr><td>ID mesta:</td><td>{{$mesto->id}}</td></tr>


                            <tr><td><label for="naziv">Naziv:</label></td><td><input type="text" name="naziv" value="{{$mesto->naziv}}" /></td></tr>
                            @if ($errors->has('naziv'))
                                <tr>
                                    <td></td>
                                    <td>
                                        <font color="red">
                                            {{ $errors->first('naziv') }}
                                        </font>
                                    </td>
                                </tr>
                            @endif
                            <tr><td><label for="adresa">Adresa:</label></td><td><input type="text" name="adresa" value="{{$mesto->adresa}}" /></td></tr>
                            @if ($errors->has('adresa'))
                                <tr>
                                    <td></td>
                                    <td>
                                        <font color="red">
                                            {{ $errors->first('adresa') }}
                                        </font>
                                    </td>
                                </tr>
                            @endif


                            <tr> <td colspan="2" align="center"><br>
                                    <input type="submit" value="Izmeni">&nbsp;<input type="button" value="Odustani" onclick="parent:location='{{url('admin/listamesta')}}'"></td>
                            </tr>

                        </table>
                    </form>
                    <p></p>

                </div>

            </div>
        </div>

    </div>



@endsection