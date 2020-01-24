<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dataset Import</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
      <a class="navbar-brand" href="/"><img class="nav-pic" src="https://www.nriparts.com/assets/images/logo.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ml-auto">
          <input class="form-control search pl-5" type="search" placeholder="Search Part Number" aria-label="Search">
          <span class="search-icon"><i class="fas fa-search"></i></span>
          <button class="btn btn-primary search my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="ml-2 ml-xl-5">
          <i class="fas fa-phone-alt"></i> 1-888-995-9813
        </div>
        <div class="ml-2 ml-xl-5">
          <i class="fas fa-shopping-cart"></i>
          <span id="num-in-cart" class="px-2">0</span>
        </div>
        <div class="ml-2">
          <i class="fas fa-sign-in-alt"></i> Login
        </div>
      </div>
    </nav>
