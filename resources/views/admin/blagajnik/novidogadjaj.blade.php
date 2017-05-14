@extends('layouts.blagajnik')
@section('main')



     <script type="text/javascript">

         $(document).ready(function() {

         var i=0;
         var elementi = '';

         @if(Session::has("katpolja"))
                 brkat = parseInt("{{Session::get("katpolja")}}");

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


         for(i=0; i<=brkat-1; i++){

             elementi = '<tr class="dodato' + i + '"><td><input type="hidden" id="katpolja" name="katpolja" value="' + (i + 1) + '" /><label for="kategorija' + (i + 2) + '">Kategorija ' + (i + 2) + ':</label><input type="hidden" name="kategorija[' + (i + 2) + ']" value="' + (i + 2) + '"></td>' +
                     '<td><input type="text" class="code" name="ime_kategorije[' + (i + 2) + ']" size="14" value="'+kategorije[(i+1)]+'" placeholder="ime kategorije"/></td>' +
                     '<td><input type="text" class="code" name="cena[' + (i + 2) + ']" size="5" value="'+cene[(i+1)]+'" placeholder="cena"/></td>' +
                     '<td><input type="text" class="code" name="kolicina[' + (i + 2) + ']" size="5" value="'+kolicine[(i+1)]+'" placeholder="količina"/></td></tr>';

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
             <h1>Novi događaj</h1>
             <br>
             <br>
             @if($errors->any())
                 <ul>
                     @foreach($errors->all() as $error=>$value)
                       <li class="crvenaslova"> {{$value}}</li>
                     @endforeach
                 </ul>
             @endif
             @if(Session::has('messagedog'))
                 <ul>
                <li class="crvenaslova"> {{Session::get('messagedog')}}</li>
                 </ul>
             @endif


             <form name="formanovidog" method="POST" action="{{url('admin/novidogadjaj')}}" enctype="multipart/form-data">
                 <table border="0" width="100%" cellspacing="10" cellpadding="10">
                  <tr><td><label for="naziv">Naziv događaja:</label> </td><td><input type="text" name="naziv"  id="naziv" value="{{old('naziv')}}" size="40" required /> </td></tr>
                     <tr><td><label for="mesto_id">Mesto održavanja:</label></td>
                         <td>
                            {{-- <select name="mesto_id">
                                 @foreach(App\Mesto::all() as $mesto_odr)
                                 <option value="{{$mesto_odr->id}}">{{$mesto_odr->naziv}}</option>
                                 @endforeach
                             </select>--}}
                             {{$mestorada->naziv}}
                             <input type="hidden" name="mesto_id" value="{{$mestorada->id}}" />
                         </td>
                     </tr>
                     <tr>
                         <td><label for="vreme_odrzavanja">Vreme održavanja:</label> </td>
                         <td> <input type="hidden" name="danas" value="{{Carbon\Carbon::now()}}" />
                              <input type="text" name="vreme_odrzavanja" value="{{old('vreme_odrzavanja')}}" id="datetimepicker1"><span class="malaslova"> (dd.mm.yyyy hh:mm)</span>
                         </td>
                     </tr>
                     <tr><td><label for="slike">Slika:</label></td><td><input type="file" name="slike" value="{{old('slike')}}" accept="image/*" required /></td></tr>
                     <tr><td><label for="opis_sazetak">Opis(sažetak):</label></td>
                         <td>
                      <textarea  name="opis_sazetak" rows="4" cols="40" required>{{old('opis_sazetak')}}</textarea>
                         </td>
                     </tr>
                     <tr><td><label for="opis_detalji">Opis(detalji):</label></td>
                         <td>
                      <textarea name="opis_detalji" rows="10" cols="40" required>{{old('opis_detalji')}}</textarea>
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
                                        <label for="kategorija1">Kategorija&nbsp;1:</label><input type="hidden" name="kategorija[1]" value="1">
                                    </td>
                                    <td>
                                        <input type="text" class="code" name="ime_kategorije[1]" size="14" value="{{old('ime_kategorije.1')}}" placeholder="ime kategorije"/>
                                    </td>
                                    <td>
                                        <input type="text" class="code" name="cena[1]" size="5" value="{{old('cena.1')}}" placeholder="cena"/>
                                    </td>
                                    <td>
                                        <input type="text" class="code" name="kolicina[1]" size="5" value="{{old('kolicina.1')}}" placeholder="količina"/>
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
                     <tr><td><label for="max_ulaznica">Max ulaznica po 1 korisniku:</label></td><td> <input type="text" name="max_ulaznica" value="{{old('max_ulaznica')}}" size="5" required></td></tr>
                     <tr><td><label for="poslednji_rok_rezervisanja">Poslednji rok rezervisanja:</label></td><td><input type="text" name="poslednji_rok_rezervisanja" value="{{old('poslednji_rok_rezervisanja')}}" id="datetimepicker2"><span class="malaslova"> (dd.mm.yyyy hh:mm)</span> </td></tr>
                     <tr> <td colspan="2" align="center"><br>
                             <input type="submit" value="Dodaj događaj">&nbsp; <input type="button" value="Odustani" onclick="parent:location='{{url('/admin')}}'"></td>
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


