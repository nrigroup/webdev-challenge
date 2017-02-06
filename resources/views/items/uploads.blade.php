@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Uploads</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Uploaded by</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uploads as $upload)
            <tr>
                <td><a href="/items/upload_detailed/{{ $upload->id }}">{{ $upload->id }}</a></td>
                <td><a href="/items/upload_detailed/{{ $upload->id }}">{{ $upload->timestamp }}</a></td>
                <td>{{ $upload->userID }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

@endsection