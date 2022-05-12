@extends('layouts.master')
@section('title', 'Upload File')
@section('content')

    <div class="upload">
        <p>Please upload your file to view the reports</p>
        <form method="POST" enctype="multipart/form-data" action="/upload">
            @csrf
            <div class="label_file">
				<span> Drop a file or click to select one</span>
                <input type="file" name="file" >
            </div>
            <input class="submit" type="submit">
        </form>
    </div>

@endsection
</html>
