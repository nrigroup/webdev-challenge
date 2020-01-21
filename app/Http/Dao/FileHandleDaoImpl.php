<?php

namespace App\Http\Dao;
use App\Http\Models\FileHandle;
use Illuminate\Support\Facades\DB;

abstract class FileHandleDaoImpl
{

   const CATEGORY = "category";
   const LOT_TITLE = "lot title";
   const LOT_LOCATION = "lot location";
   const LOT_CONDITION = "lot condition";
   const PRE_TAX_AMOUNT = "pre-tax amount";
   const TAX_TYPE = "tax name";
   const TAX_AMOUNT = "tax amount"; 

   public static function persistData(FileHandle $fileHandle)
   {
         $data = $fileHandle -> data;
          
         for($x = 0;$x<count($data);$x++)
         {
             $fileRow = $data[$x];
             $fileRowData = $fileRow -> row;

             FileHandleDaoImpl::createCategories($fileRowData);

             FileHandleDaoImpl::createLocation($fileRowData);

             FileHandleDaoImpl::createLot($fileRowData);

             FileHandleDaoImpl::createLotCondition($fileRowData);

             FileHandleDaoImpl::createTaxType($fileRowData);

             FileHandleDaoImpl::createSale($fileRowData); 
         }

   }
   
   public static function createCategories(Array $fileRowData)
   {
       foreach($fileRowData as $header => $value)
       {
           if($header == FileHandleDaoImpl::CATEGORY)
           {
              $result = DB::select("SELECT 1 FROM CATEGORIES WHERE CATEGORY_NAME=?",[$value]);

              if(count($result) <= 0)
              {
                   DB::insert("INSERT INTO CATEGORIES VALUES (DEFAULT,?) ",[$value]);
              }
              break; 
           }
       }
   }

   public static function createLocation(Array $fileRowData)
   {
        foreach($fileRowData as $header => $value)
        {
            if($header == FileHandleDaoImpl::LOT_LOCATION)
            {
                 $result = DB::table('location')
                             ->where('location_name', '=', $value)
                             ->first();
                if(is_null($result))
                {
                    DB::insert("INSERT INTO location VALUES (DEFAULT,?) ",[$value]);
                }
                break; 
            }
        }
   }

   public static function createLot(Array $fileRowData)
   {
        foreach($fileRowData as $header => $value)
        {
            if($header == FileHandleDaoImpl::LOT_TITLE)
            {
                $value = utf8_encode($value);
                $result = DB::select("SELECT 1 FROM lot WHERE lot_title= ? ",[$value]);
                
                if(count($result) <= 0)
                {
                        DB::insert("INSERT INTO lot VALUES (DEFAULT,?) ",[$value]);
                }
                break; 
            }
        }
   }

   public static function createLotCondition(Array $fileRowData)
   {
        foreach($fileRowData as $header => $value)
        {
            if($header == FileHandleDaoImpl::LOT_CONDITION)
            {
                $result = DB::select("SELECT 1 FROM lot_condition WHERE condition_name=?",[$value]);

                if(count($result) <= 0)
                {
                        DB::insert("INSERT INTO lot_condition VALUES (DEFAULT,?) ",[$value]);
                }
                break; 
            }
        }
   }

   public static function createTaxType(Array $fileRowData)
   { 
        foreach($fileRowData as $header => $value)
        {
            if($header == FileHandleDaoImpl::TAX_TYPE)
            {
                $result = DB::select("SELECT 1 FROM tax_type WHERE tax_name=?",[$value]);

                if(count($result) <= 0)
                {
                        DB::insert("INSERT INTO tax_type VALUES (DEFAULT,?) ",[$value]);
                }
                break; 
            }
        }
   }

   public static function createSale(Array $fileRowData)
   {

   }
}