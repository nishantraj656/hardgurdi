<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function GuzzleHttp\json_decode;

use Illuminate\Support\Facades\DB;
use App\Result;
use function GuzzleHttp\json_encode;

class ResultController extends Controller
{
    public function saveResult(Request $request)
    {
        $userID =  $request->userID;
        $datas = $request->data;
        $testID = $request->testID;
        $correct =0;
        $attempt = 0;
        $incorrect =0;
        



        foreach($datas as $value)
        {
            $answer = json_decode($value["answer_json"]);
           $replay = $value["replay"];

            if($replay !=null)
            {
                if($answer->eng == $replay)
                {
                    $correct++;  
                }
                else
                {
                    $incorrect++; 
                }
            }


        }

       $MarksInfo = $this->marksCalculation($testID);

        $totalMarks = sizeof($datas) * $MarksInfo['PositiveMarking'];

        $obtain = ($correct * $MarksInfo['PositiveMarking']) - ($incorrect * $MarksInfo['NegativeMarking']);

        $data = Result::create([       
            'test_info_id'=>$testID,
            'user_id'=>$userID,
            'stud_answer_json'=>json_encode($datas),
            'total_marks'=>$totalMarks,
            'obtain_marks'=>$obtain            
             ]);

            $id = $data->id;

       /***  $datas = DB::table('result_tab')
        ->select('result_id as resultID', 'test_info_id as testID', 'stud_answer_json as answers', 'total_marks as total', 'obtain_marks as obtain')
        ->where('result_id','=',$id)
        ->get();*/

return response()->json(['received'=>'yes','resultID'=>$id,'totalMarks'=>$totalMarks,'obtain'=>$obtain]);
    }

    public function getResult(Request $request)
    {
        $id =$request->rid;
        $datas = DB::table('result_tab')
                ->select('result_id as resultID', 'test_info_id as testID', 'stud_answer_json as answers', 'total_marks as total', 'obtain_marks as obtain')
                ->where('result_id','=',$id)
                ->get();

        return response()->json(['received'=>'yes',"data"=>$datas]);
    }

    public function marksCalculation($testID)
    {
        $data = DB::table('test_info_tab')
        ->select(
          'descrption as descrption',
          'marks_on_correct as PositiveMarking',
          'marks_on_incorrect as NegativeMarking',
          'expDate as expDate',
          'created_at as created_at'
        )
        ->where('test_info_id', '=', $testID)
        ->get();

        $newData = $data[0];

        return ["PositiveMarking"=>$newData->PositiveMarking,"NegativeMarking"=>$newData->NegativeMarking];

    }
}
