@extends('layouts.admin')

@section('main')


    <div id="central">
        <div class="block">

            <div>

                <div>

                    <h1>Dodavanje novog mesta rada</h1>



                    <br>
                    <br>
                    <form name="formanovomesto" method="POST" action="{{url('/admin/novomesto')}}">
                        {{ csrf_field() }}
                        <table id="tabela " border="0" cellspacing="10" cellpadding="10">

                            @if(Session::has('poruka'))

                                 <tr>
                                     <td colspan="2"><font color="red">{{Session::get('poruka')}}</font></td>
                                 </tr>

                            @endif


                            <tr><td><label for="naziv">Naziv:</label></td><td><input type="text" name="naziv" value="{{old('naziv')}}" /></td></tr>
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
                            <tr><td><label for="adresa">Adresa:</label></td><td><input type="text" name="adresa" value="{{old('adresa')}}" /></td></tr>
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
                                    <input type="submit" value="Dodaj">&nbsp;<input type="button" value="Odustani" onclick="parent:location='{{url('admin/adminhome')}}'"></td>
                            </tr>

                        </table>
                    </form>
                    <p></p>

                </div>

            </div>
        </div>

    </div>



@endsection