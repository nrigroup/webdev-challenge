@extends('layout')

@section('content')
    <!-- page style -->
    <style>
        .title {
            font-size: 32px;
            padding-top: 10px;
            margin-bottom: -20px;
            color: #000;
        }

        .form {
            padding: 20px;
            margin-top: 10px;
        }

        .browse-button {
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .error, .processing, #button-spinner, #months-header, #categories-header, #data-months, #data-categories {
            display: none;
        }

        #months-header, #categories-header {
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
    <!-- header -->
    <h2 class="title">Import Dataset</h2>

    <!-- span -->
    <span>SELECT A CSV DATAFILE TO IMPORT</span>
    
    <!-- upload form -->
    <form class="form">
        <div class="alert alert-danger error">
            Invalid or unknown data file, please select a valid .csv file.
        </div>
        <div class="alert alert-success processing">
            The file was successfully uploaded. Wait until we finish processing the file.
        </div>
        <div class="form-group">
            <!-- input group for file -->
            <div class="input-group">
                <label class="input-group-btn">
                    <!-- label for file -->
                    <span class="btn btn-primary browse-button">
                        Browse File <input id="file" type="file" style="display: none;">
                    </span>
                </label>
                <!-- input text -->
                <input type="text" class="form-control" autocomplete="off" readonly>
            </div>
        </div>
        <!-- submit button -->
        <button id="submit-button" type="button" class="btn btn-primary disabled">
            <!-- span -->
            <span id="button-label">UPLOAD</span>

            <!-- spinner -->
            <div id="button-spinner" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </button>
        <!-- months table -->
        <h2 id="months-header" class="title">TOTAL PER MONTH</h2>
        <div id="data-months">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Year</th>
                    <th scope="col">Month</th>
                    <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody id="data-months-content">
                </tbody>
            </table>
        </div>
        <!-- categories table -->
        <h2 id="categories-header" class="title">TOTAL PER CATEGORY</h2>
        <div id="data-categories">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Category</th>
                    <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody id="data-categories-content">
                </tbody>
            </table>
        </div>
        <!-- clear -->
        <br clear="all" />
    </form>
@stop