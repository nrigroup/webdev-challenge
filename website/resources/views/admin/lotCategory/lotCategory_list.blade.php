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
            $('<form id="batch" action="/category/batch-delete" method="POST"></form>').appendTo('body');
            $('<input>').attr({type: 'hidden', name: 'ids', value: values}).appendTo('#batch');
            $('<input>').attr({type: 'hidden', name: '_token', value: csrf_token}).appendTo('#batch');
            $('#batch').submit();
            return false;
        }
    </script>
@stop

@section("content")
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Lot Categories
<small><a href="/category/create"> New+ &raquo;</a></small>
        </h1>

        @include("admin.message")

        <?php echo $cats->render();?>
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
                    <th>Parent</th>
                    <th>Date of Update</th>
                    <th>Date of Creation</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($cats as $cat):?>
                <tr>
                    <td><input title="Choose" class="cb" type="checkbox" value="<?php echo $cat->id;?>" name="cb[]"></td>
                    <td><?php echo $cat->id;?></td>
                    <td><?php echo htmlspecialchars($cat->name);?></td>
                    <td><?php if($cat->parent!=null):?><?php echo htmlspecialchars($cat->parent->name);?><?php else:?>Top Category<?php endif;?></td>
					<td><?php echo \App\Toolkits\Display::showDate($cat->updated_at);?></td>
                    <td><?php echo \App\Toolkits\Display::showDate($cat->created_at);?></td>
                    <td>
                        <div>
                            <form action="/category/<?php echo $cat->id;?>" method="post"
                                  onsubmit="return confirm('Confirm?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a href="/category/<?php echo $cat->id;?>/edit" class="btn btn-xs btn-info"><span
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
        <?php echo $cats->render();?>

    </div>
@stop
