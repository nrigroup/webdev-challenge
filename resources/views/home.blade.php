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
    .container{

        display:grid;
    }

   .form-container
   {
       display: grid;
       grid-template-rows: 50% 30%;
   }
   .button-cls
   {
      display:grid;
      justify-content: center;
   }

</style>

</head>
   <body>
       <div class="container">
         <div class="form-container">
            <form action="/handlefile" method="post" id="fileForm" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="custom-file">
                     <input type="file" class="custom-file-input" name="file" id="customFile">
                     <label class="custom-file-label" for="customFile">Choose file</label>
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


         $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });

       
          $('#btnSubmit').on('click',function(){
              console.log(document.getElementById("fileForm"));
              document.getElementById("fileForm").submit()
          });

        })




   </script>
</html>

</body>
</html>
