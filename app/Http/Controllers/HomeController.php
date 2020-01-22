<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Controller gets called at the begining of the server run */
class HomeController extends Controller
{
    /* function retuens the home view */
    public function index()
    {
      return view('home');
    }
}
