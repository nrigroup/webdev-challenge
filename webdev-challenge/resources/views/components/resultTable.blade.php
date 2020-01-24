<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Upload CSV file</h1>

            <div class="card mb-4">
                <div class="card-body">

                    @include('components.uploadComponent')

                </div>
            </div>
            @if(count($content) > 0 )
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Example</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>yyyymm</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>yyyymm</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($content as $item)
                                    <tr>
                                        @foreach($item as $value)
                                        <td>{{$value}}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @endif
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Jianwen 2020</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
