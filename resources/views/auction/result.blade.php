@extends('layouts.main')

@section('title', 'Plataforma Tecza | Home')

@section('css')
    @parent

    <!-- orris -->
    <link href="{{asset('inspinia/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">

@endsection

@section('title_lane')



@endsection

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>CSV Imported</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Auction</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>CSV Imported</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="{{route('auction_index')}}" class="btn btn-primary">Back to upload area</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Bar Chart per-month </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="month"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Bar Chart per-category </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="category"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    @parent

    <script>

        $(function() {

            Morris.Bar({
                element: 'month',
                data: [
                    @foreach($all_auctions->groupBy('month_year') as $month_year => $auction_collection)
                        { y: '{{$month_year}}', a: {{$auction_collection->sum('pre_tax_amount')}}, b: {{$auction_collection->sum('tax_amount')}} },
                    @endforeach
                ],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Pre-tax Amount', 'Tax Amount'],
                hideHover: 'auto',
                resize: true,
                barColors: ['#1ab394', '#cacaca'],
            });

            Morris.Bar({
                element: 'category',
                data: [
                    @foreach($all_auctions->groupBy('category') as $category => $auction_collection)
                        { y: '{{$category}}'.replace(/&amp;/g, '&'), a: {{$auction_collection->sum('pre_tax_amount')}}, b: {{$auction_collection->sum('tax_amount')}} },
                    @endforeach
                ],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Pre-tax Amouunt', 'Tax Amount'],
                hideHover: 'auto',
                resize: true,
                barColors: ['#1ab394', '#cacaca'],
            });

        });


    </script>

@endsection
