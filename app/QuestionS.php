<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionS extends Model
{
    protected $table = 'test_info_tab'; 
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
//    public $fillable = 
//    [
//         'test_info_id',      
//         'package_id',
//         'test_name',
//         'descrption',
//         'pic',
//         'enroll_stud_count',
//         'test_price',
//         'marks_on_correct',
//         'marks_on_incorrect',
//    ];

   public $fillable =[
        'test_info_id',
    'package_id',
     'test_name',
      'descrption', 
      'pic', 
      'enroll_stud_count',
       'test_price',
        'marks_on_correct', 
        'marks_on_incorrect',
        'status',
        'expDate',
   ];
}
 