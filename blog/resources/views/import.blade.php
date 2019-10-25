<!DOCTYPE html>
<html>
<head>
    <title>NRI Industrial Inc</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body>

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            NRI Industrial Inc
        </div>
        <div class="card-body">
            <form action="{{ route('ProductsImport') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Product Data</button>
                <a class="btn btn-secondary" href="{{ route('productsexport') }}">Export Product Data</a>

                <a class="btn btn-primary" href="{{ route('calculate') }}">calculate</a>
            </form>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif

</body>
</html>
