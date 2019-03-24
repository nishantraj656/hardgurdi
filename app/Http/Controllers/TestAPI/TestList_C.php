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
        

				// {
    //               "info_id":"1",
    //               "avtar_url":"https://instagram.fpat1-1.fna.fbcdn.net/vp/84c4e443d47dc2aa70a613a017a4c001/5CBB0AAC/t51.2885-19/s150x150/31908285_2109461939310314_4190149362170462208_n.jpg?_nc_ht=instagram.fpat1-1.fna.fbcdn.net",
    //               "name":"Test 1",
    //               "minutes":"50",
    //               "":"1500",
    //               "":"0"
    //             },




        $data = DB::table('test_info_tab')
                  ->select(
                    'test_info_id as info_id',
                    'test_name as name',
                    'pic as avtar_url',
                    'time_duration as minutes',
                    'test_price as rate',
                    DB::raw('COUNT(*) FROM `question_tab` WHERE test_info_id = info_id as noofquestion')
                  )
                  ->where('package_id', '=', $subcatID)
                  ->get();


        return response()->json(['received'=>'yes','data'=>$data,'return_test'=>$subcatID],$this->successStatus);
    }
}
