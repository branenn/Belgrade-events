@if (Auth::check())
<div id="left_navigation">
    <img src="/images/gtop.gif" alt="" width="191" height="8" />
	<div class="title1">Login</div>                               
            <span> &nbsp;&nbsp;Dobrodošli,&nbsp;<b> {{ Auth::user()->ime }} </b></span>
            <br /><br />                
            &nbsp;&nbsp; <input type="button" value="Odjavi se" onClick="parent.location='{{ url('/logout') }}'">
                <ul class="contries"> 
    @if (($errors->has('username')) || ($errors->has('email')) || ($errors->has('password')))  
                    <li><font color="red">Netačan unos podataka !</font></li> <br />               
    @endif  
             
    @if(Request::path() == 'passres')
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
                    <li><a href="{{ url('/passres') }}">Promeni lozinku</a></li>
    @endif
                </ul>
                <img src="/images/gbot.gif" alt="" width="191" height="8" />
</div>

@else
<div id="left_navigation">
    <img src="/images/gtop.gif" alt="" width="191" height="8" />
	<div class="title1">Login</div>
            <form name="forma_login" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}     
                <table border="0" width="80%" style="margin-left: auto;margin-right: auto">  
    @if (Session::has('message'))
                    <tr>
                        <td>
                            <span class="style1"><font color="red">{{Session::get('message')}} </font></span>
                        </td>
                    </tr> 
    @endif
                    <tr>
                        <td>
                            <span class="style1">
                                <label for="username">Korisnicko ime:&nbsp;</label>
                                <input type="text" name="username" class="select4" value="{{ old('username') }}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="style1">
                                <label for="password">Lozinka:&nbsp;</label>
                                <input type="password" name="password" class="select4" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="logindugme" value="Pošalji">                       
                       </td>
                    </tr>
                </table>
            </form>
                                
            <ul class="contries">
               
    @if (($errors->has('username')) || ($errors->has('email')) || ($errors->has('password'))) 
                <li><font color="red">Netačan unos podataka !</font></li> <br />               
    @endif      
                <li><a href="{{ url('/register') }}">Registracija</a></li>
            </ul>
        <img src="/images/gbot.gif" alt="" width="191" height="8" />
</div>
@endif