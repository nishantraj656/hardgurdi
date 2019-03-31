<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmitFeedback extends Model
{
	protected $table = 'feedback_tab'; 
	
    public $fillable=[	    	
		'feedback_id',
		'name',
		'email',
		'message'
    ];
}
