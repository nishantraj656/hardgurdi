<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionalPackage extends Model
{
    public $fillable=[
    'section_info_id',
     'test_info_id', 
     'package_id', 
     'section_id',
     'name',
      'descrption',
       'pic', 
       'price', 
       'marks_on_correct', 
       'marks_on_incorrect', 
       'status', 
       'time',
        'expDate'];
}
