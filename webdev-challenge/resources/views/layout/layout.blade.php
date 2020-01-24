<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @include('layout.head')

        <title>@yield('title')</title>
    </head>
    <body class="sb-nav-fixed">
        {{--Top navigation bar        --}}
        @include('components.headNav')

        <div id="layoutSidenav">
        {{--Content--}}
            {{--Left Side navigation bar --}}
            @include('components.sideNav')
        {{--Right content--}}

            @include('components.resultTable');

        </div>


    </body>
</html>
