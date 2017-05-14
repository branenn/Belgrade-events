@extends('layouts.app')

@section('main')
    <div id="big">
        @yield('main')

        <div id="search1">
            <img src="/images/title61.gif" alt="" width="85" height="22" /><br />
            <form name="forma_pretraga" method="post" action="rezultati.html">
                <table border="0">
                    <tr>
                        <td>
                            <p>
                                <label for="naziv" class="style1">Naziv dogadjaja:</label>
                                <input type="text" class="select4" name="naziv" />
                            </p>
                        <td>
                    </tr>
                    <tr>
                        <td>
                            <p class="style1">
                                <label for="mesto" class="style1">Mesto odrzavanja:</label>
                                <select class="select5" name="mesto" />
                                <option>--Sva mesta--</option>
                                <option value="">Arena</option>
                                <option value="">Sava Centar</option>
                                </select>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br />Vreme odrzavanja
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <label for="datum1" class="pad">Od:</label>
                                <label for="datum2" class="pad">Do:</label>
                            </p>
                        <td>
                    </tr>
                    <tr>
                        <td>
                            <p class="pad2">
                                <input type="date" class="datum1" name="datum1" value="" />
                                <input type="date" class="datum2" name="datum2" value="" />
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="pad4">
                                <!--input type="hidden" name="pretraga" value="rezultati"-->
                            <span>
                            <input class="button" type="image" name="submit" src="/images/button1.gif" alt="Pretraga" >
                            </span>
                            </p>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection

