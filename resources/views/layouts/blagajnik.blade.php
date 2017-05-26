

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Belgrade Events Admin</title>


    <link href="/css/admin.css" rel="stylesheet">
    <script src="/jquery/1.11.3/jquery.min.js"></script>

</head>


<!-- Header -->
<div id="header">
    <div id="meta"></div>
    <ul id="menu">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/admin') }}">Admin Home</a></li>
    </ul>

</div>
<!-- EndOfHeader -->

<!-- Content -->
<div id="wrapper">

    <!-- Left -->
    <div id="left">
        @if(Auth::check())

        @if(Auth::user()->uloga==1)
            @include('admin.blagajnameni')
        @endif
        @endif




        @yield('left')

    </div>
    <!-- EndOfLeft -->

    <!-- Main -->

@yield('main')

<!-- EndOfMain -->

    <!-- Right -->
    <div id="right">

        @yield('right')
        @include('admin.login')
    </div>
    <!-- EndOfRight -->

</div>
<!-- EndOfContent -->

<!-- Footer -->
<div id="footer">
    <div>
        <a href="{{ url('/admin') }}">Home</a>
    </div>
    <p id="copy">Copyright &copy;. All rights reserved. <a href="#">N.Pivarevic</a>     </p>
</div>
<!-- EndOfFooter -->


</body>

<link rel="stylesheet" type="text/css" href="/jquery/datetimepicker-master/jquery.datetimepicker.css"/>
<script src="/jquery/datetimepicker-master/jquery.js"></script>
<script src="/jquery/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
<script>
    $.datetimepicker.setLocale('sr');
    jQuery('#datetimepicker1').datetimepicker({
        format:'d.m.Y H:i',
        step:5
    });
    jQuery('#datetimepicker2').datetimepicker({
        format:'d.m.Y H:i',
        step:5
    });
</script>

</html>
