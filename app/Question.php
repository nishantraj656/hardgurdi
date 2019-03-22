<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question_tab'; 
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   public $fillable = 
   [
    'question_id',
     'test_info_id',
      'section_id',
      'question_json', 
      'option_json', 
      'answer_json', 
      'explaination',
   ];
}
 