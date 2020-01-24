<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $id = '';
    public function index()
    {
        return view('index');
    }

}
