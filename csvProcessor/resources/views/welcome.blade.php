<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>View Item Details</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row d-flex justify-content-between">
                <div class="col"><h2 class="">Item Details</h2></div>
                <div class="col-2 text-right"><a class="btn btn-primary" role="button" href="/import">Import CSV</a></div>
            </div>
            @if($data)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">date</th>
                    <th scope="col">category</th>
                    <th scope="col">lot title</th>
                    <th scope="col">lot location</th>
                    <th scope="col">lot condition</th>
                    <th scope="col">pre-tax amount</th>
                    <th scope="col">name</th>
                    <th scope="col">tax amount</th>
                </tr>
                </thead>
                <tbody>
                    @if(sizeof($data) > 0)
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $row->{'date'} }}</td>
                            <td>{{ $row->{'category'} }}</td>
                            <td>{{ $row->{'lot title'} }}</td>
                            <td>{{ $row->{'lot location'} }}</td>
                            <td>{{ $row->{'lot condition'} }}</td>
                            <td>{{ $row->{'pre-tax amount'} }}</td>
                            <td>{{ $row->{'name'} }}</td>
                            <td>{{ $row->{'tax amount'} }}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="8">No data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            @endif
        </div>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
