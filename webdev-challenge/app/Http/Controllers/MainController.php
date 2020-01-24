<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $id = '';
    public function index()
    {
        $table_content = Table::fetchData();
        return view('index')->with('content',$table_content);
    }

}
