<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table="noti_tab";
    public $fillable =[ 
                         'noti_tab_id',
                         'title',
                         'message',
                         'media',
                        ];
}
