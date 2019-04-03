<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class upcomingTest_C extends Controller
{

    public $successStatus = 200;

    public function upcomingTestList(Request $request){

        $data = DB::table('test_info_tab')
                  ->select(
                    'test_info_id as test_info_id',
                    'test_name as name',
                    'pic as avtar_url',
                    'time as minutes',
                    'test_price as rate',
                    'status',
                    'parent_test_info_id as parent_id',
                    'issectional',

                    DB::raw('(SELECT COUNT(*) FROM `question_tab` WHERE test_info_id = test_info_tab.test_info_id) as noofquestion')
                  )
                  ->where('status', '=', '0')
                  ->orderBy('test_info_id', 'DESC')
                  ->get();
        return response()->json(['received'=>'yes','data'=>$data],$this->successStatus);

    }
}