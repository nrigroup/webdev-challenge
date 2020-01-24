@extends('layouts.main')

@section('title', 'Plataforma Tecza | Home')

@section('css')
	@parent

@endsection

@section('title_lane')



@endsection

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Import CSV</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Auction</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Import CSV</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="" class="btn btn-primary">This is action area</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Please send the auction file <small>It MUST be in .csv format.</small></h5>
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
                    <form method="post" action="{{route('auction_import_csv')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file">
                            <input id="logo" type="file" name='auction_data' class="custom-file-input">
                            <label for="logo" class="custom-file-label">Choose file...</label>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary btn-sm" type="submit">Upload file</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
	@parent

@endsection
