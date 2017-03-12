@extends("admin.layout")

@section("content")
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">
            Lot
            <small><a href="/lot/">&laquo; Back to List Page</a></small>
        </h1>

        @include("admin.message")

        <form action="/lot<?php if ($lot->id) {
            echo "/".$lot->id;
        }?>" method="post">
            <div class="editor row">
                <div class="col-sm-9">
                    <?php if($lot->id):?><input type="hidden" name="_method" value="PUT"><?php endif;?>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <h3>Lot Information</h3>

                    
					<div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title"
                               value="<?php echo $lot->title;?>" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control" id="location"
                               value="<?php echo $lot->location;?>" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="condition">Condition</label>
                        <input type="text" name="condition" class="form-control" id="condition"
                               value="<?php echo $lot->condition;?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tax_id">Tax</label>
                        <select name="tax_id" required>
                            <?php foreach($taxes as $tax):?>
                          <option value="<?php echo $tax->id;?>" <?php if($lot->tax_id==$tax->id):?>selected="true"<?php endif;?>><?php echo $tax->name;?></option>
                          <?php endforeach;?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="tax_amount">Tax Amount</label>
                        <input type="number" min="0" step="0.01" name="tax_amount" class="form-control" id="tax_amount"
                               value="<?php echo $lot->tax_amount;?>" required>
                    </div>
                    <div class="form-group">
                        <label for="pre_tax">Pre-tax Amount</label>
                        <input type="number" min="0" step="0.01" name="pre_tax" class="form-control" id="pre_tax"
                               value="<?php echo $lot->pre_tax;?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" required>
                            <?php foreach($cats as $cat):?>
                          <option value="<?php echo $cat->id;?>" <?php if($lot->category_id==$cat->id):?>selected="true"<?php endif;?>><?php echo $cat->name;?></option>
                          <?php endforeach;?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control" id="date"
                               value="<?php echo $lot->date;?>" required>
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
