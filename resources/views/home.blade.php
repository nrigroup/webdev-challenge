<!DOCTYPE html>
<html>
<body>

<html>
   <body>
      
      <form action="/handlefile" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
         <input type="file" name="file" id="file" />
         <input type="submit" name="submit" />
      </form>
      
   </body>
</html>

</body>
</html>
