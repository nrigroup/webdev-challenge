<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WebDev-Challenge</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
              height: 100%;
            }

            body {
              display: flex;
              justify-content: center;
              align-items: center;
            }

        </style>
    </head>
    <body class="container">

        

        <form method="POST" action="/csv" enctype="multipart/form-data">

          {{ csrf_field ()}}

          <input type="file" name="csv"></input>
          <button type="submit">Submit</button>
        </form>
    </body>
</html>
