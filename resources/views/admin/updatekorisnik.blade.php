@extends('layouts.admin')

@section('main')


    <div id="central">
        <div class="block">

            <div>

                <div>

                    <h1>Uredjivanje korisnika:<br /> <font color="blue">{{$user->username}}</font></h1>



                    <br>
                    <br>
                    <form name="formakorisnik" method="POST" action="{{url('/admin/korisnik/'.$user->id)}}">
                        {{ csrf_field() }}
                        <table id="tabela " border="0" cellspacing="10" cellpadding="10">

                            @if(Session::has('poruke'))
                                @foreach(Session::get('poruke') as $poruka)
                                <tr>
                                    <td colspan="2"><font color="red">{{$poruka}}</font></td>
                                </tr>

                                @endforeach
                            @endif

                            <tr><td>ID korisnika:</td><td>{{$user->id}}</td></tr>
                            <tr>
                                <td><label for="uloga">Uloga:</label></td><td>
                                    <select id="uloga" name="uloga">
                                        <option value="{{$user->uloga}}" selected>{{$uloga}}</option>
                                        <option value="0">Korisnik</option>
                                        <option value="1">Blagajnik</option>
                                        <option value="2">Administrator</option>
                                    </select>

                                </td>
                            </tr>


                            <tr class="mestorada">
                                <td><label for="mesto_id">Mesto rada:</label></td>
                                <td>
                                    <select name="mesto_id">
                                        @if($mestorada)
                                        <option value="{{$user->mesto_id}}" selected>{{$mestorada->naziv}}</option>
                                        @else
                                            <option value="" selected>Nije postavljeno</option>
                                        @endif
                                        @foreach(App\Mesto::all() as $mesto)
                                            <option value="{{$mesto->id}}">{{$mesto->naziv}}</option>
                                               @endforeach

                                    </select>
                                </td>
                            </tr>


            <tr><td><label for="ime">Ime:</label></td><td><input type="text" name="ime" value="{{$user->ime}}" /></td></tr>
                @if ($errors->has('ime'))
                   <tr>
                       <td></td>
                       <td>
                           <font color="red">
                        {{ $errors->first('ime') }}
                    </font>
                       </td>
                    </tr>
                @endif
            <tr><td><label for="prezime">Prezime:</label></td><td><input type="text" name="prezime" value="{{$user->prezime}}" /></td></tr>
                @if ($errors->has('prezime'))
                    <tr>
                        <td></td>
                        <td>
                            <font color="red">
                                {{ $errors->first('prezime') }}
                            </font>
                        </td>
                    </tr>
                @endif
            <tr><td>Kor.Ime:</td><td>{{$user->username}}</td></tr>
                <tr><td><label for="password">Nova lozinka :</label></td><td><input type="password" name="password" value="" /></td></tr>
                @if ($errors->has('password'))
                    <tr>
                        <td></td>
                        <td>
                            <font color="red">
                                {{ $errors->first('password') }}
                            </font>
                        </td>
                    </tr>
                @endif
            <tr><td><label for="password_confirmation">Potvrda nove lozinke :</label></td><td><input type="password" name="password_confirmation" value="" /></td></tr>
                @if ($errors->has('password_confirmation'))
                    <tr>
                        <td></td>
                        <td>
                            <font color="red">
                                {{ $errors->first('password_confirmation') }}
                            </font>
                        </td>
                    </tr>
                @endif
            <tr><td>Email</td><td>{{$user->email}}</td></tr>
                <tr><td><label for="tel">Tel:</label></td><td><input type="text" name="tel" value="{{$user->tel}}" size="20" /></td></tr>
                @if ($errors->has('tel'))
                    <tr>
                        <td></td>
                        <td>
                            <font color="red">
                                {{ $errors->first('tel') }}
                            </font>
                        </td>
                    </tr>
                @endif
            <tr><td><label for="adresa">Adresa(ulica i broj):</label></td><td><input type="text" name="adresa" value="{{$user->adresa}}" size="25" /></td></tr>
            <tr><td><label for="grad">Adresa(Grad):</label></td><td><input type="text" name="grad" value="{{$user->grad}}" size="20" /></td></tr>
            <tr><td><label for="status">Status:</label></td>
                <td>
                    <select name="status">
                        <option value="{{$user->status}}"selected>{{$status}}</option>
                        <option value="0">Neaktivan</option>
                        <option value="1">Aktivan</option>
                        <option value="2">Blokiran</option>
                    </select>

                </td>
            </tr>

            <tr> <td colspan="2" align="center"><br>
                    <input type="submit" value="Izmeni">&nbsp;<input type="button" value="Odustani" onclick="parent:location='{{url('admin/listakorisnika')}}'"></td>
            </tr>

        </table>
    </form>
    <p></p>

</div>

</div>
</div>

</div>

<script type="text/javascript">
$(document).ready(function() {

if ($('#uloga').val()=='1'){
$(".mestorada td").show();
}else{
$(".mestorada td").hide();
}

$('#uloga').change(function () {
var val = $(this).val();
if (val == '1') {
    $('.mestorada td').show();
} else {
    $('.mestorada td').hide();
}
});
});
</script>



@endsection