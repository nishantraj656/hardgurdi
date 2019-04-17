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
            ->select('cat_name','test_cat_id','pic')
            ->get();

        $cat_sub_cat_arr_final = [];
        foreach ($category_list as $key => $value) {
            $subcategory_list = DB::table('package_tab')
                ->select(
                    'package_id',
                    'subcat_name',
                    'status',
                    'package_price',
                    //ispacksec returns 1 if sectioanl otherwise 0 
                    DB::raw('
                        (
                            SELECT (count(*) = 0) as ispacksec FROM `test_info_tab` WHERE package_id = package_tab.package_id and issectional = -1   
                        )as ispacksec'
                    )
                )
                ->where('test_cat_id',$value->test_cat_id)
                ->get();

            $intermediateArr = [];
            $subcategory_arr = [];
            foreach ($subcategory_list as $key => $subcategory) {
                $tmp = [];
                $tmp["key"] = $subcategory->package_id;
                $tmp["value"] = $subcategory->subcat_name;
                $tmp["status"] = $subcategory->status;
                $tmp["rate"] = $subcategory->package_price;
                $tmp["ispacksec"] = $subcategory->ispacksec;
                array_push($subcategory_arr, $tmp);
            }
            
            $intermediateArr["category"] = $value->cat_name;
			$intermediateArr["pic"] = $value->pic;
            $intermediateArr["subcategory"] = $subcategory_arr;
            array_push($cat_sub_cat_arr_final, $intermediateArr);
        }


      	return response()->json(['received'=>'yes','data'=>$cat_sub_cat_arr_final],$this->successStatus);
    }
	
	public function imageGet()
	{
		$imagePath = array();
		$imagePath = array_push('http://hardigurdi.com/images/phones/iphone-banner.png');
		$imagePath = array_push('https://akm-img-a-in.tosshub.com/indiatoday/images/story/201809/Online-exam-647.jpeg?of2m36jHA8vcOKmUZ1YB7DHl_ypIoLIj');
		$imagePath = array_push('https://jobapply.org.in/wp-content/uploads/2018/07/Exposure-is-king-777x437.jpg');
		$imagePath = array_push('http://hardigurdi.com/images/icon.png');
		$imagePath = array_push('http://hardigurdi.com/images/backgrounds/promo-video-bg.jpeg');
		$imagePath = array_push('http://hardigurdi.com/images/phones/rrb.jpg');
	return response()->json(['received'=>'yes','data'=>$imagePath],$this->successStatus);
	return response()->json(['received'=>'yes','data'=>$imagePath],$this->successStatus);
	}
    
}
