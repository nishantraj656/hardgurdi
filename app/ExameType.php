<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExameType extends Model
{
    protected $table = 'test_cat_tab'; 
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'test_cat_id',
         'cat_name'
    ];
}
