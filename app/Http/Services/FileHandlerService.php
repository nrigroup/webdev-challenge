<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Http\Models\FileHandle;

/* Servcie class used to perform file storing operations into fileHandle Object */
abstract class FileHandlerService{

   /* function used to handle the file upload and push the contents of .csv file into the fileHandle object */
   public static function handleFileRequest(Request $request,FileHandle $fileHandle)
   {
       $file = $request -> file('file');
       $csvAsArr = array_map('str_getcsv', file($file));
       
       /* set the headers to the fileHandle object */   
       FileHandlerService::setHeaders($csvAsArr,$fileHandle);
       /* set the data of .csv into the fileHandle object */
       FileHandlerService::setDataInObject($csvAsArr,$fileHandle);
       
       return $fileHandle;   
    }

     /* function sets the data of .csv into the fileHandle object */
    public static function setDataInObject(Array $csvAsArr,FileHandle $fileHandle)
    {
        $rows = count($csvAsArr);
        $cols = count($csvAsArr[0]);
        
        $data = array();
        $temp_data = array();
        $headers = $fileHandle -> headers;

        for($row = 1;$row < $rows;$row++ )
        {
            for($col = 0;$col < $cols;$col++ )
            {
                $temp_data[$headers[$col]] = $csvAsArr[$row][$col];
            }
            $fileHandleRow = new FileHandle();
            $fileHandleRow ->  row = $temp_data;
            array_push($data,$fileHandleRow);
        }

        $fileHandle -> data = $data;
    }

    /* function set the headers to the fileHandle object */   
    public static function setHeaders(Array $csvAsArr,FileHandle $fileHandle)
    {

        $headers = array();

        $rows = count($csvAsArr);
        $cols = count($csvAsArr[0]);
        
        for($row = 0;$row < 1;$row++ )
        {
            for($col = 0;$col < $cols;$col++ )
            {
                $headers[$col] = $csvAsArr[$row][$col];
            }
        }
        // setting the headers to the object 
        $fileHandle -> headers = $headers;
    }

}