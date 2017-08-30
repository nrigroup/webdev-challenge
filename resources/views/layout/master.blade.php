<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NRI Inventory Upload</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://bootswatch.com/paper/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        
    </head>
    <body>
        @include('partials.nav')
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>