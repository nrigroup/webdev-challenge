<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5.8 Import Export Excel to database Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body>
   
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Hiren Bhatia CSV import
        </div>
        <div class="card-body">
        <!-- Import Form -->
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Data</button>
            </form>
        </div>
        <!-- Table Data -->
        @if($items)
            <table class="table">
                <thead>
                    <tr>
                        <td colspan=6>
                            <h3 style="text-align: center;">Total Spending amount per month and category</h3>
                        </td>
                    </tr>
                    <tr>
                    <th scope="col">Month</th>
                    <th scope="col">Year</th>
                    <th scope="col">Category</th>
                    <th scope="col">Base Amount</th>
                    <th scope="col">Tax Amount</th>
                    <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                                <!-- <td>{{ $item->Month }}</td> -->
                                <td>{{ date("F", mktime(0, 0, 0, $item->Month, 1)) }}</td>
                                <td>{{ $item->year }}</td>
                                <td>{{ $item->category }}</td>
                                <td>{{ $item->base }}</td>
                                <td>{{ $item->tax }}</td>
                                <td>{{ $item->Total }}</td>
                        </tr>
                    @endforeach  
                </tbody>
            </table>

@endif
    </div>
</div>
   
</body>
</html>