@extends ('layout')
@section ('content')


<div id="wrapper">

    <div id="page" class="container">
        <h3 class="text-center">{{ucfirst($UPDATE_CREATE)}} Lot</h3>
        <form method="post" action="/lots/{{$UPDATE_CREATE}}/{{$lot->id ?? ''}}">
            @csrf

            @isset($lot)
            @method('put')
            @endisset

            <div id="content">
                <div>
                    <label for="lot_title" class="label">Title</label>
                    <input type="text" size="50" class="input" id='lot_title' name='lot_title'
                        value="{{$lot->lot_title ?? ''}}" /><br>
                    <label for="category" class="label">Category</label>
                    <input type="text" size="50" name="category" class="input" id="category"
                        value="{{$lot->category ?? ''}}" /><br>

                    <label for="lot_condition" class="label">Condition</label><input class="input" type="text" size="50"
                        name="lot_condition" id="lot_condition" value="{{$lot->lot_condition ?? ''}}" /><br>
                    <label for="lot_location" class="label">Location</label><input type="text" size="50" class="input"
                        name="lot_location" id="lot_location" value="{{$lot->lot_location ?? ''}}" /><br>
                    <label for="pretax_amount" class="label">Pretax $</label><input type="number" step="0.01" size="50"
                        class="input" name="pretax_amount" id="pretax_amount"
                        value="{{$lot->pretax_amount ?? ''}}" /><br>
                    <label for="tax_name" class="label">Tax Name</label><input type="text" size="50" name="tax_name"
                        class="input" id="tax_name" value="{{$lot->tax_name ?? ''}}" /><br>

                    <label for="tax_amount" class="label">Tax $</label><input type="number" step="0.01" size="50"
                        class="input" name="tax_amount" id="tax_amount" value="{{$lot->tax_amount ?? ''}}" /><br>
                    <label for="date_won" class="label">Date Won</label><input type="date" step="1" size="50"
                        name="date_won" id="date_won" class="input"
                        value="{{str_replace("T00:00", "",  $lot->date_won ?? '')}}" /><br>
                </div>
            </div>
            <div class="formend">
                <button class="btn btn-primary" type="submit">{{ucfirst($UPDATE_CREATE)}}</button>
            </div>
        </form>

    </div>
</div>

@endsection
