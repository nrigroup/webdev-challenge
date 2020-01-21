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
          $fileHandle = new FileHandle();
          $fileHandle =  FileHandlerService::handleFileRequest($request,$fileHandle);     
          FileHandleDaoImpl::persistData($fileHandle);
      }
}
