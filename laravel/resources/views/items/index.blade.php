<head>
    <title>Import CSV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body class="container">
<h1 class="text-center">CSV Data Analysis</h1>
@if(count($items) > 1)
<h1 class='text-center text-danger'>Monthly Spending by Category</h1>
<table class="table container">
<thead>
<tr class="text-success">
        <th>Month</th>
        <th>Year</th>
        <th>Category</th>
        <th>Pre Tax Amount</th>
        <th>Tax Amount</th>
        <th>Total</th>
    </tr>
    </thead>
    @foreach($items as $item)
    <div>
    <tr>
        <th>{{$item -> Month}}</th>
        <th>{{$item -> Year}}</th>
        <th>{{$item -> category}}</th>
        <th>{{$item -> pretax}}</th>
        <th>{{$item -> tax}}</th>
        <th>{{$item -> Total}}</th>
    </tr>
    </div>
    @endforeach
    </table>
@else
    <p>No data found.</p>
    </body>
@endif