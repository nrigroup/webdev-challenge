@extends ('layout')
@section ('content')


<div id="wrapper">
    <div id="page" class="container">
        <div id="content">
            <div class="title">
                <h3 class="text-center"><a class="font-weight-lighter" href="/lots/edit/{{$lot->id}}">Edit this Lot</a>
                </h3>

                <div>
                    <div>
                        <label for="lot_title" class="label">Title</label>
                        <input type="text" size="50" class="input" id='lot_title' name='lot_title' disabled
                            value="{{$lot->lot_title ?? ''}}" /><br>
                        <label for="category" class="label">Category</label>
                        <input type="text" size="50" class="input" name="category" id="lot_category" disabled
                            value="{{$lot->category ?? ''}}" /><br>
                        <label for="lot_condition" class="label">Condition</label><input type="text" size="50"
                            class="input" disabled name="lot_condition" id="lot_condition"
                            value="{{$lot->lot_condition ?? ''}}" /><br>
                        <label for="lot_location" class="label">Location</label><input type="text" size="50"
                            class="input" disabled name="lot_location" id="lot_location"
                            value="{{$lot->lot_location ?? ''}}" /><br>
                        <label for="pretax_amount" class="label">Pretax $</label><input type="number" step="0.01"
                            disabled size="50" class="input" name="pretax_amount" id="pretax_amount" disabled
                            value="{{$lot->pretax_amount ?? ''}}" /><br>
                        <label for="tax_name" class="label">Tax Name</label><input disabled type="text" size="50"
                            class="input" name="tax_name" id="tax_name" value="{{$lot->tax_name ?? ''}}" /><br>

                        <label for="tax_amount" class="label">Tax $</label><input type="number" disabled step="0.01"
                            size="50" class="input" name="tax_amount" id="tax_amount"
                            value="{{$lot->tax_amount ?? ''}}" /><br>

                        <label for="date_won" class="label">Date Won</label><input type="date" disabled step="1"
                            size="50" class="input" name="date_won" id="date_won"
                            value="{{str_replace("T00:00", "",  $lot->date_won)}}" /><br>
                    </div>
                </div>

                <button id="deletelot" data-id="{{$lot->id}}" class="example2 btn btn-primary">Delete</button>

            </div>
        </div>
    </div>
</div>

@endsection
