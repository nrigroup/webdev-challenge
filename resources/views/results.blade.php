<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
   h1{
     text-transform: uppercase;
     font-size:23px;
     opacity: 0.6;
     margin-top:5%;
     margin-bottom:5%;
     text-align:center;
   }

   .table
   {
     box-shadow: 0px 0px 4px 1px rgba(0,0,0,1);
   }

</style>
<body>

<div class="container">         

  <h1>Results categorized by month and year</h1>
  <table class="table">
    <thead class="table-primary">
      <tr>
        <th>Category Name</th>
        <th>Expense</th>
        <th>Month</th>
        <th>Year</th>
      </tr>
    </thead>
    <tbody>
         @foreach ($results as $result)
            <tr>
                <td class="table-light">{{ $result -> category_name }}</td>
                <td class="table-light">{{ $result -> expense }}</td>
                <td class="table-light">{{ $result -> month }}</td>
                <td class="table-light">{{ $result -> year }}</td>
            </tr>
         @endforeach
    </tbody>
  </table>
</div>

</body>
</html>






