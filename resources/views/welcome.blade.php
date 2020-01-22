<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Styles -->
        <style>
             
        </style>
    </head>
    <body>
        <div class:"container" >
          
            <h1 >WebDev Chellenge</h1>
            <br>
            <div class:"uploadForm" >

                <form action="{{url('/store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        <br>
                        <button type="submit" class="btn btn-primary">Import</button>
                   
                </form>
            </div>
            <br>
            <div align="center" id="auctios-table" >

            </div>
                
        </div>
    </body>
</html>


