<script type='text/javascript' src='{{ asset('js/app.js') }}'></script>
<script type='text/javascript' src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#items_table').DataTable({
            "aaSorting": []
        });
    } );
</script>