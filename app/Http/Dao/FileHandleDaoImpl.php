<?php

namespace App\Http\Dao;
use App\Http\Models\FileHandle;
use Illuminate\Support\Facades\DB;

abstract class FileHandleDaoImpl
{
   public static function persistData(FileHandle $fileHandle)
   {
         $data = $fileHandle -> data;
          
         for($x = 0;$x<count($data);$x++)
         {
             $fileRow = $data[$x];
             $fileRowData = $fileRow -> row;

             createCategories($fileRowData);

             createLocation($fileRowData);

             createLot($fileRowData);

             createLotCondition($fileRowData);

             createTaxType($fileRowData);

             createSale($fileRowData);
         }

   }
   
   public static function createCategories(Array $fileRowData)
   {

   }

   public static function createLocation(Array $fileRowData)
   {
       
   }

   public static function createLot(Array $fileRowData)
   {

   }

   public static function createLotCondition(Array $fileRowData)
   {

   }

   public static function createTaxType(Array $fileRowData)
   {

   }

   public static function createSale(Array $fileRowData)
   {

   }
}