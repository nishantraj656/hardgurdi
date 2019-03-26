<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestList_C extends Controller
{

    public $successStatus = 200;

    public function TestList(Request $request){
        $subcatID = $request->json()->all()['subcategoryID'];
    	// $subcatID = 5;

        $data = DB::table('test_info_tab')
                  ->select(
                    'test_info_id as test_info_id',
                    'test_name as name',
                    'pic as avtar_url',
                    'time_duration as minutes',
                    'test_price as rate',
                    'status',
                    DB::raw('(SELECT COUNT(*) FROM `question_tab` WHERE test_info_id = test_info_tab.test_info_id) as noofquestion')
                  )
                  ->where('package_id', '=', $subcatID)
                  ->orderBy('test_name', 'ASC')
                  ->get();


        return response()->json(['received'=>'yes','data'=>$data,'return_test'=>$subcatID],$this->successStatus);
    }
}
