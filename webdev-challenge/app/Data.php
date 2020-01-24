<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Data extends Model
{
    public static function insertData($data){

        //Assuming all data insert are valid and not empty
        DB::table('data')->insert($data);

    }
}
