<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HistoryList_C extends Controller
{
    
    public $successStatus = 200;

    public function HistList(Request $request){
        $userID = $request->userID;
        // $userID = 139;
    	// $subcatID = 5;

        $data = DB::table('result_tab')
        		  ->join('test_info_tab', 'test_info_tab.test_info_id', '=', 'result_tab.test_info_id')
                  ->select(
                    'result_tab.result_id as result_id',
                    'test_name as name',
                    'pic as avtar_url',
                    'time as minutes',
                    'total_marks',
                    'obtain_marks',
                    'result_tab.created_at'
                  )
                  ->where('user_id', '=', $userID)
                  // ->whereRaw('DATE(expDate) > CURRENT_TIMESTAMP')
                  ->orderBy('result_tab.created_at', 'DESC')
                  ->get();



        return response()->json(['received'=>'yes','data'=>$data,'return'=>$userID],$this->successStatus);
    }
}
