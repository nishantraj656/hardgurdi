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
        $userID = $request->json()->all()['userID'];
        $sendSectional = $request->json()->all()['sendSectional'];
    	// $subcatID = 5;
        if ($sendSectional != 'true') {// not sectional  
          $comp = '=';
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

                    DB::raw('(SELECT COUNT(*) FROM `question_tab` WHERE test_info_id = test_info_tab.test_info_id) as noofquestion'),
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

                  ->where('package_id', '=', $subcatID)
                  ->where('issectional', $comp, '-1')
                  
                  // ->whereRaw('DATE(expDate) > CURRENT_TIMESTAMP')
                  ->orderBy('slno', 'ASC')
                  ->get();
          
        }else{// sectinal test
          $comp = '!=';
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

                    DB::raw('(SELECT COUNT(*) FROM `question_tab` WHERE test_info_id = test_info_tab.parent_test_info_id and section_id = issectional) as noofquestion'),
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

                  ->where('package_id', '=', $subcatID)
                  ->where('issectional', $comp, '-1')
                  
                  // ->whereRaw('DATE(expDate) > CURRENT_TIMESTAMP')
                  ->orderBy('slno', 'ASC')
                  ->get();
        }

        // $data = DB::table('test_info_tab')
        //           ->select(
        //             'test_info_id as test_info_id',
        //             'test_name as name',
        //             'pic as avtar_url',
        //             'time as minutes',
        //             'test_price as rate',
        //             'status',
        //             'parent_test_info_id as parent_id',
        //             'issectional',

        //             DB::raw('(SELECT COUNT(*) FROM `question_tab` WHERE test_info_id = test_info_tab.test_info_id) as noofquestion'),
        //             DB::raw('
        //               (
        //                 SELECT COUNT(*) > 0 FROM `purchased_test_tab` 
        //                 WHERE( 
        //                   (user_id = '.$userID.') and 
        //                   (given_status = 0) and 
        //                   (test_info_id = test_info_tab.test_info_id)
        //                 )
        //               ) as isPurchased'
        //             ) 
        //           )

        //           ->where('package_id', '=', $subcatID)
        //           ->where('issectional', $comp, '-1')
                  
        //           // ->whereRaw('DATE(expDate) > CURRENT_TIMESTAMP')
        //           ->orderBy('slno', 'ASC')
        //           ->get();

        return response()->json(['received'=>'yes','data'=>$data,'return_test'=>$subcatID],$this->successStatus);
    }
    function purchasedTestList(Request $request)
    {

        $userID = $request->json()->all()['userID'];
        $sendSectional = $request->json()->all()['sendSectional'];

        $data = [];
        if ($sendSectional != 'true') {
          
          //Not sectinal full lentgh test send
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
                    
                    DB::raw('(SELECT COUNT(*) FROM `question_tab` WHERE test_info_id = test_info_tab.test_info_id) as noofquestion'),
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

                  ->where('issectional', '=', '-1')
                  
                  // ->whereRaw('DATE(expDate) > CURRENT_TIMESTAMP')
                  ->orderBy('purchased_test_tab.test_info_id', 'ASC')
                  ->get();

        }else{
          //Sectional Test 
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

        }

        
        return response()->json(['received'=>'yes','data'=>$data],$this->successStatus);
    }
}









// Zubbling 

// SET @row_num = 0; 
// SELECT * FROM (


//   SELECT *, @row_num := @row_num +1 as count  FROM ( 
//       SELECT question_id as questionID,test_info_id,section_id,question_json as question,option_json as option,answer_json,explaination FROM `question_tab` WHERE test_info_id = 17 and ispuzzle != 1  ORDER BY RAND()
//     ) as normalQuesTab
//     UNION
//   SELECT *,@row_num := @row_num + 1 as count FROM (
//     SELECT question_id as questionID,test_info_id,section_id,question_json as question,option_json as option,answer_json,explaination FROM `question_tab` WHERE test_info_id = 17 and ispuzzle = 1
//   ) as puzzleQuesTab


// ) AS Final_table ORDER BY COUNT 




// $sql = '
//             SELECT * FROM (


//         SELECT *, @row_num := @row_num +1 as count  FROM ( 
//             SELECT question_id as questionID,test_info_id,section_id,question_json as question,option_json as option,answer_json,explaination FROM `question_tab` WHERE test_info_id = 17 and ispuzzle != 1  ORDER BY RAND()
//           ) as normalQuesTab
//           UNION
//         SELECT *,@row_num := @row_num + 1 as count FROM (
//           SELECT question_id as questionID,test_info_id,section_id,question_json as question,option_json as option,answer_json,explaination FROM `question_tab` WHERE test_info_id = 17 and ispuzzle = 1
//         ) as puzzleQuesTab


//       ) AS Final_table ORDER BY COUNT 
//         ';

// $statement = DB::statement("SET @row_num = 0");
// $datas = DB::select($sql);
