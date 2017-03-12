@extends("admin.layout")

@section("content")
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">
            Lot
            <small><a href="/tax/">&laquo; Back to List Page</a></small>
        </h1>

        @include("admin.message")

        <form action="/tax<?php if ($tax->id) {
            echo "/".$tax->id;
        }?>" method="post">
            <div class="editor row">
                <div class="col-sm-9">
                    <?php if($tax->id):?><input type="hidden" name="_method" value="PUT"><?php endif;?>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <h3>Tax Information</h3>

                    
					<div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                               value="<?php echo $tax->name;?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="description"
                               value="<?php echo $tax->description;?>" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
                <div class="col-sm-3">
                   
  
                </div>
            </div>
        </form>


    </div>
@stop
