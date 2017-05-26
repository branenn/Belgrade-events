@extends('layouts.blagajnik')
@section('main')
    <script type="text/javascript">

        $(document).ready(function() {

            var i=0;
            var elementi = '';


           // a=i;
            @if(Session::has("katpolja"))
                    brkat = parseInt("{{Session::get("katpolja")}}");
            //alert(brkat);

            var kategorije = new Array();
            @foreach(old("ime_kategorije") as $keykat=>$vrkat)
                  kategorije.push('<?php echo $vrkat; ?>');
                    @endforeach

            var cene = new Array();
            @foreach(old("cena") as $keycena=>$vrcena)
                  cene.push('<?php echo $vrcena; ?>');
                    @endforeach

            var kolicine = new Array();
            @foreach(old("kolicina") as $keykolicina=>$vrkolicina)
                  kolicine.push('<?php echo $vrkolicina; ?>');
                    @endforeach


            for(i; i<=brkat-1; i++){

                elementi = '<tr class="dodato' + i + '"><td><input type="hidden" id="katpolja" name="katpolja" value="' + (i + 1) + '" /><label for="kategorija' + (i + 2) + '">Kategorija ' + (i + 2) + ':</label><input type="hidden" name="kategorija[' + (i + 2) + ']" value="' + (i + 2) + '"></td>' +
                        '<td><input type="text" class="code" name="ime_kategorije[' + (i + 2) + ']" size="14" value="'+kategorije[(i+1)]+'" placeholder="ime kategorije"/></td>' +
                        '<td><input type="text" class="code" name="cena[' + (i + 2) + ']" size="5" value="'+cene[(i+1)]+'" placeholder="cena"/></td>' +
                        '<td><input type="text" class="code" name="kolicina[' + (i + 2) + ']" size="5" value="'+kolicine[(i+1)]+'" placeholder="količina"/></td></tr>';

                $("#dodatnaPolja").append($(elementi));
            }




            @elseif($kategorija)
                    brkate = parseInt("{{count($kategorija)}}");
                    var id = new Array();
                    var naziv = new Array();
                    var cena1 = new Array();
                    var kol1 = new Array();
                        @for($i=0;$i<=count($kategorija)-1;$i++)
                             id.push('<?php echo $kategorija[$i]->id; ?>');
                            naziv.push('<?php echo $kategorija[$i]->naziv; ?>');
                            cena1.push('<?php echo $kategorija[$i]->cena; ?>');
                            kol1.push('<?php echo $kategorija[$i]->kolicina; ?>');
                        @endfor

            for(i=0; i<=brkate-2; i++) {

                elementi = '<tr class="dodato' + i +'"><td><input type="hidden" id="katid" name="katid[' + (i + 2) + ']" value="'+id[(i+1)]+'" /><label for="kategorija' + (i + 2) + '">Kategorija ' + (i + 2) + ':</label><input type="hidden" name="kategorija[' + (i + 2) + ']" value="' + (i + 2) + '"></td>' +
                        '<td><input type="text" class="code" name="ime_kategorije[' + (i + 2) + ']" size="14" value="'+naziv[(i+1)]+'" placeholder="ime kategorije"/></td>' +
                        '<td><input type="text" class="code" name="cena[' + (i + 2) + ']" size="5" value="'+cena1[(i+1)]+'" placeholder="cena"/></td>' +
                        '<td><input type="text" class="code" name="kolicina[' + (i + 2) + ']" size="5" value="'+kol1[(i+1)]+'" placeholder="količina"/></td></tr>';

                $("#dodatnaPolja").append($(elementi));


            }
            @endif




               $("#dodajPolja").click(function () {

                elementi = '<tr class="dodato' + i + '"><td><input type="hidden" name="katpolja" value="' + (i + 1) + '"/><label for="kategorija' + (i + 2) + '">Kategorija ' + (i + 2) + ':</label><input type="hidden" name="kategorija[' + (i + 2) + ']" value="' + (i + 2) + '"></td>' +
                        '<td><input type="text" class="code" name="ime_kategorije[' + (i + 2) + ']" size="14" value="" placeholder="ime kategorije"/></td>' +
                        '<td><input type="text" class="code" name="cena[' + (i + 2) + ']" size="5" value="" placeholder="cena"/></td>' +
                        '<td><input type="text" class="code" name="kolicina[' + (i + 2) + ']" size="5" value="" placeholder="količina"/></td></tr>';


                if(i==9){
                    alert("Ne možete imati vise od 10 kategorija");
                    return false;
                }
                $("#dodatnaPolja").append($(elementi));
                i ++;

            });


            $("#dodatnaPolja").on('click', '.obrisiPolja', function () {

                if(i==0){
                    alert("Ne možete ukloniti sve kategorije");
                    return false;
                }
                i--;

                $(".dodato" + i).remove();

            });
        });
    </script>


