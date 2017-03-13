<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://unpkg.com/vue"></script>
</head>
<body>
<div class="container">
    <div class="row text-center" style="background-color: rgba(211, 211, 211, 0.34);">
        <img src="http://www.nriglobalinc.com/css/images/logo.png" style="margin: 3%;">
    </div>
    
    <div class="row text-center w3-animate-top">
        <span class="btn btn-warning" style="margin: 2%;"><input type="file" id="hook" form="deez" name="ex"/></span>
    </div>
    
    <div class="container hidden w3-animate-bottom" id="doro">
        <table class="table table-striped">
            <caption>Sales Data Report</caption>
            <thead> 
                <tr> 
                    <th>Date</th> 
                    <th>Category</th> 
                    <th>($) Total Amount</th> 
                </tr> 
            </thead>
            <tbody>
               <tr v-for="todo in todos">
                    <td>{{todo.time}}</td>
                    <td>{{todo.category}}</td>
                    <td>{{todo.total_sales}}</td>
                </tr>
            
            </tbody>
            
        </table>
    </div>
    
    
    <form action="/my" method="post" id="deez" enctype="multipart/form-data" hidden>
        <input type="text" class="form-control" name="lo"/>
        <br>
        <input type="text" class="form-control" name="al"/>
        <br>
        <input type="file" name="boobs"/><br>
        <!-- Without CSRF token POST http request will painfully fail-->
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
        <br>
        <input type="submit" class="btn btn-primary" name="submit"/>
    </form>
</div>
<script>
    
function vue_start(e){
    //Initializes Vue JS to display final json data from server
    //Unhide the table after data is retrieved
    new Vue({
      el: '#doro',
      data: {
        todos: e
      }
    });
    
    table_display();
}

function is_csv(b){
    // Only CSV files will be allowed to be uploaded by the user
    if (!(b.indexOf(".csv") > -1)){
        alert("Feed me CSV file only dickhead");
        
    } else{
        //post request to server
        confirm(); 
        $.ajax({
              url: '/my',
              type: 'POST',
              data: new FormData($("#deez")[0]),
              processData: false,
              contentType: false,
              dataType: 'json',
              success: function(result){vue_start(result);}
        });
      }
}

function table_display(){
    //Visually show the table
    $("#doro").addClass("show");
    $("#doro").removeClass("hidden");
}

function confirm(){
    //Visually confirm it is a CSV file
    $("#hook").parent().addClass("btn-success");
    $("#hook").parent().removeClass("btn-warning");
}

$(document).ready(function(){
    //Fire Ajax request on change event to the file upload input
    $("#hook").change(function(){
        is_csv($(this).val());

    });
});
</script>
</body>
</html>