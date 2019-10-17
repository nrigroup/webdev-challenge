<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Import CSV</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
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
    <span class="fixed-top m-5" ><a class="fas fa-2x fa-backward" role="button" href="/"></a></span>
    <div class="row d-flex justify-content-between">
        <div class="col"><h2 class="">Import CSV</h2></div>
    </div>
    <form action="/import" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row mt-5">
            <div class="col-11">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="csvFile" name="csvFile" onchange="chooseFile()">
                    <label class="custom-file-label" for="csvFile">Choose file</label>
                    @if ($errors->has('csvFile'))
                        <strong>{{ $errors->first('csvFile') }}</strong>
                    @endif
                    <script>
                        function chooseFile(){
                            const csvFileElement = $('#csvFile');
                            const dir = csvFileElement.val().split("\\");
                            const fileName = dir[dir.length - 1];
                            csvFileElement.next('.custom-file-label').html(fileName);
                        }
                    </script>
                </div>
            </div>
            <div class="col-1">
                <button class="btn btn-primary" type="submit" name="submit" value="submit">Upload</button>
            </div>
            @isset ($monthTotal)
                <div class="container pt-5">
                    <div class="h3">
                        Summary(Monthly)
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Jan.</th>
                            <th>Feb.</th>
                            <th>Mar.</th>
                            <th>Apr.</th>
                            <th>May.</th>
                            <th>Jun.</th>
                            <th>Jul.</th>
                            <th>Aug.</th>
                            <th>Sep.</th>
                            <th>Oct.</th>
                            <th>Nov.</th>
                            <th>Dec.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($monthTotal as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endisset

            @isset ($categoryTotal)
                <div class="container pt-5">
                    <div class="h3">
                        Summary(Category)
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            @foreach($categoryTotal as $key => $value)
                                <th>{{ $key }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($categoryTotal as $value)
                                <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endisset
        </div>
    </form>
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
