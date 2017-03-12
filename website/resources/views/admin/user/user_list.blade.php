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
            $('<form id="batch" action="/user/batch-delete" method="POST"></form>').appendTo('body');
            $('<input>').attr({type: 'hidden', name: 'ids', value: values}).appendTo('#batch');
            $('<input>').attr({type: 'hidden', name: '_token', value: csrf_token}).appendTo('#batch');
            $('#batch').submit();
            return false;
        }
    </script>
@stop

@section("content")
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Users</h1>

        @include("admin.message")

        <?php echo $users->render();?>
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
                    <th>Email</th>
                    <th>Registration Date</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user):?>
                <tr>
                    <td><input title="Choose" class="cb" type="checkbox" value="<?php echo $user->id;?>" name="cb[]"></td>
                    <td><?php echo $user->id;?></td>
                    <td><?php echo htmlspecialchars($user->name);?></td>
                    <td><?php echo htmlspecialchars($user->email);?></td>
					
                    <td><?php echo \App\Toolkits\Display::showDate($user->created_at);?></td>
                    <td>
                        <div>
                        <?php if($user->id!=Auth::id()):?>
                            <form action="/user/<?php echo $user->id;?>" method="post"
                                  onsubmit="return confirm('Confirm?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <button class="btn btn-xs btn-danger" type="submit"><span
                                            class="glyphicon glyphicon-trash"></span></button>
                            </form>
                            <?php endif;?>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php echo $users->render();?>

    </div>
@stop
