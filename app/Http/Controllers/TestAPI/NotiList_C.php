<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NotiList_C extends Controller
{
    
    public $successStatus = 200;

    public function NotiList(Request $request){
        // $userID = $request->json()->all()['userID'];
        $data = DB::table('noti_tab')
                  ->select(
                    'noti_tab_id as test_info_id',
                    'title as title',
                    'message as content',
                    'media as media',
                    'created_at as date'
                  )
                  // ->where('package_id', '=', $subcatID)
                  // ->whereRaw('DATE(expDate) > CURRENT_TIMESTAMP')
                  ->orderBy('updated_at', 'DESC')
                  ->get();



        return response()->json(['received'=>'yes','data'=>$data],$this->successStatus);
    }
}
