@extends('layouts.admin')

@section('main')
    <div id="central">

        <h1>Novi korisnik</h1>

        <div id="register">
            <br />
            <form name="regforma" action="{{url('admin/dodajnovogkor')}}" method="POST">
                {{ csrf_field() }}
                <table border="0" cellspacing="5">
                    @if(Session::has('message'))
                       <tr>
                           <td colspan="3"><font color="red">{{Session::get('message')}}</font></td>
                    </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                    @endif

                    <tr>
                        <td><label for="uloga">Uloga:</label></td>
                        <td>
                            <select name="uloga" onchange="showHide(this.value);">
                                <option selected value="0">Korisnik</option>
                                <option value="1">Blagajnik</option>
                                <option value="2">Administrator</option>
                            </select>
                            </td>
                        <td></td>
                    </tr>

                  <tr id="mestorada" style="display: none">
                        <td><label for="mesto_id">Mesto rada:</label> </td>
                        <td>
                            <select name="mesto_id">

                               @foreach($mesta as $mesto)
                                <option selected value="{{$mesto->id}}">{{$mesto->naziv}}</option>
                                @endforeach

                            </select>
                            </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label for="ime">Ime:</label></td>
                        <td><input type="text" size="20" name="ime" value="{{ old('ime') }}" >*</td>
                        <td></td>
                        </tr>
                        <tr>
                            <td></td><td colspan="2">
                            @if ($errors->has('ime'))
                                <font color="red">
                                    {{ $errors->first('ime') }}
                                </font>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label for="prezime">Prezime:</label></td>
                        <td><input type="text" size="20" name="prezime" value="{{old('prezime') }}" >*</td>
                        <td></td>
                    </tr>
                        <tr>
                            <td></td><td colspan="2">
                        @if ($errors->has('prezime'))
                            <font color="red">
                                {{ $errors->first('prezime') }}
                            </font>
                            @endif
                            </td>
                    </tr>
                    <tr>
                        <td><label for="username">Korisničko ime:</label></td>
                        <td><input type="text" size="20" name="username" value="{{ old('username') }}" >*</td>
                        <td></td>
                    </tr>
                        <tr>
                            <td></td><td colspan="2">
                            @if ($errors->has('username'))
                                <font color="red">
                                    {{ $errors->first('username') }}
                                </font>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label for="password">Lozinka:</label></td>
                        <td> <input type="password" size="20" name="password" >*</td>
                        <td></td>
                    </tr>
                        <tr>
                            <td></td><td colspan="2">
                            @if ($errors->has('password'))
                                <font color="red">
                                    {{ $errors->first('password') }}
                                </font>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label for="password_confirmation">Potvrda Lozinke:</label></td>
                        <td><input type="password" size="20" name="password_confirmation" >*</td>
                        <td></td>
                    </tr>
                        <tr>
                            <td></td><td colspan="2">
                            @if ($errors->has('password_confirmation'))
                                <font color="red">
                                    {{ $errors->first('password_confirmation') }}
                                </font>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" size="20" name="email" value="{{ old('email') }}" >*</td>
                        <td></td>
                    </tr>
                        <tr>
                            <td></td><td colspan="2">
                            @if ($errors->has('email'))
                                <font color="red">
                                    {{ $errors->first('email') }}
                                </font>
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <td><label for="adresa">Adresa (Ulica i broj):</label></td>
                        <td colspan="2"><input type="text" size="40" name="adresa" value="{{ old('adresa') }}"></td>
                    </tr>
                    <tr>
                        <td><label for="grad">Adresa (Grad):</label></td>
                        <td colspan="2"><input type="text" size="40" name="grad" value="{{ old('grad') }}"></td>
                    </tr>
                    <tr>
                        <td><label for="tel">Tel:</label></td>
                        <td><input type="text" size="20" name="tel" value="{{ old('tel') }}" >*</td>
                        <td></td>
                    </tr>
                        <tr>
                            <td></td><td colspan="2">
                            @if ($errors->has('tel'))
                                <font color="red">
                                    {{ $errors->first('tel') }}
                                </font>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label for="status"> Status:</label></td>
                        <td>
                            <select name="status">
                                <option selected value="1">Aktivan</option>
                                <option value="0">Neaktivan</option>
                                <option value="2">Blokiran</option>
                            </select>
                            </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>* Obavezna polja</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center"><br>
                            <input type="submit" value="Pošalji"> &nbsp; <input type="reset" value="Obriši"></td>
                    </tr>
                </table>
            </form>



        </div>


    </div>
    <script>
        function showHide(value) {
            if (value=='1')
                document.getElementById('mestorada').style.display = 'table-row';
            else
                document.getElementById('mestorada').style.display = 'none';
        }

    </script>

@endsection
