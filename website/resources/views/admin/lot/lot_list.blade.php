@extends("admin.layout")

@section("head")
    <script type="text/javascript" src="/static/js/vendor/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#cb').click(function () {
                $('.cb').prop('checked', this.checked);
            });
        });
        function batchDelete() {
            var values = $('input:checkbox:checked.cb').map(function () {
                return this.value;
            }).get();
            if (values.length == 0) {
                alert("Please choose first");
                return false;
            }
            confirm("This function has not been implemented");
            return false;
            var csrf_token = $('meta[name=csrf-token]').attr('content');
            $('<form id="batch" action="/lot/batch-delete" method="POST"></form>').appendTo('body');
            $('<input>').attr({type: 'hidden', name: 'ids', value: values}).appendTo('#batch');
            $('<input>').attr({type: 'hidden', name: '_token', value: csrf_token}).appendTo('#batch');
            $('#batch').submit();
            return false;
        }
    </script>
@stop

@section("content")
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 col-lg-12 main">
        <h1 class="page-header">Lots
		<small><a href="/lot/create"> New+ &raquo;</a></small>
		</h1>
		
        @include("admin.message")

        <?php echo $lots->render();?>
        <div>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"> Batch Operations <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#" onclick="return batchDelete();">Delete</a></li>
                </ul>
                <button class="btn btn-default" data-toggle="modal" data-target="#searchModal">Search</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><input title="All" type="checkbox" id="cb"></th>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
					<th>Location</th>
					<th>Condition</th>
                    <th>Tax</th>
                    <th>Tax Amount</th>
                    <th>Pre-tax Amount</th>
                    <th>Uploader</th>
                    <th>Source</th>
                    <th>Date</th>
                    <th>Date of Update</th>
                    <th>Date of Creation</th>

                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($lots as $lot):?>
                <tr>
                    <td><input title="Choose" class="cb" type="checkbox" value="<?php echo $lot->id;?>" name="cb[]"></td>
                    <td><?php echo $lot->id;?></td>
					<td><?php echo htmlspecialchars($lot->title);?></td>
                    <td><?php if($lot->category!=null):?><?php echo htmlspecialchars($lot->category->name);?><?php endif;?></td>
					<td><?php echo htmlspecialchars($lot->location);?></td>
					<td><?php echo htmlspecialchars($lot->condition);?></td>
                    <td><?php if($lot->tax!=null):?><?php echo htmlspecialchars($lot->tax->name);?><?php endif;?></td>
                    <td><?php echo htmlspecialchars($lot->tax_amount);?></td>
                    <td><?php echo htmlspecialchars($lot->pre_tax);?></td>
					<td><?php if($lot->uploader!=null):?><?php echo htmlspecialchars($lot->uploader->name);?><?php endif;?></td>
                    <td><?php if($lot->source!=null):?><?php echo htmlspecialchars($lot->source->name);?><?php endif;?></td>
                    <td><?php echo htmlspecialchars($lot->date);?></td>
                    <td><?php echo \App\Toolkits\Display::showDate($lot->updated_at);?></td>
                    <td><?php echo \App\Toolkits\Display::showDate($lot->created_at);?></td>
                    <td>
                        <div>
                            <form action="/lot/<?php echo $lot->id;?>" method="post"
                                  onsubmit="return confirm('Confirm?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
								 <a href="/lot/<?php echo $lot->id;?>/edit" class="btn btn-xs btn-info"><span
                                            class="glyphicon glyphicon-pencil"></span></a>
                                <button class="btn btn-xs btn-danger" type="submit"><span
                                            class="glyphicon glyphicon-trash"></span></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php echo $lots->render();?>
        <!-- Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload File</h4>
              </div>
              <div class="modal-body">
                <form id="searchForm" action="/lot/filter" method="post">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="keyword">Title</label>
                        <input type="text" name="keyword" class="form-control" id="keyword">
                    </div>
                    <div class="form-group">
                        <label for="from">From</label>
                        <input type="date" name="from" class="form-control" id="from">
                    </div>
                    <div class="form-group">
                        <label for="to">To</label>
                        <input type="date" name="to" class="form-control" id="to">
                    </div>
                    <div class="form-group">
                        <label for="file_id">Source</label>
                        <select name="file_id">
                        <option selected=""></option>
                            <?php foreach($files as $file):?>
                          <option value="<?php echo $file->id;?>"><?php echo $file->name;?></option>
                          <?php endforeach;?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id">
                          <option selected=""></option>

                            <?php foreach($cats as $cat):?>
                          <option value="<?php echo $cat->id;?>"><?php echo $cat->name;?></option>
                          <?php endforeach;?>
                        </select>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="$('#searchForm').submit();">Search</button>
              </div>

            </div>
          </div>
        </div>
    </div>
@stop
