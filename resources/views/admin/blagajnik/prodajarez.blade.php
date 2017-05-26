@extends('layouts.blagajnik')

@section('main')
    <div id="central">

        <h1>Rezervisane ulaznice</h1>
        <br />
        <div class="block">
            <div>

            <form name="rezforma" method="post" action="/admin/prodaja/rezervacije">
                <table>
                    <tr>
                        <td colspan="2">
                    <label for="korisnik">Pretraga rezervacija:</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                    <input class="search1" type="text" name="korisnik"  id="korisnik" value="{{old('naziv')}}" size="50" placeholder="Prezime i ime korisnika" required />
                        </td>
                    </tr>

                    <tr>
                        <td  colspan="2">
                            <input type="hidden" name="id" id="id" size="5" required />
                            <input type="submit" value="Pronađi rezervacije korisnika">&nbsp;<input type="reset" value="Obriši">
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
          $('#korisnik').autocomplete({
            source: '{!! URL::route('autocompleterez')!!}',
            minLenght:1,
            autoFocus: true,
            select: function (e,ui) {

    $('#ime').val(ui.item.ime);
    $('#prezime').val(ui.item.prezime);
    $('#id').val(ui.item.id);


            }
        });







    </script>
@endsection