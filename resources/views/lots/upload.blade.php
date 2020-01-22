@extends ('layout')
@section ('content')


<div id="wrapper">

    <div id="page" class="container">

        <div id="content" style="text-align:center">
            <div class="textleft">
                <h2 class="text-center">Upload Lots</h2>
                <form method="post" action="/lots/loadcsv" enctype="multipart/form-data">
                    @csrf
                    <div class="control text-center">
                        <label> Please select a ".csv" Lots file to upload:</label>
                        <input class="btn btn-default" type="file" name="csvfile" />
                    </div>
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" name="upload" value="Upload" />
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
