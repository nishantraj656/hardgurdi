<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestDetails_C extends Controller
{
    public $successStatus = 200;
	
   

// `test_info_id`,done
// `test_name`, done
// `test_price`, done
// `status`, done
// `pic`, done
// `time_duration`, done
// no of question 

// `package_id`, 


// `marks_on_correct`, 
// `marks_on_incorrect`, 
// `descrption`, 
// `enroll_stud_count`, 
// `expDate`, 
// `created_at`, 
// `updated_at`


    //             NegativeMarking:'+2',
    //             PositiveMarking:'-0.5',

    public function TestDetails(Request $request){
        // $testID = $request->json()->all()['testID'];
    	$testID = 9;

        $data = DB::table('test_info_tab')
                  ->select(
                    'descrption as descrption',
                    // 'enroll_stud_count as enroll_stud_count',
                    'marks_on_correct as PositiveMarking',
                    'marks_on_incorrect as NegativeMarking',
                    'expDate as expDate',
                    'parent_test_info_id as parent_id',
                    
                    'created_at as created_at'
                  )
                  ->where('test_info_id', '=', $testID)
                  ->get();

        $newData = $data[0]; //for one index value
        return response()->json(['received'=>'yes','data'=>$newData,'return_test'=>$testID],$this->successStatus);
    }


}
