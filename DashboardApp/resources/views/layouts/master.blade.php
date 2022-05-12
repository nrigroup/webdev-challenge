<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="{{ asset('js/main.js');}}"></script>
    <link rel="stylesheet" href="{{ asset('css/main.css');}}">
    <title>@yield('title')</title>
</head>
<body>
    <div class="header">
        <p class="header_title">
            <a href="/">Dashboard</a>
        </p>
        <div class="links">
            <a href="/">Home</a>
            <a href="/dataview">Dataview</a>
            <a href="/upload">Upload File</a>
        </div>
    </div>
    @yield('content')
</body>
