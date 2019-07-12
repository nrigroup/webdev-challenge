@extends('layouts.app')

@section('title','NRI Industrial')

@section('content')
    <main class="container">
        <section class="row mt-4">
            <article class="col-12 text-center">
                Upload (.csv) file to import data into database
            </article>
        </section>
        <section class="row justify-content-center">
            <article class="col-12 mt-3">
                <form method="post" action="{{ route('csv.parse-and-save') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="doc" name="doc">
                    </div>
                    @if($errors->has('doc'))
                        <strong class="alert-danger">{{ $errors->first('doc') }}</strong>
                    @endif
                    @include('layouts._partials._flash')
                    <div class="text-center">
                        <button type="submit" id="btnParseAndSave" class="btn btn-primary mt-2 d-none">Parse And Save
                        </button>
                    </div>
                </form>
            </article>
        </section>
        @if(session('parsedCsv'))
            {{ csrf_field() }}
            <section class="row">
                <article class="col-12">
                    <p class="alert-success">File content was successfully saved to inventory.</p>
                </article>
                <article class="col-12 mt-2">
                    <p class="alert-info">Here is the preview of file</p>
                </article>
                <article class="col-12">
                        <textarea rows="10" class="form-control" name="parsed_csv"
                                  readonly>{{ session('parsedCsv') }}</textarea>
                </article>
            </section>
        @endif
        <hr>
        <section class="row mt-4">
            <article class="col-6">
                <h3>Total Spending Per Category</h3>
                @if($categories->isNotEmpty())
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->title }}</td>
                                <td>
                                    ${{ preg_replace('~\.0+$~','',$category->total_spending) }}</td>{{--Remove unneccessary 0's from number--}}
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">No categories available</div>
                @endif
            </article>
            <article class="col-6">
                <h3>Total Spending Per Month</h3>
                @if($monthlySpending->isNotEmpty())
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($monthlySpending as $spending)
                            <tr>
                                <td>{{ $spending->year }}, {{ date("F",mktime(0, 0, 0, $spending->month, 10)) }}</td>
                                <td>
                                    ${{ preg_replace('~\.0+$~','',$spending->amount) }}</td>{{--Remove unneccessary 0's from number--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">No categories available</div>
                @endif
            </article>
        </section>
    </main>
@endsection