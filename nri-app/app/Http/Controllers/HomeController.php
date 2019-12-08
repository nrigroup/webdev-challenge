<?php

namespace App\Http\Controllers;

use Mockery\Exception;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        try {
            // render home.blade.php
            return view('home.home');

        } catch (Exception $ex) {
            abort(500); // Internal server error
        }
    }
}
