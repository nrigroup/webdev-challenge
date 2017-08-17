 <!DOCTYPE html>
<html lang="en">
   <head>
      <title>NRI Inventory System</title>
      <meta charset="utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!--Bootstrap related style-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!--Jquery datatable style-->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
   </head>
   <style>
      .navbar {
      margin-bottom: 0;
      border-radius: 0;
      }
      .pagelayout {
      border: 1px solid black;
      margin-top: 50px;
      margin-bottom: 100px;
      margin-right: 81px;
      margin-left: 80px;
      padding: 10px;
      }
      .progress {
      margin-bottom:0;
      margin-top:6px;
      margin-left:10px;
      width: 25%;
      }
      .btn.focus {
      outline:thin dotted #333;
      outline:5px auto -webkit-focus-ring-color;
      outline-offset:-2px;
      }
      .btn.hover {
      color:#ffffff;
      background-color:#3276b1;
      border-color:#285e8e;
      }
   </style>
   <body>
      <!--Nav bar-->
      <nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>                        
               </button>
               <a class="navbar-brand" href="#">NRI Inventory Tool</a>
            </div>
         </div>
      </nav>
      <!--End Nav bar-->
      <div class=" row pagelayout">
         <h3><b>Upload the CSV File</b></h3>
         <div class="form-group">
            <span id="UploadBtn" class="btn fileinput-button btn-primary">
            <span>Upload File</span>
            </span>
            <div id="progressOuter" class="progress progress-striped active" style="display:none;">
               <div id="progressBar" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
            </div>
            <div id="errorMsgBox" class="errorMsg"></div>
            <div id="successMsgBox" class="successMsg"></div>
            <div id="picBox" style="display:none;"></div>
         </div>
         <br>
        
         <button type="button" class="btn btn-info" id="loadfulltable">Load Full Table</button>
         <button type="button" class="btn btn-info" id="month">Load Amount Per Month Table</button>
         <button type="button" class="btn btn-info" id="category">Load Amount Per Category Table</button>
         <hr>

         <div class="full-table-data" style="display:none">
         <h4><b>Full details of the uploaded CSV file</b></h4>
         <table id="fulltable" class="table"></table>
         </div>

          <div class="month-table-data" style="display:none">
         <h4><b>Total spending amount per month</b></h4>
         <table id="monthtable" class="table"></table>
         </div>
         
          <div class="category-table-data" style="display:none">
          <h4><b>Total spending amount per category </b></h4>
         <table id="categorytable" class="table"></table>
         </div>

      </div>
   </body>
