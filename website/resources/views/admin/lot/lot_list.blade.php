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
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 col-lg-11 col-lg-offset-1 main">
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

    </div>
@stop
