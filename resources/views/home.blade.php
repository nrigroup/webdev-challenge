<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NRI</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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

            .m-b-md {
                margin-bottom: 30px;
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
            .logo-img{
                position: relative;
            }
        </style>
    </head>
    <body>
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
                    NRI Group
                </div>
                <h3 align="center">Laravel - Import Data in CSV File</h3>
                <br>
                 <div class="btn btn-primary">
                    <form action="/result" method="post" enctype="multipart/form-data">
                        Select CSV file to upload:
                        
                        <input class="btn btn-info" type="file" name="fileToUpload" id="fileToUpload">
                        <br>
                        <input class="btn btn-success" type="submit" value="Upload&Calculator " name="submit">
                    </form>
                </div>
                <br><br>
                <a class="btn btn-warning" href="/state">Check Current Table</a>
                <br><br>


            </div>
        </div>
    </body>
    <!-- Footer -->
    <footer class="page-footer font-small">

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2020 Copyright:Evan Xia
      </div>
      <!-- Copyright -->

    </footer>
    <!-- Footer -->
</html>
