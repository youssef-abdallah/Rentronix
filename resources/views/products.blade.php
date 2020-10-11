
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>products</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar is-primary" role="navigation" aria-label="main navigation" style="background-color: darkgrey">
        <div class="navbar-brand">
            <span class="navbar-item"  >
                {{--                <img src="../images/rentronx.png" width="50" height="50">--}}
                Rentronix
            </span>

            <div class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>


            </div>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="http://127.0.0.1:8000/">
                   <strong>Home</strong>
                </a>
                <a class="navbar-item">
                    <strong> Documentation </strong>
                </a>

                <cart-dropdown></cart-dropdown>
            </div>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-primary"  href="http://127.0.0.1:8000/register"style="background-color: orangered" >
                        <strong>Register</strong>
                    </a>
                    <a class="button is-light" href="http://127.0.0.1:8000/login">
                       <strong> Log in </strong>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="section content">
        <h1>Our Products</h1>
        <products-list></products-list>
    </div>

</div>

<script src="{{ asset('js/app.js') }}">

</script >

</body>
</html>
