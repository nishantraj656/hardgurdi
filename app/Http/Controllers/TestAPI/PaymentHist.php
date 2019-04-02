<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class PaymentHist extends Controller
{
    public $successStatus = 200;
	function getPayHist(Request $request)
	{
		$user_id = $request->user_id;
		// $user_id = 138;
		

    $data = DB::table('payment_tab')
				// ->join('test_info_tab', 'test_info_tab.test_info_id', '=', 'payment_tab.product_id')
				// ->join('package_tab', 'package_tab.package_id', '=', 'payment_tab.product_id')
				->select(
                    'transaction_id as trans_id',
                    'payment_status as status',
                    'payment_tab.amount as amount',
                    'payment_tab.created_at as date',
                    'payment_tab.product_id as product_id',
                    DB::raw('(
                        SELECT test_name FROM `test_info_tab` WHERE test_info_id = payment_tab.product_id 
                      ) as test_name'),
                    DB::raw('(
                        SELECT subcat_name FROM `package_tab` WHERE package_id = payment_tab.product_id 
                      ) as package_name')
                  )
                  ->where('payment_tab.user_id', '=', $user_id)
                  // ->whereRaw('DATE(expDate) > CURRENT_TIMESTAMP')
                  ->orderBy('payment_tab.updated_at', 'DESC')
                  ->get();



        return response()->json(['received'=>'yes','data'=>$data,'return'=>$user_id],$this->successStatus);
	}
}
