@extends('layouts.default')
 @section('content')
<br/><br/>
    <div class="row">
        <div class="col-lg-12 margin-tb">
        <form action="postImport" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="file" name="items"/>
            <input class="btn btn-success" type="submit" value="Import"></input>
        </form>
        </div>
    </div>
<br>
   <div class="row">
       <div class="col-lg-12 margin-tb">
           <p>Please select CSV file for Import</p>
       </div>
   </div>
<div class="pull-left">
 <a class="btn btn-primary" href="{{route('itemCRUD.index') }}"> Back</a>
</div>
@endsection