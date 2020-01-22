@extends ('layout')
@section ('content')


<div id="wrapper">
    <div id="page" class="container">
        <div id="content">
            <div>

                <form method="get" action="/lots/report">
                    @csrf
                    <div class="text-center">
                        <h4>Report Timeframe</h4>

                        <label for="date_from" class="slabel">From</label>
                        <input class="input" type="date" step="1" size="20" name="date_from" id="date_from"
                            value="{{$date_from ?? ''}}" />

                        <label for="date_to" class="slabel">To</label>
                        <input class="input" type="date" step="1" size="20" name="date_to" id="date_to"
                            value="{{$date_to ?? ''}}" />

                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
            <table class="table table-sm table-bordered  table-hover">
                <caption class="border border-light">{{$monthly['title']  ?? ''}} </caption>
                <tr>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Total</th>
                </tr>
                @forelse ($monthly['report'] as $row)
                <tr>
                    <td>{{ date("F", mktime(0, 0, 0, $row->month , 10)) }}</td>
                    <td>{{ $row->year  }}</td>
                    <td>${{ $row->total  }}</td>
                </tr>
                @empty
                <tr>
                    <td>No report</td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </table>

            <table class="table table-sm table-bordered table-hover">
                <caption class="border border-light">{{$category['title']  ?? ''}} </caption>
                <tr>
                    <th>Category</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Total</th>
                </tr>
                @forelse ($category['report'] as $row)
                <tr>
                    <td>{{$row->category}}</td>
                    <td>{{ date("F", mktime(0, 0, 0, $row->month , 10)) }}</td>
                    <td>{{ $row->year  }}</td>
                    <td>${{ $row->total  }}</td>
                </tr>
                @empty
                <tr>
                    <td>No report</td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </table>
        </div>

    </div>
</div>

@endsection
