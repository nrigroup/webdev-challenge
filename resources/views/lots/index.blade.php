@extends ('layout')
@section ('content')
<div id='wrapper'>
    <div id="page" class="container">

        <div class='content'>
            <table class="table table-striped">
                <caption>Lots Won at Auction</caption>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Condition</th>
                    <th>Price</th>
                    <th>Date Won</th>
                </tr>
                @forelse($lots as $lot)
                <tr class="lotinfo">
                    <td><a href='{{route('lots.show', $lot)}}'>{{$lot->lot_title}}</a>
                    </td>
                    <td>{{$lot->category}}
                    </td>
                    <td>{{ $lot->lot_condition }}
                    </td>
                    <td>${{ $lot->pretax_amount + $lot->tax_amount  }}
                    </td>
                    <td>{{str_replace("T00:00", "",  $lot->date_won)}}
                    </td>
                </tr>
                @empty
                <tr>
                    <td>No lots yet.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
</div>
@endsection
