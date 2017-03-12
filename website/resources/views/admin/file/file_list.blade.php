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
            $('<form id="batch" action="/file/batch-delete" method="POST"></form>').appendTo('body');
            $('<input>').attr({type: 'hidden', name: 'ids', value: values}).appendTo('#batch');
            $('<input>').attr({type: 'hidden', name: '_token', value: csrf_token}).appendTo('#batch');
            $('#batch').submit();
            return false;
        }
    </script>
@stop

@section("content")
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Files
<small><a data-toggle="modal" data-target="#fileUploadingModal"> New+ &raquo;</a></small>
        </h1>

        @include("admin.message")

        <?php echo $files->render();?>
        <div>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"> Batch Operations <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#" onclick="return batchDelete();">Delete</a></li>
                </ul>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><input title="All" type="checkbox" id="cb"></th>
                    <th>#</th>
                    <th>Name</th>
					<th>Owner</th>
					<th>Status</th>
                    <th>Date of Update</th>
                    <th>Date of Creation</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($files as $file):?>
                <tr>
                    <td><input title="Choose" class="cb" type="checkbox" value="<?php echo $file->id;?>" name="cb[]"></td>
                    <td><?php echo $file->id;?></td>
                    <td><?php echo htmlspecialchars($file->name);?></td>
					
                    <td><?php if($file->owner):?><?php echo htmlspecialchars($file->owner->name);?><?php endif;?></td>
					<td><?php if($file->status):?>Imported<?php else:?>Not been imported<?php endif;?></td>
                    <td><?php echo \App\Toolkits\Display::showDate($file->updated_at);?></td>
                    <td><?php echo \App\Toolkits\Display::showDate($file->created_at);?></td>
                    <td>
                        <div>
                            <form action="/file/<?php echo $file->id;?>" method="post"
                                  onsubmit="return confirm('Confirm?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a class="btn btn-xs btn-primary" href="/file/download/<?php echo $file->id;?>"><span class="glyphicon glyphicon-download-alt"></span></a>
                            <?php if($file->status==0):?><a class="btn btn-xs btn-primary" href="/file/import/<?php echo $file->id;?>"><span class="glyphicon glyphicon-import"></span></a><?php endif;?>
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
        <?php echo $files->render();?>
        <!-- Modal -->
        <div class="modal fade" id="fileUploadingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload File</h4>
              </div>
              <div class="modal-body">
                <form id="fileUploadingForm" action="/file" method="post"
                                          onsubmit="return confirm('Confirm to upload?');" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input name="csv" type="file" required="required"></input>
                                    </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="$('#fileUploadingForm').submit();">Upload</button>
              </div>

            </div>
          </div>
        </div>
    </div>
@stop
