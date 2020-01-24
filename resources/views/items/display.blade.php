@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header card-header-warning">
        <h4 class="card-title">Total Spending</h4>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead class="text-warning">
                <tr>
                    <th>Month</th>
                    <th>Category</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($items as $dt){?>     
                <tr>
                    <td><?php echo $dt->month;?></td>
                    <td><?php echo $dt->category; ?></td>
                    <td><?php echo $dt->amount; ?></td>
                </tr>
            <?php } ?>   
            </tbody>
        </table>
    </div>
</div>
@endsection

