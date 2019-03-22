<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'test_info_id',
         'package_id',
          'test_name',
          'descrption',
          'pic',
          'enroll_stud_count',
          'test_price',
          'marks_on_correct',
          'marks_on_incorrect'
    ];
}
