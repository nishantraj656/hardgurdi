<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'result_tab'; 
   

    public $fillable =[
       
         'test_info_id',
         'user_id',
         'stud_answer_json',
         'total_marks',
         'obtain_marks',
         'info'
         
    ];
}
