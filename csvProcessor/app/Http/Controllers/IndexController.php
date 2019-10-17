<?php

namespace App\Http\Controllers;

use App\ItemDetails;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $details = ItemDetails::all();
        return view('welcome', ['data' => $details,]);
    }
}
