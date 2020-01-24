@extends('app')

@section('title', 'Import CSV File Data to MySQL')

@section('content')

<h1>Welcome to Oluwaseyi's completion of the NRI Webdev Challenge</h1>
    <h4>Please select a csv file with the following columns in the order below to upload to our database</h3>
    <ol>
        <li>date</li>
        <li>category</li>
        <li>lot title</li>
        <li>lot location</li>
        <li>lot condition</li>
        <li>pre-tax amount</li>
        <li>tax name</li>
        <li>tax amount</li>
    </ol>
     

     <!-- Form -->
     <form method='post' action='/uploadFile' enctype='multipart/form-data' >
       {{ csrf_field() }}
       <input type='file' name='file' >
       <input type='submit' name='submit' value='Upload'>
     </form>

@endsection
