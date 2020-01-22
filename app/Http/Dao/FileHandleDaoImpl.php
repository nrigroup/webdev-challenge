<?php

namespace App\Http\Dao;
use App\Http\Models\FileHandle;
use Illuminate\Support\Facades\DB;

/* Data Access Object class used to store,update and retrieve the data from database */
abstract class FileHandleDaoImpl
{
   /* Declare constants */
   const CATEGORY = "category";
   const LOT_TITLE = "lot title";
   const LOT_LOCATION = "lot location";
   const LOT_CONDITION = "lot condition";
   const PRE_TAX_AMOUNT = "pre-tax amount";
   const TAX_TYPE = "tax name";
   const TAX_AMOUNT = "tax amount"; 
   const DATE = "date";

   /* function used to persist the .csv data into the database */
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
   
   /* Inserts the categories records in the database */
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
 /* Inserts the location records in the database */
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

   /* Inserts the lot records in the database */
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

   /* Inserts the lot condition records in the database */
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
 /* Inserts the tax type records in the database */
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

   /* Inserts the sale records in the database */
   public static function createSale(Array $fileRowData)
   {
        $category_id; $location_id;$lot_id;$condition_id;$tax_type_id;$date;$pre_tax_amount;$tax_amount;
        foreach($fileRowData as $header => $value)
        {
             switch($header)
             {
                  case FileHandleDaoImpl::CATEGORY:
                     $result = DB::select("SELECT category_id FROM categories WHERE category_name=?",[$value]);
                     $category_id = $result[0] -> category_id;
                  break;
                  case FileHandleDaoImpl::LOT_LOCATION:
                     $result = DB::select("SELECT location_id FROM location WHERE location_name=?",[$value]);
                     $location_id = $result[0] -> location_id;
                  break;
                  case FileHandleDaoImpl::LOT_TITLE:
                     $result = DB::select("SELECT lot_id FROM lot WHERE lot_title=?",[$value]);
                     $lot_id =  $result[0] -> lot_id;
                  break;
                  case FileHandleDaoImpl::LOT_CONDITION:
                     $result = DB::select("SELECT condition_id FROM lot_condition WHERE condition_name=?",[$value]);
                     $condition_id =  $result[0] -> condition_id;
                  break;
                  case FileHandleDaoImpl::TAX_TYPE:
                     $result = DB::select("SELECT tax_type_id FROM tax_type WHERE tax_name=?",[$value]);
                     $tax_type_id =  $result[0] -> tax_type_id;
                  break;
                  case FileHandleDaoImpl::PRE_TAX_AMOUNT:
                     $pre_tax_amount = $value;
                  break;
                  case FileHandleDaoImpl::TAX_AMOUNT:
                     $tax_amount = $value;
                  break;
                  case FileHandleDaoImpl::DATE:
                     $date = $value;
                  break;
                  
             }
             
        }
       $result = DB::insert("INSERT INTO sale values (DEFAULT,?,?,?,?,?,?,?,?)",[date ("Y-m-d H:i:s", strtotime($date)),$pre_tax_amount,$tax_amount,$category_id,$location_id,$tax_type_id,$lot_id,$condition_id]);
    }

    /* retrieves result from the database */
    public static function getResults()
    {
        $result = DB::select('
                select c.category_name "category_name", sum(s.pre_tax_amount+s.tax_amount) "expense",monthname(s.sale_date) "month",YEAR(s.sale_date) "year"
                from sale s ,categories c 
                where s.category_id = c.category_id
                group by c.category_name,YEAR(s.sale_date), MONTH(s.sale_date)
                order by YEAR(s.sale_date) desc, month(s.sale_date)
        ');
        return $result;
    } 
}