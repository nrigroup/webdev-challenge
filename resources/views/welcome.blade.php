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
        .container{
            margin:5%
        }
       
             
        </style>
    </head>
    <body>
        <div class="container" >
          
            <h1 >WebDev Chellenge</h1>
            <br>
            <div class="uploadForm" >

                <form action="{{url('/import')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                    <input type="file" name="upload_file" class="form-control-file" id="exampleFormControlFile1">
                    <br>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
            <br>

            @if(empty($error))
            <div >
               
                <button type="button" onclick="window.location='{{url('/perMonth')}}'" class="btn btn-primary">Per Month</button>
                <div>
                @if(empty($totalPerMonth))
                    <p></p>
                @else
                    <table class="table">
                        <tr>
                            <th>month</th>
                            <th>total</th>   
                        <tr>
                        @foreach($totalPerMonth as $row)
                        <tr>
                            <td>{{$row -> month}}</td>
                            <td>{{$row -> total}}</td>   
                        <tr>
                        @endforeach
                    </table>
                @endif 
                </div>

                <button type="button" onclick="window.location='{{url('/perCategory')}}'" class="btn btn-primary">Per ategory</button>
                <div>
                @if(empty($totalPerCategory))
                    <p></p>
                @else
                    <table class="table">
                        <tr>
                            <th>category</th>
                            <th>total</th>   
                        <tr>
                        @foreach($totalPerCategory as $row)
                        <tr>
                            <td>{{$row -> category}}</td>
                            <td>{{$row -> total}}</td>   
                        <tr>
                        @endforeach
                </table>
                @endif 
                </div>
            @else
                <p>{{$error}}</p>

            @endif 
            </div>
                
        </div>
    </body>
</html>


