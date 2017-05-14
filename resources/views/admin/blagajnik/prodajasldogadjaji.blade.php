@extends('layouts.blagajnik')

@section('main')
    <div id="central">
        <h1>Prodaja ulaznica</h1>
        <br />
        <div class="block">
          @foreach($dogadjaj as $dog)
                <img src="/uploads/dogslike/male/{{$dog->malaslika}}" alt="" width="180" height="126" />
                <div>
                    <h4>Naziv: {{$dog->naziv}} </h4>
                    <br><h5>Mesto odrzavanja: {{$dog->mesto}} </h5>
                    <h5>Vreme odrzavanja: {{$dog->datum_odr}} u {{$dog->vreme_odr}} čas.</h5>
                    <br />
                    <br />
                    <table>
                        <tr>
                            <td colspan="3"><h4>Cene ulaznica</h4></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td class="zatd">
                             Ime kategorije:
                            </td>
                            <td class="zatd">
                            Cena ulaznice:
                            </td>
                            <td class="zatd">
                            Raspoloživo:
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                &nbsp;
                            </td>
                        </tr>
                        @foreach($dog->kategorije as $kat)
                        <tr>
                            <td class="zatd">
                            {{$kat->naziv}}
                            </td>
                            <td class="zatd">
                                {{$kat->cena}}
                            </td>
                            <td class="zatd">
                            {{$kat->raspolozivo}}
                            </td>
                        </tr>
                       @endforeach
                    </table>
                    <br />&nbsp;
                    <input type="button" value="Ulaznice" onclick="location.href='{{url('/admin/prodaja/slobodne/'.$dog->id)}}'">&nbsp;
                    <p></p>
                    <br />&nbsp;
                </div>
         @endforeach
<br>
        </div>
    </div>
@endsection