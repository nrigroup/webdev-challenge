@extends ('layout')
@section ('content')


<div id="wrapper">

    <div id="page" class="container">
        <h2>Upload Lots</h2>
        <form method="post" action="/lots/loadcsv" enctype="multipart/form-data">
            @csrf
            <div class="control">
                <label> Please select a ".csv" Lots file to upload:</label>
                <input class="btn btn-default" type="file" name="csvfile" />
            </div>

            <input class="btn btn-primary" type="submit" name="upload" value="Upload" />
        </form>

    </div>
</div>

@endsection
