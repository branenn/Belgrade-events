@extends('layouts.app')

@section('main')
    <div id="big">
        @yield('main')
        <div>
            <h1>Pretraga</h1>
            <br />

            <br>
           <div class="block">
               <div>

                       <table>
                          <tr>
                               <td>
                                   <label for="dogadjaj">Pretraga dogadjaja:</label>
                               </td>
                              <td>
                                  <label for="dogadjaj">Kriterijum:</label>
                              </td>
                           </tr>
                           <tr>
                               <td>
                                   @if($izbor == 4)
                                       <input class="search1" type="text" name="dogadjaj"  id="dogadjaj" value="" size="20" placeholder="dd.mm.yyyy" required />
                                   @elseif($izbor == 3)
                                       <input class="search1" type="text" name="dogadjaj"  id="dogadjaj" value="" size="20" placeholder="dd.mm.yyyy" required />
                                   @elseif($izbor == 2)
                                        <input class="search1" type="text" name="dogadjaj"  id="dogadjaj" value="" size="50" placeholder="Mesto održavanja" required />
                                    @else
                                        <input class="search1" type="text" name="dogadjaj"  id="dogadjaj" value="" size="50" placeholder="Naziv dogadjaja" required />
                                    @endif
                               </td>
                               <td>
                                   <form name="izbor" action="{{url('/pretraga')}}" method="get">
                                       <select name="izbor" onchange="submit()">
                                           <option value="1" @if($izbor == '1') {{'selected="selected"'}} @endif >Po nazivu</option>
                                           <option value="2" @if($izbor == '2') {{'selected="selected"'}} @endif>Po mestu održavanja</option>
                                           <option value="3" @if($izbor == '3') {{'selected="selected"'}} @endif>Vremenu od</option>
                                           <option value="4" @if($izbor == '4') {{'selected="selected"'}} @endif>Vremenu do</option>

                                       </select>
                                   </form>


                               </td>
                           </tr>

                            <tr>
                                <td  colspan="2">


                                    &nbsp;
                                </td>
                            </tr>
                        </table>

                </div>

               <div class="rezultat"></div>

            </div>
       </div>

    </div>





    <script type="text/javascript" src="/jquery/pretraga/jquery-1.6.3.min.js"></script>
    <script type="text/javascript" src="/jquery/pretraga/jquery-ui.js"></script>

@if($izbor==4)
    <script type="text/javascript">

        function myRenderFunc(ul,item) {
            return $("<div class=\"block1\"></div>")
                    .data("item.autocomplete", item)
                    .append("<p></p><br />")
                    .append("<img src=\"/uploads/dogslike/male/" + item.slika + "\" alt=\"\" width=\"180\" height=\"126\" >")
                    .append("<div><h4>Naziv: " + item.value + "</h4><br><h5>Mesto odrzavanja: " + item.mesto + "</h5><h5>Vreme odrzavanja: " + item.dan + " u " + item.sat + "</h5>")
                    .append("<br><br><br><br><br>&nbsp;<a href=\"dogadjaj/" + item.id + "\" class=\"more\">Detaljnije</a><br />&nbsp;</div>")
                    .appendTo($(".rezultat"));
        }




        $("#dogadjaj").autocomplete({
            search: function(event, ui) {
                $('.rezultat').empty();

            },
            source: '{!! URL::route('autocompletepretragavremedo')!!}'
        })


        $('#dogadjaj').data( "autocomplete" )._renderItem = myRenderFunc;


    </script>
@elseif($izbor==3)
    <script type="text/javascript">

        function myRenderFunc(ul,item) {
            return $("<div class=\"block1\"></div>")
                    .data("item.autocomplete", item)
                    .append("<p></p><br />")
                    .append("<img src=\"/uploads/dogslike/male/" + item.slika + "\" alt=\"\" width=\"180\" height=\"126\" >")
                    .append("<div><h4>Naziv: " + item.value + "</h4><br><h5>Mesto odrzavanja: " + item.mesto + "</h5><h5>Vreme odrzavanja: " + item.dan + " u " + item.sat + "</h5>")
                    .append("<br><br><br><br><br>&nbsp;<a href=\"dogadjaj/" + item.id + "\" class=\"more\">Detaljnije</a><br />&nbsp;</div>")
                    .appendTo($(".rezultat"));
        }




        $("#dogadjaj").autocomplete({

            search: function(event, ui) {
                $('.rezultat').empty();

            },
            source: '{!! URL::route('autocompletepretragavremeod')!!}'
        })


        $('#dogadjaj').data( "autocomplete" )._renderItem = myRenderFunc;


    </script>
@elseif($izbor==2)
    <script type="text/javascript">

        function myRenderFunc(ul,item) {
            return $("<div class=\"block1\"></div>")
                    .data("item.autocomplete", item)
                    .append("<p></p><br />")
                    .append("<img src=\"/uploads/dogslike/male/" + item.slika + "\" alt=\"\" width=\"180\" height=\"126\" >")
                    .append("<div><h4>Naziv: " + item.value + "</h4><br><h5>Mesto odrzavanja: " + item.mesto + "</h5><h5>Vreme odrzavanja: " + item.dan + " u " + item.sat + "</h5>")
                    .append("<br><br><br><br><br>&nbsp;<a href=\"dogadjaj/" + item.id + "\" class=\"more\">Detaljnije</a><br />&nbsp;</div>")
                    .appendTo($(".rezultat"));
        }




        $("#dogadjaj").autocomplete({

            search: function(event, ui) {
                $('.rezultat').empty();

            },
            source: '{!! URL::route('autocompletepretragamesto')!!}'
        })


        $('#dogadjaj').data( "autocomplete" )._renderItem = myRenderFunc;


    </script>
@else

  <script type="text/javascript">

        function myRenderFunc(ul,item) {
            return $("<div class=\"block1\"></div>")
                    .data("item.autocomplete", item)
                    .append("<p></p><br />")
                    .append("<img src=\"/uploads/dogslike/male/" + item.slika + "\" alt=\"\" width=\"180\" height=\"126\" >")
                    .append("<div><h4>Naziv: " + item.value + "</h4><br><h5>Mesto odrzavanja: " + item.mesto + "</h5><h5>Vreme odrzavanja: " + item.dan + " u " + item.sat + "</h5>")
                    .append("<br><br><br><br><br>&nbsp;<a href=\"dogadjaj/" + item.id + "\" class=\"more\">Detaljnije</a><br />&nbsp;</div>")
                    .appendTo($(".rezultat"));
        }




        $("#dogadjaj").autocomplete({

            search: function(event, ui) {
                $('.rezultat').empty();

            },
            source: '{!! URL::route('autocompletepretraga')!!}'
        })


        $('#dogadjaj').data( "autocomplete" )._renderItem = myRenderFunc;


            </script>
@endif
@endsection

