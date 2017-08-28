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

                <div class="container">
                    <h2>Spending Report</h2>
                    <p>The following is the spending report generated from the database</p>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Year</th>
                                <th>Month</th>
                                <th>Total Tax</th>
                                <th>Total Spending<th>
                            </tr>
                        </thead>
                
                        <tbody>
                            @foreach($reports as $report)
                            <tr class="active">
                                <td>{{$report->Category}}</td>
                                <td>{{$report->year}}</td>
                                <td>{{$report->month}}</td>
                                <td>${{$report->total_tax_amount}}</td>
                                <td>${{$report->total_amount}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
