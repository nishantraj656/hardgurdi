<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

    

class Testing extends Controller
{
	public $successStatus = 200;
    function testing()
    {
    	 
		// Get the image and convert into string 
		$img = file_get_contents(
			'http://localhost/laravel/HardiGurdi/HD/public/storage/Set/PC6m6P1C4gEX5rupdZPyrnddZm6k9IHZZeE7pSVS.jpeg'); 
		  
		// Encode the image string data into base64 
		$data = base64_encode($img); 
		  
		// Display the output 
		echo $data; 
	}
	
	function testDataRaw(){

		$userID = 676;

		$data = DB::table('purchased_test_tab')
                  ->join('test_info_tab', 'test_info_tab.test_info_id', '=', 'purchased_test_tab.test_info_id')
                  ->select(
                    'test_info_tab.test_info_id as test_info_id',
                    'test_name as name',
                    'pic as avtar_url',
                    'time as minutes',
                    'test_price as rate',
                    'status',
                    'parent_test_info_id as parent_id',
                    'issectional',
                    
                    DB::raw('(SELECT COUNT(*) FROM `question_tab` WHERE test_info_id = test_info_tab.parent_test_info_id and question_tab.section_id = issectional) as noofquestion'),
                    DB::raw('
                      (
                        SELECT COUNT(*) > 0 FROM `purchased_test_tab` 
                        WHERE( 
                          (user_id = '.$userID.') and 
                          (given_status = 0) and 
                          (test_info_id = test_info_tab.test_info_id)
                        )
                      ) as isPurchased'
                    ) 
                  )
                  ->where('given_status', '=', '0')
                  ->where('user_id', '=', $userID)

                  ->where('issectional', '!=', '-1')
                  
                  // ->whereRaw('DATE(expDate) > CURRENT_TIMESTAMP')
                  ->orderBy('purchased_test_tab.test_info_id', 'ASC')
				  ->get();
				  


		dd($data);

	}
}
