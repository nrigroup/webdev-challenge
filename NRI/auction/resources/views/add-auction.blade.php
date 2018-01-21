<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import CSV/XLS file into database using Laravel</title>
    <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{!! asset('css/style.css') !!}" media="all" rel="stylesheet" type="text/css" />
</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <img src="img/excel-to-mysql-illustration.png" class="img-responsive" alt="Cinque Terre">
                </div>
                <div class="col-sm-4">
                    <a href="{!! asset('doc/data.csv')!!}" download="data.csv"><h4>Download sample CSV file</h4></a>
                    @if ( Session::has('success') )
                            <div class="alert alert-success alert-block" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <strong>{{ Session::get('success') }}</strong>
                            </div>
                    @endif
                    @if ( Session::has('error') )
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <strong>{{ Session::get('error') }}</strong>
                            </div>
                    @endif
                    @if (count($errors) > 0)
                            <div class="alert alert-warning alert-dismissable fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                    @endif
                </div>
            </div>
            <h2 class="jumbotron text-center">Laravel CSV/XLS Import </h2>
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-8">
                        Choose your xls/csv file : <input type="file" name="file" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <input type="submit" class="btn btn-primary btn-lg" value="Upload" style="margin-top: 3%">
                    </div>
                </div>
            </form>
            @if (count($auctions) > 0)
            <table  class="table-responsive table table-striped table-bordered table-hover">
                <thead>
                    <tr class="bg-info">
                        <th>Date</th>
                        <th>Category</th>
                        <th>Lot Location</th>
                        <th>Lot Condition</th>
                        <th>Pre Tax Amount</th>
                        <th>Tax Name</th>
                        <th>Tax Amount</th>
                        <th>Lot Title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auctions as $auction)
                        <tr>
                            <td>{{ $auction->date }}</td>
                            <td>{{ $auction->category }}</td>
                            <td>{{ $auction->lot_location }}</td>
                            <td>{{ $auction->lot_condition }}</td>
                            <td>{{ $auction->pre_tax_amount }}</td>
                            <td>{{ $auction->tax_name }}</td>
                            <td>{{ $auction->tax_amount }}</td>
                            <td>{{ $auction->lot_title }}</td>
                            <td>
                                {!! Form::open(['method' => 'DELETE','route'=>['Auction.destroy',$auction->id]]) !!}
                                {!! Form::submit('x', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table  class="table-responsive table table-striped table-bordered table-hover">
                <thead>
                    <tr class="bg-info">
                        <th>Month-Year</th>
                        <th>Category</th>
                        <th>Total spending amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->date }}</td>
                            <td>{{ $result->category }}</td>
                            <td>{{ $result->total_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </body>
</html>