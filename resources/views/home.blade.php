<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<style>

     html,body
      {
           height: 100%;
      }
    .container{
        display:grid;
        height: 100%;
    }

   .form-container
   {
       display: grid;
       height: 500px;
      align-items: center;
      box-shadow: 0px 0px 11px 1px rgba(0,0,0,1);
      background-color: rgba(0,0,0,0.02);
   }
   .container
    {
       align-items: center;
    }
   .button-cls
   {
      display:grid;
      justify-content: center;
      margin-top:2%;
   }

   .file-class
   {
      display:grid;
      justify-content: center;
   }

   h1{
      text-align:center;
      font-size:22px;
      margin-bottom:2%;
      text-transform:uppercase;
      opacity:0.7;
   }

   .custom-file-input
   {
      cursor:pointer;
   }


</style>

</head>
   <body>
       <div class="container">
         <div class="form-container">
            <form action="/handlefile" method="post" id="fileForm" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <h1>Select a CSV File</h1>
                  <div class="file-class">
                     <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                     </div>
                  </div>
                  <div class="button-cls">
                     <button type="button" class="btn btn-info" id="btnSubmit" name="btnSubmit">Submit</button>
                  </div>            
               </form>
         </div>
      </div>
   </body>

   <script>
       
        $(document).ready(function(){

console.log('executed');
         $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });

       
          $('#btnSubmit').on('click',function(){
              document.getElementById("fileForm").submit()
          });

        })




   </script>
</html>

</body>
</html>
