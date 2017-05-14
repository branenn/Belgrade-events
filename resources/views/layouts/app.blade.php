

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Belgrade Events</title>

    <script src="/jquery/1.11.3/jquery.min.js"></script>
    <link href="/css/style.css" rel="stylesheet">

</head>


<!-- Header -->
<div id="header">
    <div id="meta"></div>
	<ul id="menu">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/pretraga') }}">Pretraga</a></li>
        @if(Auth::check())
            @if(Auth::user()->uloga==1 || Auth::user()->uloga==2)
                <li><a href="{{ url('/admin') }}">Admin Panel</a></li>
            @endif
    </ul>
    <ul id="forum">
        <li><a href="{{ url('/mojerez') }}">Moje rezervacije</a></li>
    </ul>
        @endif
    <noscript><h4 style="text-align: left"><span class="crvenaslova">Da bi mogli da koristite sve funkcije sajta<br /> neophodno je da javascript u vašem browseru bude uključen</span></h4><br /></noscript>
</div>
<!-- EndOfHeader -->

<!-- Content -->
<div id="wrapper">
            
    <!-- Left -->
    <div id="left">
        @include('auth/login')
                
        @yield('left')
                                                                                          
    </div>
    <!-- EndOfLeft -->
            
    <!-- Main -->

    @yield('main')

    <!-- EndOfMain -->
            
    <!-- Right -->
    <div id="right">
        
    @yield('right')

    </div>
    <!-- EndOfRight -->
            
</div>
<!-- EndOfContent -->
        
<!-- Footer -->
<div id="footer">
    <div>
	<a href="{{ url('/') }}">Home</a>
    <a href="{{ url('/pretraga') }}">Pretraga</a>
        @if(Auth::check())

            @if(Auth::user()->uloga==1 || Auth::user()->uloga==2)
                <a href="{{ url('/admin') }}">Admin Panel</a>
            @endif
                <a href="{{ url('/mojerez') }}">Moje rezervacije</a>
        @endif
    </div>
	<p id="copy">Copyright &copy;. All rights reserved. <a href="#">N.Pivarevic</a>     </p>
</div>
<!-- EndOfFooter -->

</body>
</html>
