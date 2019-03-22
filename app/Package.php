<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package_tab'; 
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   public $fillable = 
   [
        'package_id',
        'test_cat_id',
        'subcat_name',
        'package_price'
   ];
}
