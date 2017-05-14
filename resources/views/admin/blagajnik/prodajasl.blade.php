@extends('layouts.blagajnik')

@section('main')
    <div id="central">
        <h1>Prodaja slobodnih ulaznica</h1>
        <br />
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error=>$value)
                    <li class="crvenaslova"> {{$value}}</li>
                @endforeach
            </ul>
        @endif
        <div class="block">
            <div>
                <form name="slforma" method="post" action="/admin/prodaja/slobodne">
                    <table>
                        <tr>
                            <td colspan="2">
                                <label for="dogadjaj">Pretraga dogadjaja:</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input class="search1" type="text" name="dogadjaj"  id="dogadjaj" value="" size="50" placeholder="Naziv dogadjaja" required />
                            </td>
                        </tr>
                        <tr>
                            <td  colspan="2">
                                <input type="submit" value="Pronađi dogadjaj">&nbsp;<input type="reset" value="Obriši">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="/jquery/autocomplete/jquery-ui.css">
    <script type="text/javascript" src="/jquery/autocomplete/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="/jquery/autocomplete/jquery-ui.js"></script>


    <script type="text/javascript">
        $('#dogadjaj').autocomplete({
            source: '{!! URL::route('autocompleteslob')!!}',
            minLenght:1,
            autoFocus: true,
            select: function (e,ui) {

                /*   $('#nazivdog').val(ui.item.nazivdog);
                $('#prezime').val(ui.item.prezime);
                $('#id').val(ui.item.id);
                */

            }
        });
    </script>
@endsection