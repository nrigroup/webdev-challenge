<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller {

    public function getIndex(){
        return view( 'admin.layout' );
    }

    public function getUpload(){
        return view( 'admin.uploadform' );
    }

}
