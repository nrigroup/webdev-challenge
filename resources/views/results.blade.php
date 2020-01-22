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
<body>

<div class="container">         
  <table class="table">
    <thead>
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
                <td>{{ $result -> category_name }}</td>
                <td>{{ $result -> expense }}</td>
                <td>{{ $result -> month }}</td>
                <td>{{ $result -> year }}</td>
            </tr>
         @endforeach
    </tbody>
  </table>
</div>

</body>
</html>






