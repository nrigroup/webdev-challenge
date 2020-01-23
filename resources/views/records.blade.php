@extends('layouts.app')

@section('content')
            <div class="jumbotron text-center">
                <h1>Total Spending Amount Month & Category Wise</h1>
                <hr>
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-striped table-dark">
                    <thead>
                      <tr>  
                        <th scope="col">Year</th>
                        <th scope="col">Month</th>
                        <th scope="col">Category</th>
                        {{-- <th scope="col">Total Pre Tax Amount</th> --}}
                        {{-- <th scope="col">Total Tax Amount</th> --}}
                        <th scope="col">Total Spending Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach ($records as $record)
                         <tr>
                             <td>{{$record->LotYear}}</td>
                             <td>{{$record->LotMonth}}</td>
                             <td>{{$record->Category}}</td>
                             {{-- <td>{{number_format($record->TotalPreTaxAmount,2)}}</td> --}}
                             {{-- <td>{{number_format($record->TotalTaxAmount,2)}}</td> --}}
                             <td>{{number_format($record->TotalPreTaxAmount + $record->TotalTaxAmount,2)}}</td>
                         </tr>
                     @endforeach
                    </tbody>
                  </table>
                  <a class="btn btn-primary btn-lg" href="/" role="button">Import CSV</a>
            </div>

@endsection