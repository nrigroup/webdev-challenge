<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Report Generator</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Custom JQuery for uploading file -->
        <script src="/js/upload.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                /**font-family: 'Raleway', sans-serif;**/
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                margin-top: 150px;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
            </p>Upload CSV file and the auction data will be stored into a database and report will be generated</p>
            <form action="/storeData" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="btn btn-default btn-file">Browse <input type="file" name="browse_file" id="browse_file" style="display: none;"></label>
                    <label> <input type="text" name="file_name" id="file_name" placeholder="No file selected" readonly></label>
                    <label class="btn btn-default" id="upload_label" disabled>Upload<input type="submit" name="submit" id="upload_button" style="display: none;" disabled></label>
                </div>
            </form>
            <button  name="update_name" id="update_name" hidden></button>
            </div>
        </div>
    </body>
</html>
