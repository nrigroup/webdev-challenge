<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NRI Group</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="{{ asset('css/custom.css')}}" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Styles -->


    </head>
    <body>
        <div>


            <div class="content">
                <div class="title m-b-md">
                    <a href="/">NRI Group</a>
                    <hr>
                    <a href="{{ route('index.upload')}}" class="btn btn-success text-center">Upload</a>
                    <a href="{{ route('index.stats')}}" class="btn btn-info text-center">Stats</a>
                </div>
            </div>

            @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h4 class="heading">Upload The CSV File</h4>

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form action="/upload" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="file" name="file" class="form-control">

                            <input type="submit" value="Submit" class="btn btn-success btn-block submit">

                        </form>
                    </div>
                </div>
        </div>
    </body>
</html>
