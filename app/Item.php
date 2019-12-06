<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    public static function insertData($data) {
        $value=DB::table('items')->where('lot_title', $data['lot_title'])->get();
        if($value->count() == 0) {
            DB::table('items')->insert($data);
        }
    }
}
