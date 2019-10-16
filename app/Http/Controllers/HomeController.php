<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Landing page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }
}
