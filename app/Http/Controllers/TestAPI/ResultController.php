<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function GuzzleHttp\json_decode;

use Illuminate\Support\Facades\DB;

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

        // echo "<br> Total Makrs : ". $totalMarks;
        // echo "<br> Total obtain : ". $obtain;
       
       return response()->json(['received'=>'yes']);
    }

    public function marksCalculation($testID)
    {
        $data = DB::table('test_info_tab')
        ->select(
          'descrption as descrption',
          // 'enroll_stud_count as enroll_stud_count',
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
