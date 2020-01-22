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
                <div class:"tableRespond">
                    <h1 align="center" >WebDev Chellenge</h1>
                    <br>
                    <div align="center" >
                        <button type="button" name="load-data"  id="load-data" class="btn btn-primary">load data</button>
                    </div>
                    <br>
                    <div align="center" id="auctios-table" >

                    </div>
                </div>
        </div>
    </body>
</html>

<script> 
$(document).ready(function(){

    $("#load-data").click(function(){
        console.log("clicked")
        $.ajax({
            url:"data.csv",
            dataType:"text",
            success:function(data){

                var auctioData = data.split(/\r?\n|\r/)
                console.log(auctioData)
            }
        })
    })

});
</script>
