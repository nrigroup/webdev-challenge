<!DOCTYPE html>
<html>
<head>
    <title>NRI Industrial Inc</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            NRI Industrial Inc
        </div>
        <div class="card-body">
            <form action="{{ route('calculate') }}" method="GET" enctype="multipart/form-data">
            <table>
        <tbody>
        <tr>
            <th>Category</th>
            <th>Year</th>
            <th>Month</th>
            <th>Total Tax</th>
          </tr>
         @foreach($products as $product)
          <tr>
              <td> {{$product->category}} </td>
              <td> {{$product->year}} </td>
              <td> {{$product->month}} </td>
              <td> {{$product->total}} </td>
          </tr>
         @endforeach
         </tbody>
         </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>

