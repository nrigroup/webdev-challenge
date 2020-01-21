<?php 

namespace App\Http\Models;

class FileHandle{

   private $headers;
   private $data;
   private $row;

   public function __get($property){
       if(property_exists($this,$property))
       {
           return $this -> $property;
       }
   }

   public function __set($property,$value)
   {
      if(property_exists($this,$property))
      {
         $this -> $property = $value;
      }
      return $this;
   }

}