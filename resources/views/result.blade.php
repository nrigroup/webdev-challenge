<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Result</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <style>
        body {
            background-color: #ccc;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        footer {
            background-color: #777;
            padding: 10px;
            text-align: center;
            color: white;
        }
        header {
            background-color: #666;
            padding: 40px;
            text-align: center;
            font-size: 35px;
            color: white;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .logo-img{
            position: relative;
        }
        .m-b-md {
            margin-bottom: 25px;
        }
        table, td, th {
          text-align: center;height: 40px;
        }

        th {
          height: 60px;
        }
        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: #666;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
        }

        #myBtn:hover {
            background-color: #555;
        }
    </style>
</head>
    <body>
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        <header>
            <div class="logo-img">
                <a href="">
                    <img src="https://www.nriparts.com/assets/images/logo.png" alt="NRI Logo" class="img-responsive">
                </a>
            </div>
        </header>

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

            <div class="content">
                <div class="title m-b-md">
                    Current Status
                </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Time-Category</th>
                            <th>Total amount</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($result as $item)
                          <tr>
                            <td>{{$item['time']}} - {{$item['category']}}</td>
                            <td>{{$item['total']}}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>

                <div class="links">
                    <a class="btn btn-default" href="/">Back</a>
                    <br><br>
                </div>
            </div>
        </div>
    <script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
    </script>
    </body>
</html>
