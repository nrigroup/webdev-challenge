<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Challenge</title>
    <!-- Bootstrap 4 css file --start-- -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Bootstrap 4 css file --end-- -->
    <!-- Custom css file --start-- -->
    <link rel="stylesheet" href="{{ asset('css/custom-css.css') }}">
    <!-- Custom css file --end-- -->
</head>
<body class="body-padding">
<!-- Csv uploader modal --start-- -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CSV Uploader</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/save-csv-data') }}" method="POST" enctype="multipart/form-data" id="submit-form" onsubmit="return checkForm(this);">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload .csv file</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="upload-file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-btn" name="save">Save Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Csv uploader modal --end-- -->
<!-- navbar --start-- -->
<nav class="navbar navbar-light fixed-top justify-content-between navbar-custom-style">
    <h3 class="navbar-brand">NRI Industrial Sales Inc.</h3>
    <div>
        <img src="{{ asset('storage/laravel_logo.png') }}" width="50px" height="50px"/>
        <span class="hidden-span-xs vertical-align">version 6.13.1</span>
    </div>
</nav>
<!-- navbar --end-- -->
<div class="container">
    <!-- shows message on success or error --start-- -->
    @if(\Session::has('success'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p>Aww yeah, data successfully stored into database.</p>
        </div>
    @endif
    @if(\Session::has('error'))
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Oops!</h4>
            <p>Something went wrong, data couldn't store into database</p>
        </div>
    @endif
<!-- shows message on success or error --end-- -->
    <!-- shows message on validation errors --start-- -->
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Oops!</h4>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
<!-- shows message on validation errors --end-- -->
    <!-- Upload csv card --start-- -->
    <div class= @if(count($getChallengeData)== 0) {{ 'card-wrapper' }}@endif>
        <div class="card">
            <h5 class="card-header">Web Development Challenge</h5>
            <div class="card-body">
                <h5 class="card-title">Upload .csv file</h5>
                <p class="card-text">The data will store into database</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Upload csv data
                </button>
            </div>
        </div>
    </div>
    <!-- Upload csv card --end-- -->
    <!-- data shown in table  --start-- -->
    @if(count($getChallengeData) > 0 )
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Category</th>
                    <th scope="col">Amount per month</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $increment = 0;
                @endphp

                @foreach($getChallengeData as $data)
                    @php
                        $increment++;
                        $dt = DateTime::createFromFormat('!m', $data->month)
                    @endphp
                    <tr>
                        <td scope="row">{{ $increment }}</td>
                        <td>{{ $dt->format('F').' '.$data->year }}</td>
                        <td>{{ $data->category }}</td>
                        <td>{{ floatval($data->total_amount) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endif
<!-- data shown in table  --end-- -->
</div>
<!-- footer  --start-- -->
<footer id="sticky-footer" class="py-4 bg-info text-white-50 footer">
    <div class="container text-center">
        <small>Copyright &copy; Brijesh Ahir</small>
    </div>
</footer>
<!-- footer  --end-- -->
<!-- Custom js file --start-- -->
<script src="{{ asset('js/custom-js.js') }}"></script>
<!-- Custom js file --end-- -->
<!-- Bootstrap 4 js file --start-- -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!-- Bootstrap 4 js file --end-- -->
</body>
</html>