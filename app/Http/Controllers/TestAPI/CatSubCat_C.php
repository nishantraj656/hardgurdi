<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CatSubCat_C extends Controller
{
    public $successStatus = 200;


    public function index(Request $request) 
    {
    	$category_list = DB::table('test_cat_tab')
            ->select('cat_name','test_cat_id')
            ->get();

        $cat_sub_cat_arr_final = [];
        foreach ($category_list as $key => $value) {
            $subcategory_list = DB::table('package_tab')
                ->select('package_id','subcat_name')
                ->where('test_cat_id',$value->test_cat_id)
                ->get();

            $intermediateArr = [];
            $subcategory_arr = [];
            foreach ($subcategory_list as $key => $subcategory) {
                $tmp = [];
                $tmp["key"] = $subcategory->package_id;
                $tmp["value"] = $subcategory->subcat_name;
                array_push($subcategory_arr, $tmp);
            }
            
            $intermediateArr["category"] = $value->cat_name;
            $intermediateArr["subcategory"] = $subcategory_arr;
            array_push($cat_sub_cat_arr_final, $intermediateArr);
        }


      	return response()->json(['received'=>'yes','data'=>$cat_sub_cat_arr_final],$this->successStatus);
    }
    
}
