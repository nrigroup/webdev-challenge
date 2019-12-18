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

        .error, .processing, #button-spinner {
            display: none;
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
                        Browse File <input type="file" style="display: none;" multiple>
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
    </form>
@stop