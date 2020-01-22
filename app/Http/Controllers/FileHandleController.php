<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\FileHandlerService;
use App\Http\Models\FileHandle;
use App\Http\Dao\FileHandleDaoImpl;

/* This class handles the upload of file, save it to database, and returns the result back to the view */
class FileHandleController extends Controller
{
      /* This function gets called after submitting the uploaded file */
      public function handleFile(Request $request)
      {
          /* creating new instance */
          $fileHandle = new FileHandle();
          /* populating the instance with csv data */
          $fileHandle =  FileHandlerService::handleFileRequest($request,$fileHandle);     
          /* saving the data into the database */
          FileHandleDaoImpl::persistData($fileHandle);
          /* return the results */
          $results = FileHandleDaoImpl::getResults();
          /* return the view results */
          return view('results',['results'=>$results]);
      }
}
