<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css')  }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-fixed-top navbar-light bg-light main-nav">
    <div class="container">
        <ul class="nav navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">
                    <img src="https://www.nrisolutions.com/img/logo.png" alt="Nri Solutions"></a>
            </li>
        </ul>
    </div>
</nav>
@yield('content')
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
