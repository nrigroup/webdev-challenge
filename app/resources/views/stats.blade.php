<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NRI Group</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="{{ asset('css/custom.css')}}" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Styles -->


        <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>

    </head>
        <body>
            <div>


                <div class="content">
                    <div class="title m-b-md">
                        <a href="/">NRI Group</a>
                        <hr>
                        <a href="{{ route('index.upload')}}" class="btn btn-success text-center">Upload</a>
                        <a href="{{ route('index.stats')}}" class="btn btn-info text-center">Stats</a>

                    </div>
                </div>



                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                <h2 class="heading">Stats</h2>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">

                                <h4>Last 3 Months Total Revenue</h4>

                            @forelse ($monthly as $mon)
                                <p>{{ $mon->date_month}} / {{ $mon->date_year }}</p>
                                <p>${{ $mon->total}}</p>
                                <hr>
                            @endforeach


                                <table class="table table-bordered table-striped table-custom" id="dt">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Condition</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    @if(!empty($subs))
                                    <tbody>
                                        @foreach($subs as $sub)
                                        <tr>
                                            <td>{{ $sub->title}}</td>
                                            <td>{{ $sub->category}}</td>
                                            <td>{{ $sub->location}}</td>
                                            <td>{{ $sub->condition}}</td>
                                            <td>${{$sub->total}}</td>
                                            <th>{{ Carbon\Carbon::parse($sub->date)->format('Y-m-d')}}</th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @endif
                                </table>

                        </div>

                    </div>

            </div>


        </body>

        <script type="text/javascript">
        $(document).ready(function(){
            $('#dt').DataTable({
                 "order": [[ 5, "desc" ]]
            });
            });
        </script>


</html>