<!--Jquery library-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--Bootstrap style-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{asset('js/SimpleAjaxUploader.min.js')}}"></script>
<!--Jquery datatable script-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {

    var btn = document.getElementById('UploadBtn');
    progressBar = document.getElementById('progressBar');
    progressOuter = document.getElementById('progressOuter');
    picBox = document.getElementById('picBox');
    errMsgBox = document.getElementById('errorMsgBox');
    successMsgBox = document.getElementById('successMsgBox');

    var uploader = new ss.SimpleUpload({
        button: btn,
        url: '/store-file',
        name: 'uploadfile',
        hoverClass: 'hover',
        focusClass: 'focus',
        responseType: 'json',
        maxSize: 5000, // set the size
        multipart: true,
        queue: false,
        allowedExtensions: ['CSV'],
        customHeaders: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        startXHR: function() {
            progressOuter.style.display = 'block'; // make progress bar visible
            this.setProgressBar(progressBar);
        },
        onSubmit: function() {

            errMsgBox.innerHTML = ''; // empty the message box
            successMsgBox.innerHTML = ''; // empty the message box
            btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
        },
        onSizeError: function() {
            successMsgBox.innerHTML = ''; // empty the message box
            errMsgBox.innerHTML = 'Files may not exceed 500K.';
            return;
        },
        onExtError: function() {
            successMsgBox.innerHTML = '';
            errMsgBox.innerHTML = 'Invalid file type. Please select a CSV Files.';
            return;
        },
        onComplete: function(response, data) {
            btn.innerHTML = 'uploaded';
            progressOuter.style.display = 'none'; // hide progress bar when upload is completed
            console.log(data);
            if (data.success == 1) {
                successMsgBox.innerHTML = 'Successfully uploaded';
                loadFullDataTable();
            }
        },
        onError: function() {
            progressOuter.style.display = 'none';
            errMsgBox.innerHTML = 'Unable to upload file..';
        }
    });
});

 // Onclick load the complete CSV data
 $("#loadfulltable").click(function() {
     loadFullDataTable();
 });

 // Onclick load amount Per month table
 $("#month").click(function() {
     if ($.fn.dataTable.isDataTable('#monthtable')) 
     {
       $('#monthtable').DataTable().destroy();
     }
     $('.category-table-data').hide();
     $('.full-table-data').hide();
     $('.month-table-data').show();

     $.ajax({
         url: '/fetch-per-month',
         type:'GET',
         headers: {
             'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
         },
         type: 'GET',
         success: function(res) {
            var fulltable =[];  
            Object.keys(res.data).forEach(function (k) {
                var columndata = res.data[k];
                // push all the column data to an array
                fulltable.push([columndata.month, columndata.total]);
            });
            // Create a jquery datatable to load the data using the array
            $('#monthtable').DataTable({
                data: fulltable,
                columns: [
                    { title: "MONTH" },
                    { title: "TOTAL AMOUNT" }
                ]
            });
         }
     });
 });

 // Onclick load amount Per category table
 $("#category").click(function() {
     if ($.fn.dataTable.isDataTable('#categorytable')) 
     {
       $('#categorytable').DataTable().destroy();
     }
     $('.month-table-data').hide();
     $('.full-table-data').hide();
     $('.category-table-data').show();

     $.ajax({
         url: '/fetch-per-category',
         type:'GET',
         headers: {
             'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
         },
         type: 'GET',
         success: function(res) {
            var categorytable =[];  
            Object.keys(res.data).forEach(function (k) {
                var columndata = res.data[k];
                // push all the column data to an array
                categorytable.push([columndata.category, columndata.total]);
            });
            // Create a jquery datatable to load the data using the array
            $('#categorytable').DataTable({
                data: categorytable,
                columns: [
                    { title: "CATEGORY" },
                    { title: "TOTAL AMOUNT" }
                ]
            });
         }
     });
 });

 // Loads the complete CSV data in the datatable
 function loadFullDataTable()
 {
   if ($.fn.dataTable.isDataTable('#fulltable')) 
     {
       $('#fulltable').DataTable().destroy();
     }
   $('.month-table-data').hide();
   $('.category-table-data').hide();
   $('.full-table-data').show();
     $.ajax({
         url: '/fetch-full',
         type:'GET',
         headers: {
             'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
         },
         type: 'GET',
         success: function(res) {
            var fulltable =[];  
            Object.keys(res.data).forEach(function (k) {
                var columndata = res.data[k];
                // push all the column data to an array
                fulltable.push([columndata.id, columndata.tax_date, columndata.category, columndata.iot_title, columndata.iot_location, columndata.iot_condition, columndata.pre_tax_amt, columndata.tax_name, columndata.tax_amt]);
            });
            // Create a jquery datatable to load the data using the array
            $('#fulltable').DataTable({
                data: fulltable,
                columns: [
                    { title: "ID" },
                    { title: "DATE" },
                    { title: "CATEGORY" },
                    { title: "IOT TITLE" },
                    { title: "IOT LOCATION" },
                    { title: "IOT CONDITION" },
                    { title: "PRE TAX AMOUNT" },
                    { title: "TAX NAME" },
                    { title: "TAX AMOUNT" },
                ]
            });
         }
     });
 }
</script>
</html>