@extends('layouts.app')

@section('main')
    <div id="big">
        {{--
        @if Auth::check()
        mislim da treba probati iz kontrolera pa da vrati razlicit view ako nije ulogovan da vrati tj, inkluduje reg formu i da se vidi sta ako je blokiran i td.


        --}}

        @if(Session::has('message'))
            <ul>
                <li class="crvenaslova">{{Session::get('message')}}</li>

            </ul>
            <br /> <br />
        @endif

            <h2>Naziv: {{$dogadjaj->naziv}}
            <br />Mesto održavanja: {{$mesto->naziv}}
            <br />Vreme održavanja: {{$dogadjaj->vreme_odr_dan}} u {{$dogadjaj->vreme_odr_sat}}</h2>

            <div class="big_photo">
            <img src="/uploads/dogslike/velike/{{$dogadjaj->velikaslika}}" alt="" width="578" height="361" /><br />
            </div>

            <h4>Opis </h4>
            <br>
            <div class="text3">
            <p>{{$dogadjaj->opis_s}}<br />{{$dogadjaj->opis_p}}</p>
            <br /><br />
            <table border="0" cellspacing="5" width="578px">
        @if($dogadjaj->arhiva==1)
                        <tr>
                            <td colspan="4"><span class="crvenaslova">DOGAĐAJ JE OTKAZAN!</span></td>
                        </tr>
        @elseif(strtotime($dogadjaj->vreme_odr)<=time())
        @else
                        <tr>
                            <th colspan="4" align="center">Ulaznice: </th>
                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;<input type="hidden" name="ulaznica_id" value="{{$ulaznica->id}}" /> </td>

                        </tr>
                        <tr>
                            <td>Kategorija: </td><td>Cena: </td><td>Raspoloživo</td><td></td>
                        </tr>
                    @foreach($kategorija as $katbroj=>$podaci)
                        <tr>
                            <td class="boldovan">{{$podaci->naziv}}</td>
                            <td>{{$podaci->cena}} din.</td>
                            <td>
                                @if(($podaci->kolicina-$zbirrezervisanih)==0)
                                    <span class="crvenaslova">Nema raspoloživih ulaznica</span>
                                @elseif(($podaci->kolicina-$zbirrezervisanih)<=10)
                                    <span class="crvenaslova">još samo {{$podaci->kolicina-$zbirrezervisanih}} ulaznica</span>
                                @else
                                    {{$podaci->kolicina-$zbirrezervisanih}} ulaznica
                                @endif
                            </td>
                            <td>
                                <input type="hidden" name="katid" value="{{$podaci->id}}" />
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>

                        <tr>
                            @if(strtotime($dogadjaj->max_rez_date)>time())
                                <td colspan="4">Ulaznice se mogu rezervisati najkasnije do: {{$dogadjaj->max_rez_date_dan}} do {{$dogadjaj->max_rez_date_cas}} čas.</td>
                            @else
                                <td colspan="4"><span class="crvenaslova">Rok za rezervaciju ulaznica je istekao! &nbsp; Ulaznice se mogu kupiti direktno na blagajni.</span></td>
                            @endif
                        </tr>
         @endif
            </table>



         @if ($rez)
                    <br /><br />
                @foreach($rezervacija as $r)
                    @if($r->status_rezervacije==1)
                        <table border="0" cellspacing="5" width="578px">
                            <tr>
                                <th colspan="3" align="center">Rezervacija ulaznica: </th>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">Rezervisali ste ulaznice za ovaj događaj.  <a href="/mojerez" target="_self">Pogledajte vaše rezervacije</a></td>
                            </tr>
                        </table>
                    @elseif($r->status_rezervacije==2)
                        <table border="0" cellspacing="5" width="578px">
                            <tr>
                                <th colspan="3" align="center">Rezervacija ulaznica: </th>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">Kupilii ste ulaznice za ovaj događaj.  <a href="/kupljeneulaznice" target="_self">Pogledajte kupljene ulaznice</a></td>
                            </tr>
                        </table>
                    @else

                    @endif
                @endforeach
         @elseif(strtotime($dogadjaj->max_rez_date)<=time())

         @else
                    <br /><br />
             @if($dogadjaj->arhiva!=1)

               <form name="rezforma" method="post" action="{{url('rezervacija/'.$ulaznica->id)}}">
               <table border="0" cellspacing="5" width="578px">
                      <tr>
                           <th colspan="3" align="center">Rezervacija ulaznica: </th>
                       </tr>
                       <tr>
                           <td colspan="3">&nbsp;<input type="hidden" name="ulaznica_id" value="{{$ulaznica->id}}" /> </td>

                       </tr>
                       <tr>
                           <td>Kategorija: </td><td>Količina: </td>
                       </tr>
                           <tr>
                               <td class="boldovan">
                                <select class="select1" name="kategorija">
                                   <option value="" default> </option>
                                   @foreach($kategorija as $katbroj1=>$podaci1)
                                   <option value="{{$podaci1->id}}">{{$podaci1->naziv}}</option>
                                   @endforeach

                                </select>
                                 </td>
                            <td>
                                <select class="select1" name="kolicina">
                                    <option value="" default> </option>
                                    @for($kol1=1;$kol1<=$dogadjaj->max_br_ul;$kol1++)
                                        <option value="{{$kol1}}">{{$kol1}}</option>
                                    @endfor
                                </select>
                               </td>
                            <td>
                                <input type="submit" value="Rezerviši">
                            </td>
                        </tr>
                @if($errors->any())
                    <tr>
                        <td colspan="3">

                    @foreach($errors->all() as $error=>$value)

                                        <ul>
                                <li class="crvenaslova">{{$value}}</li>
                                        </ul>


                    @endforeach
                        </td>
                    </tr>
                @endif


                </table>
            </form>
           @else


           @endif
         @endif
        <br />
            <br /><br />

        </div>

        <div id="komentari">
@if(strtotime($dogadjaj->vreme_odr)<=time() && !$korkom)


                    <span class="komentarislova2">Pošaljite vaš komentar</span>
                    <form action="{{url('/dogadjaj/postavikomentar')}}" name="formakomentar" method="post">

                        <input hidden name="dogid" value="{{$dogadjaj->id}}" /><br />
                        <span class="komentarislova1">Vaš komentar:</span>
                        <textarea name="tekst_komentara" style="width:470px; margin-bottom: 10px" rows="5" onkeyup="textLimit(this, 400);"></textarea>
                        <br/><span class="slovaocena">Vaša ocena:</span>
                        <fieldset>
                            <span class="star-cb-group">
                              <input type="radio" id="ocena-10" name="ocena" value="10" /><label for="ocena-10">10</label>
                              <input type="radio" id="ocena-9" name="ocena" value="9" /><label for="ocena-9">9</label>
                              <input type="radio" id="ocena-8" name="ocena" value="8" /><label for="ocena-8">8</label>
                              <input type="radio" id="ocena-7" name="ocena" value="7" /><label for="ocena-7">7</label>
                              <input type="radio" id="ocena-6" name="ocena" value="6" /><label for="ocena-6">6</label>
                              <input type="radio" id="ocena-5" name="ocena" value="5" /><label for="ocena-5">5</label>
                              <input type="radio" id="ocena-4" name="ocena" value="4" /><label for="ocena-4">4</label>
                              <input type="radio" id="ocena-3" name="ocena" value="3" /><label for="ocena-3">3</label>
                              <input type="radio" id="ocena-2" name="ocena" value="2" /><label for="ocena-2">2</label>
                              <input type="radio" id="ocena-1" name="ocena" value="1"  /><label for="ocena-1">1</label>
                              <input type="radio" id="ocena-0" name="ocena" value="0" checked="checked" class="star-cb-clear" /><label for="ocena-0">0</label>
                            </span>
                        </fieldset>

                        <input type="submit" name="Submit" value="Pošalji komentar" class="inputbutton" />
                        <br /><span class="manjaslova">* Molimo neka vam postovi budu čisti, maksimalno 400 karaktera.</span>
                    </form>

                    <br /><br />
            @endif
                    <span class="komentarislova2">Komentari</span>
                    <br />
                        <div class="comment_box">
                        <ol>
                            <li>
                                <a name="komentar"></a>
                                @if(Session::has('komporuka'))
                                    <span class="mojkomentar">{{Session::get('komporuka')}}</span><br />
                                @endif
                            </li>
                        </ol>
                        <ol>
                                @foreach($svikomentari as $komentar)
                            <li>
                                <div class="comment-head"><img src="/images/no_avatar.gif" alt="{{$komentar->username}}" border="0" width="48" height="48" class="avatar_img" />
                                    <div class="comment-author">{{$komentar->username}} <span class="vremeodr">Vreme događaja:</span></div>

                                    <div class="comment-date">{{$komentar->dan}} u {{$komentar->vreme}} <span class="dogdatum">{{$komentar->vreme_odr_dan}} u {{$komentar->vreme_odr_sat}}</span></div>


                                </div><br />
                                <span class="tekskomentara">{{$komentar->komentar}}</span>
                                {{--samo admin odavde-
                                            <div class="row_actions">
                                                <span id="users-1">
                                                    <span class="ipaddress">IP: {{}}/span>
                                                </span>
                                                <a href="" onclick="" title="Obriši ovaj komentar">Obriši</a>
                                            </div>
                                {samo admin dovde--}}
                                <div class="row_actions">
                                    <br />
                                   <span class="slovaocena"> Ocena: &nbsp;</span>
                                @for($x=1;$x<=$komentar->ocena;$x++)
                                <img src="/starrating/images/star1.png" />
                                @endfor
                                    @for($x=$komentar->ocena;$x<=9;$x++)
                                        <img src="/starrating/images/star2.png" />
                                    @endfor
                                </div>

                                      </li>

                              @endforeach
                     </ol>

                 </div>

             </div>



 </div>


@endsection