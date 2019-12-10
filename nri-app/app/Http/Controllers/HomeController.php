<?php

namespace App\Http\Controllers;

use Mockery\Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        try {
            // Data to inject into blade template
            $data = ['errorMessage' => ''];

            // render home page blade template
            return view('home.home', $data);

        } catch (Exception $ex) {
            abort(500); // Internal server error
        }
    }
}
