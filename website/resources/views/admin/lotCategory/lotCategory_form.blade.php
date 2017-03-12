@extends("admin.layout")

@section("content")
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">
            Lot
            <small><a href="/category/">&laquo; Back to List Page</a></small>
        </h1>

        @include("admin.message")

        <form action="/category<?php if ($cat->id) {
            echo "/".$cat->id;
        }?>" method="post">
            <div class="editor row">
                <div class="col-sm-9">
                    <?php if($cat->id):?><input type="hidden" name="_method" value="PUT"><?php endif;?>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <h3>Category Information</h3>

                    
					<div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                               value="<?php echo $cat->name;?>" required>
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent</label>
                        <select name="parent_id" required>
                            <option value="0" selected="true">Top Category</option>
                            <?php foreach($parents as $parent):?>
                          <option value="<?php echo $parent->id;?>"><?php echo $parent->name;?></option>
                          <?php endforeach;?>
                        </select>
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
