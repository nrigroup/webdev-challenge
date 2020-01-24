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
        <h2>NRI</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Systems</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>NRI</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>NRI System.</h5>
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
                    Welcome to NRI System. Please select an item on the menu beside.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
	@parent

@endsection
