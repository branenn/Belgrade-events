<div id="left_navigation">

    <img src="/images/gtop.gif" alt="" width="191" height="8" />
    <div class="title1">Admin Izbornik</div>
    <ul class="contries">


        <li>Registracija</li>
        <li>
            <ul class="contries">
                <li><a href="{{url('/admin/adminhome')}}">Zahtevi za registraciju</a></li>
            </ul>
        </li>
        <li>Korisnici</li>
        <li>
            <ul class="contries">
                <li><a href="{{url('/admin/listakorisnika')}}">Lista korisnika</a></li>
                <li><a href="{{url('/admin/novikorisnik')}}">Dodaj novog korisnika</a></li>
                <li><a href="{{url('/admin/korisnici/top10')}}">Top 10 korisnika</a></li>
                <li><a href="{{url('/admin/korisnici/top10m')}}">Top 10 preth. meseca</a></li>
            </ul>
        </li>
        <li>Dogadjaji
            <ul class="contries">
                <li>
            <a href="{{url('/admin/dogadjaji')}}">Lista dogadjaja</a>
                </li>
            </ul>
        </li>
        <li>Mesta rada</li>
        <li>
            <ul class="contries">
                <li><a href="{{url('/admin/listamesta')}}">Lista mesta rada</a></li>
                <li><a href="{{url('/admin/novomesto')}}">Dodaj novog mesto</a></li>
            </ul>
        </li>

    </ul>

    <img src="/images/gbot.gif" alt="" width="191" height="8" />
</div>