<div id="central">
    <div class="block">
        <div>

            <br>
            <div>

                <u>Izmena događaja id. {{$dogadjaj->id}}</u>

                <br>
                <br>
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error=>$value)
                            <li class="crvenaslova"> {{$value}}</li>
                        @endforeach
                    </ul>
                @endif
                @if(Session::has('poruke'))
                    @foreach(Session::get('poruke') as $poruka)
                        <ul>
                            <li class="crvenaslova">  {{$poruka}}</li>
                        </ul>
                    @endforeach
                @endif

                <form name="formaizmenadog" method="post" action="{{url('/admin/dogadjaj/'.$dogadjaj->id)}}" enctype="multipart/form-data">
                    <table border="0" cellspacing="10" cellpadding="10">


                        <tr><td><label for="naziv">Naziv dogadjaja:</label></td><td><input type="text" name="naziv" id="naziv" value="{{$dogadjaj->naziv}}" size="50" /> </td></tr>
                        <tr><td><label for="mesta">Mesto održavanja:</label></td> <td>
                          {{--  <select name="mesta">
                                <option value="{{$mesto->id}}" selected>{{$mesto->naziv}}</option>
                                @foreach($svamesta as $posebno)
                                <option value="{{$posebno->id}}">{{$posebno->naziv}}</option>
                                    @endforeach
                            </select>
                            --}}
                                <input type="hidden" name="mesta" value="{{$mesto->id}}">
                                {{$mesto->naziv}}
                           </td></tr>
                        <tr><td>Vreme održavanja:</td>
                            <input type="hidden" name="danas" value="{{Carbon\Carbon::now()}}" />
                            <td><label for="vreme_odrzavanja">Od:</label><input type="text" name="vreme_odrzavanja" id="datetimepicker1" value="{{$dogadjaj->vreme_odr}}" /><span class="malaslova"> (dd.mm.yyyy.)</span>
                            </td></tr>
                       <tr><td><label for="slike">Slika:</label></td><td><img src="/uploads/dogslike/male/{{$dogadjaj->malaslika}}" alt="{{$dogadjaj->malaslika}}" />
                                <input type="file" name="slike" accept="image/*" /></td></tr>
                       <tr><td><label for="opis_sazetak">Opis(sažetak):</label></td>
                            <td>
                         <textarea name="opis_sazetak" rows="4" cols="40">{{$dogadjaj->opis_s}}</textarea>
                            </td>
                        </tr>
                        <tr><td><label for="opis_detalji">Opis(detalji):</label></td>
                            <td>
                         <textarea name="opis_detalji" rows="10" cols="40">{{$dogadjaj->opis_p}}</textarea>
                                <input type="hidden" name="arhiva" value="0">
                            </td>
                        </tr>
                        <tr><td colspan="2">Ulaznice</td></tr>


                            <tr>
                                <td colspan="2">


                                    <table border="0" cellspacing="0" cellpadding="0" style="width: 100%; line-height:10px;  margin-top:-10px; margin-left: -10px; border-spacing: 10px 10px;" id="dodatnaPolja">

                                        <tr>
                                            <td></td>
                                            <td>Naziv kategorije</td>
                                            <td>Cena</td>
                                            <td>Količina</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="kategorija1">Kategorija&nbsp;1:</label>
                                                <input type="hidden" name="katid[1]" value="{{$kategorija[0]->id}}" />
                                                <input type="hidden" name="kategorija[1]" value="1">
                                            </td>
                                            <td>
                                                <input type="text" class="code" name="ime_kategorije[1]" size="14" value="{{$kategorija[0]->naziv}}" placeholder="ime kategorije"/>
                                            </td>
                                            <td>
                                                <input type="text" class="code" name="cena[1]" size="5" value="{{$kategorija[0]->cena}}" placeholder="cena"/>
                                            </td>
                                            <td>
                                                <input type="text" class="code" name="kolicina[1]" size="5" value="{{$kategorija[0]->kolicina}}" placeholder="količina"/>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" id="dodajPolja"><img src="/images/add-icon.png" /></a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="obrisiPolja"><img src="/images/remove-icon.png" /></a>
                                            </td>

                                        </tr>
                                    </table>




                                </td>
                            </tr>


                        <tr><td><label for="max_ulaznica">Max ulaznica po 1 korisniku:</label></td><td> <input type="text" name="max_ulaznica" value="{{$dogadjaj->max_br_ul}}" size="5" required></td></tr>
                        <tr><td><label for="poslednji_rok_rezervisanja">Poslednji dan rezervisanja:</label></td><td><input type="date" name="poslednji_rok_rezervisanja" id="datetimepicker2" value="{{$dogadjaj->max_rez_date}}" /><span class="malaslova"> (dd.mm.yyyy.)</span></td></tr>
                        <tr> <td colspan="2" align="center"><br>
                                <input type="submit" value="Izmeni">&nbsp;<input type="button" value="Odustani" onclick="parent:location='{{url('/admin/listadogadjaja')}}'"></td>
                        </tr>

                    </table>
                </form>
                <p></p>

            </div>

        </div>
    </div>

</div>

<link rel="stylesheet" href="/jquery/autocomplete/jquery-ui.css">
<script type="text/javascript" src="/jquery/autocomplete/jquery-1.10.2.js"></script>
<script type="text/javascript" src="/jquery/autocomplete/jquery-ui.js"></script>

<script type="text/javascript">
    $('#naziv').autocomplete({
        source: '{!! URL::route('autocomplete')!!}',
        minLenght:1,
        autoFocus: true,
        select: function (e,ui) {

        }
    });


</script>
@endsection