@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
      <?php
         echo Form::open(array('url' => '/uploadfile','files'=>'true'));
         echo Form::token();
         echo 'Select the file to upload.';
         echo Form::file('csv');
         echo '<br>';
         echo Form::submit('Upload File');
         echo Form::close();
      ?>
        </div>
    </div>
</div>
@endsection
