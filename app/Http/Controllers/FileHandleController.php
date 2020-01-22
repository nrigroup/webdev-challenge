<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\FileHandlerService;
use App\Http\Models\FileHandle;
use App\Http\Dao\FileHandleDaoImpl;

class FileHandleController extends Controller
{
      public function handleFile(Request $request)
      {
          
          /* creating new instnce */
      //    $fileHandle = new FileHandle();
          /* populating the instance with csv data */
      //    $fileHandle =  FileHandlerService::handleFileRequest($request,$fileHandle);     
          /* saving the data into the database */
       //   FileHandleDaoImpl::persistData($fileHandle);
          
          /* return the results */
          $results = FileHandleDaoImpl::getResults();
      
          return view('results',['results'=>$results]);
      }
}
