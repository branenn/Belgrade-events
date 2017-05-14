<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Belgrade Events Admin</title>


    <link href="/css/admin.css" rel="stylesheet">
</head>
<body>
<div id="header">
    <div id="meta">

    </div>



</div>
<center>
    <div class="login_block">
        <p class="login_title2">Admin Login</p>
        <div class="item">
            <p>


            <form name="forma" action="{{ url('/login') }}" method="post">
                <table border="0">
                    <tr>
                        <td><label for="username">Korisničko ime:</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" size="20" name="username"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Lozinka:</label></td>
                    </tr>
                    <tr>
                        <td><input type="password" size="20" name="password"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Login"></td>
                    </tr>
                    @if (($errors->has('username')) || ($errors->has('email')) || ($errors->has('password')))
                        <tr>
                            <td><font color="red">Netačan unos podataka !</font></td>
                        </tr>
                        <br />
                    @endif
                </table>
            </form>

        </div>
        <img src="/images/right_bot.gif" alt="" width="261" height="21" /><br />
    </div>

</center>

<div id="footer">
    <div>
    </div>
    <p id="copy">Copyright &copy;. All rights reserved. <a href="#" target="_blank"> N.Pivarevic 2016</a> </p>
</div>
</body>
</html>
