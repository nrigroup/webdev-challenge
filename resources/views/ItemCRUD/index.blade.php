@extends('layouts.default')
 
@section('content')
<br/><br/>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>NRI CRUD</h2>
            </div>
            <div class="pull-right">
                <a href="{{URL::to('getImport')}}" class="btn btn-success">Import</a>
                 <a href="{{URL::to('getExport')}}" class="btn btn-info">Export</a>                
                <a class="btn btn-success" href="{{ route('itemCRUD.create') }}"> Create New Item</a>
            </div>
            
                
            
        </div>
    </div>
<br/>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Amount Per Month</th>
            <th>Category</th>
            <th width="170px">Action</th>
        </tr>
    @foreach ($auction as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>${{ $item->pre_tax_amount }}</td>
        <td>{{ $item->category }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('itemCRUD.show',$item->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('itemCRUD.edit',$item->id) }}">Edit</a>          
        </td>
    </tr>
    @endforeach
    </table>

    {!! $auction->render() !!}

@endsection