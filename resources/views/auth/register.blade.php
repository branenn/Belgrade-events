@extends('layouts.app')

@section('main')
<div id="big">

    @if (Request::is('dogadjaj/*'))
        <h5><span class="crvenaslova">Samo registrovani korisnici mogu da vide detalje dogadjaja</span> </h5>
        <br />

    @endif
    <div id="register">
	<form name="regforma" action="{{ url('/register') }}" method="POST">
                 {{ csrf_field() }}
            <table border="0" cellspacing="5">
                <tr>
                    <td><label for="ime">Ime:</label></td>
                    <td><input type="text" size="20" name="ime" value="{{ old('ime') }}">*</td>
                    <td>
                        @if ($errors->has('ime'))
                        <font color="red">
                            {{ $errors->first('ime') }}
                        </font>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><label for="prezime">Prezime:</label></td>
                    <td><input type="text" size="20" name="prezime" value="{{ old('prezime') }}">*</td>
                    <td>
                    @if ($errors->has('prezime'))
                        <font color="red">
                            {{ $errors->first('prezime') }}
                        </font>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><label for="username">Korisničko ime:</label></td>
                    <td><input type="text" size="20" name="username" value="{{ old('username') }}">*</td>
                    <td>
                    @if ($errors->has('username'))
                        <font color="red">
                            {{ $errors->first('username') }}
                        </font>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Lozinka:</label></td>
                    <td> <input type="password" size="20" name="password">*</td>
                    <td>
                    @if ($errors->has('password'))
                        <font color="red">
                            {{ $errors->first('password') }}
                        </font>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><label for="password_confirmation">Potvrda Lozinke:</label></td>
                    <td><input type="password" size="20" name="password_confirmation">*</td>
                    <td>
                        @if ($errors->has('password_confirmation'))
                        <font color="red">
                            {{ $errors->first('password_confirmation') }}
                        </font>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" size="20" name="email" value="{{ old('email') }}">*</td>
                    <td>
                        @if ($errors->has('email'))
                        <font color="red">
                            {{ $errors->first('email') }}
                        </font>
                        @endif
                    </td>
                    
                </tr>
                <tr>
                    <td><label for="adresa">Adresa (Ulica i broj):</label></td>
                    <td colspan="2"><input type="text" size="45" name="adresa" value="{{ old('adresa') }}"></td>
                </tr>
                <tr>
                    <td><label for="grad">Adresa (Grad):</label></td>
                    <td colspan="2"><input type="text" size="45" name="grad" value="{{ old('grad') }}"></td>
                </tr>
                <tr>
                    <td><label for="tel">Tel:</label></td>
                    <td><input type="text" size="20" name="tel" value="{{ old('tel') }}">*</td>
                    <td>
                        @if ($errors->has('tel'))
                        <font color="red">
                            {{ $errors->first('tel') }}
                        </font>
                        @endif
                    </td>
                </tr>
                 <tr>
                    <td>&nbsp;</td><td></td><td></td>
                </tr>
                <tr>
                    <td>* Obavezna polja</td><td></td><td></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><br />
                        <input type="submit" name="regdugme" value="Pošalji"> &nbsp; <input type="reset" value="Obriši"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection
