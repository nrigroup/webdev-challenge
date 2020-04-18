<!DOCTYPE html>
<html>
<head>
    <title>NRI - Auction Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
</head>

<body>
    
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            Auction Won Data
        </div>
            @if ($errors->any())
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
        <div class="card-body">
            <form action="{{ url('import') }}" method="POST" name="importform" enctype="multipart/form-data">
                @csrf
                <label for="upload-file">Upload</label>
                <input type="file" name="upload-file" class="form-control">
                <br>
                <button class="btn btn-success">Import File</button>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Auction Data</h3>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Address</th>
        <th>Province</th>
               </tr>
        @foreach($data as $c)
       <tr> 
       <td>{{ $c->first_name}}</td>
        <td>{{ $c->last_name }}</td>
        <td>{{ $c->address }}</td>
        <td>{{ $c->province}}</td>
       
       </tr>
       @endforeach
      </table>
      
     </div>
    </div>
</div>

</div>
    
</body>
</html>