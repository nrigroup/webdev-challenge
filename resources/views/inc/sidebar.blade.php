@section('sidebar')
<div class="card sidebar">
  @if(Request::is('data'))
    <h4>CSV IMPORT</h4>
    <hr>
    Please select your file...
    <form action="{{url('/importFile')}}" method="post" enctype="multipart/form-data">
      @csrf
      <br>
      <input type="file" name="file" id="file">
      <br>
      <button type="submit"> <strong><i class="fas fa-upload"></i> UPLOAD</strong></button>
    </form>
  @endif
  @show
</div>
<br>
@if (session('errors'))
  @foreach ($errors as $error)
  <div class="alert alert-danger">
    {{$error}}
  </div>
  @endforeach
@endif

@if (session('success'))
  <div class="alert alert-success">
    File has been uploaded.
  </div>
@endif