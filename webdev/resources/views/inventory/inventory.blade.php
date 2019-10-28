{{-- layout style-1 from layouts --}}
@extends('layouts.layout1')

@section('title', 'Inventory Manager')

@section('content')

    <div class="row p-2">

        <div class="col">
            <div class="row">
                {{-- Vertical Navigation --}}
                <div class="col-2">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Inventory</a>
                    {{-- <a class="nav-link" id="v-pills-reports-tab" data-toggle="pill" href="#v-pills-reports" role="tab" aria-controls="v-pills-reports" aria-selected="false">Reports</a> --}}
                </div>
                </div>
                <div class="col-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        {{-- Inventory pan start --}}
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            {{-- Horizontal navigation pan --}}
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-inventory-tab" data-toggle="tab" href="#nav-inventory" role="tab" aria-controls="nav-inventory" aria-selected="true">Import/Search</a>
                                    <a class="nav-item nav-link" id="nav-new-tab" data-toggle="tab" href="#nav-new" role="tab" aria-controls="nav-new" aria-selected="false">Add</a>
                                    <a class="nav-item nav-link" id="nav-view-tab" data-toggle="tab" href="#nav-view" role="tab" aria-controls="nav-view" aria-selected="false">View</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">

                                {{-- Inventory import pan --}}
                                <div class="tab-pane fade show active" id="nav-inventory" role="tabpanel" aria-labelledby="nav-inventory-tab">
                                    <div class="row mt-2">
                                        <div class="col">
                                            {{-- Request to import InventoryManagerController@import_inventory  --}}
                                            <form action=" {{ url('/import') }} " method="post" enctype="multipart/form-data" >
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <h5>Import lot items in inventory</h5>
                                                    </div>
                                                </div>
                                                @if(session()->has('message'))
                                                    <div class="alert alert-success">
                                                        {{ session()->get('message') }}
                                                    </div>
                                                @endif
                                                @if(count($errors) > 0)
                                                    <div class="alert alert-danger">
                                                        Upload Validation Error<br><br>
                                                        <ul>
                                                            @foreach($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            <div class="custom-file">
                                                <label class="custom-upload-file" for="customFile">
                                                    <i class="fas fa-upload" style="font-size:52px;"></i>
                                                    <h5>Upload file to import</h5>
                                                    <small style="font-size:10px;">File must be in xsl,.xslx or .csv format</small>
                                                    <input type="file" class="custom-file-input" id="customFile" name="import_file">
                                                </label>
                                            </div> <br>
                                            <button type="submit" class="btn btn-info btn-block mt-5">
                                                <i class="fas fa-file-import"></i>
                                                Import
                                            </button> <br>
                                            {{ csrf_field() }}
                                            </form>
                                            {{-- End of request to import InventoryManagerController@import_inventory  --}}
                                        </div>
                                        <div class="col">

                                            {{-- Search form start --}}
                                            <form action=" {{ route('search') }}" method="get" id= "search_result">
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <h5>Search Exapnses</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="timeline">Timeline</label>
                                                        <select name="timeline" id="timeline" class="form-control">
                                                            <option value="0">Select...</option>
                                                            <option value="M">Monthly</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="category">Category</label>
                                                        <select name="category" id="search_category" class="form-control">
                                                            @php $categories = App\InventoryCategory::all(); @endphp
                                                            <option value="0">Select...</option>
                                                            @if($categories)
                                                                @foreach($categories as $category)
                                                                    <option value=" {{ $category->id }} "> {{ $category->inventory_category }} </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                                        <label for="">&nbsp;</label>
                                                        <button type="submit" id="search" class="btn btn-success btn-block btn-submit"><i class="fas fa-search-dollar"></i> Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                            {{-- Search form ends --}}
                                        </div>
                                    </div>
                                    {{-- Search results start --}}
                                    <div class="row mt-2">
                                        <div class="col">
                                                @if(session()->has('search_result') && session()->has('category'))
                                                    @php
                                                        $category = session()->get('category');
                                                        $find_category_name = App\InventoryCategory::find($category);
                                                        $category_name = $find_category_name->inventory_category;
                                                        $data = session()->get('search_result');
                                                        $total = 0;
                                                    @endphp
                                                    <table class="table">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">Category</th>
                                                                <th scope="col">Month</th>
                                                                <th scope="col">Expanse</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data as $item)
                                                                <tr>
                                                                    <td> {{ ucwords($category_name) }} </td>
                                                                    <td> {{ $item->month }}-{{ $item->year }} </td>
                                                                    <td> {{ $item->sum }} </td>
                                                                    @php $total += $item->sum;  @endphp
                                                                </tr>
                                                            @endforeach
                                                                <tr>
                                                                    <td colspan="2"><b>Total Expanse</b></td>
                                                                    <td> {{ $total }}</td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                @elseif(session()->has('search_result'))
                                                    @php
                                                        $data = session()->get('search_result');
                                                        $total = 0;
                                                    @endphp
                                                    <table class="table">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">Month</th>
                                                                <th scope="col">Expanse</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data as $item)
                                                                <tr>
                                                                    <td> {{ $item->month }}-{{ $item->year }} </td>
                                                                    <td> {{ $item->sum }} </td>
                                                                    @php $total += $item->sum;  @endphp
                                                                </tr>
                                                            @endforeach
                                                                <tr>
                                                                    <td> <b>Total Expanse</b> </td>
                                                                    <td> {{ $total }}</td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                        </div>
                                    </div>
                                    {{-- Search results end --}}
                                </div>

                                {{-- Insert new lot pan  --}}
                                <div class="tab-pane fade" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
                                    <h3 class="mt-2">Enter new Lot</h3>
                                    <div class="row">
                                        <div class="col">
                                            <form action="" method="post">
                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <label for="lot_title">Lot title</label>
                                                        <input type="text" name="lot_title" id="lot_title" class="form-control">
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="date">Date</label>
                                                        <input type="date" name="date" id="date" class="form-control">
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="category">Category</label>
                                                        <select name="category" id="category" class="form-control">
                                                            <option value="0">Select...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-3">
                                                        <label for="lot_condition">Lot condition</label>
                                                        <select name="lot_condition" id="lot_condition" class="form-control">
                                                            <option value="0">Select one</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lot_location">Lot location</label>
                                                        <input type="text" name="lot_location" id="lot_location" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <label for="pre_tax_amt">Pre-tax amount</label>
                                                        <input type="text" name="pre_tax_amt" id="pre_tax_amt" class="form-control">
                                                    </div>
                                                    <div class="col">
                                                        <label for="tax_name">Tax name</label>
                                                        <select name="tax_name" id="tax_name" class="form-control">
                                                            <option value="0">Select...</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="tax_amt">Tax amount</label>
                                                        <input type="text" name="tax_amt" id='tax_amt' class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- View Lot Listing --}}
                                <div class="tab-pane fade" id="nav-view" role="tabpanel" aria-labelledby="nav-view-tab">
                                    <div class="row mt-2">
                                    <div class="col text-center">
                                        <h3>Inventory items</h3>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        {{-- Inventory pan end --}}

                        {{-- Reports pan start --}}
                        <div class="tab-pane fade" id="v-pills-reports" role="tabpanel" aria-labelledby="v-pills-reports-tab">
                        </div>
                        {{-- Reports pan end --}}
                    </div>
                </div>
              </div>
        </div>
    </div>

@endsection

@section('footer_content')

<script type="text/javascript">

    $('.btn-submit').click(function(event){

        event.preventDefault();

        var time = $('#timeline').val();
        var category = $('#search_category').val();
        if(time == 0 && category == 0){
                alert('Select Minimum one filter to search');
            return false;
        }else{
            if(time == 0){
                alert('Time line is required');
                return false;
            }else{
                $("#search_result").submit();
            }
        }
    });

</script>

@endsection
