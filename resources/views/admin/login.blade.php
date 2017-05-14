@if (Auth::check())
    <div class="right_block" xmlns="http://www.w3.org/1999/html">
        <p class="title2">Login</p>
        <div class="item">
        <span class="wellcomeuser"> Dobrodošli,&nbsp;<b> {{ Auth::user()->ime }} </b></span>
            @if(Auth::user()->uloga==1)
                <br />
                <span class="text3"> Mesto rada:
                    @foreach(App\Mesto::select('naziv')->where('id',Auth::user()->mesto_id)->get() as $k=>$v)
                        {{$v->naziv}}
                    @endforeach
                    </span>
            @endif
        <br /><br />
        <input type="button" value="Odjavi se" onClick="parent.location='{{ url('admin/logout') }}'">
        <ul class="contries">
            @if (($errors->has('username')) || ($errors->has('email')) || ($errors->has('password')))
                <li><font color="red">Netačan unos podataka !</font></li> <br />
            @endif

            @if(Request::path() == 'admin/passres')

                    <li>
                        <a href="{{ URL::previous() }}">Odustani</a>
                   </li>
                    <br /><br />

                <form name="promena_lozinke" method="POST" action="{{ url('/passreset') }}">
                    {{ csrf_field() }}
                    <li>
                        <span class="style1">
                            <label for="password">Trenutna lozinka:&nbsp;</label>
                            <input type="password" name="password" class="select4" />
                           
                        </span>
                    </li>
                    @if (Session::has('message'))
                        <li>
                            <font color="red">{{Session::get('message')}} </font>
                        </li>
                    @elseif ($errors->has('password'))
                        <li>
                            <font color="red">{{ $errors->first('password') }} </font>
                        </li>
                    @endif
                    <li>
                        <span class="style1">
                            <label for="new_password">Nova lozinka:&nbsp;</label>
                            <input type="password" name="new_password" class="select4" />
                        </span>
                    </li>
                    @if ($errors->has('new_password'))
                        <li>
                            <font color="red">{{ $errors->first('new_password') }} </font>
                        </li>
                    @endif
                    <li>                
                        <span class="style1">
                            <label for="new_password_confirmation">Potvrdi novu lozinku:&nbsp;</label>
                            <input type="password" name="new_password_confirmation" class="select4" />
                        </span>
                    </li>
                    @if ($errors->has('new_password_confirmation'))
                        <li>
                            <font color="red">{{ $errors->first('new_password_confirmation') }} </font>
                        </li>
                    @endif
                    <br />
                    &nbsp;&nbsp;<input type="submit" value="Pošalji">

                </form>

            @else
                <li><a href="{{ url('admin/passres') }}">Promeni lozinku</a></li>
            @endif
        </ul>


        </div>
        <img src="/images/right_bot.gif" alt="" width="261" height="21" /><br />

   </div>

@else

@endif