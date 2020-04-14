<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data_Items extends Model
{
    //csv model 
    Protected $fillable  = ['First_name','last_name','Address','Province' ];

}
