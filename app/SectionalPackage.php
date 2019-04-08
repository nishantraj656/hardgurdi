<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionalPackage extends Model
{
    protected $table = 'test_info_tab'; 

    public $fillable=[
      'test_info_id',
      'parent_test_info_id', 
      'package_id', 
      'test_name',
      'descrption',
      'pic', 
      'test_price', 
      'marks_on_correct', 
      'marks_on_incorrect', 
      'status', 
      'time',
      'expDate',
      'issectional'
    ];


}
