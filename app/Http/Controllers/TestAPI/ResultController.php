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
        $userID = $request->userID;
        $datas = $request->data;
        $testID = $request->testID;
        $correct = 0;
        $attempt = 0;
        $incorrect = 0;
		$skipped =0;
		
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
			else
			{
				$skipped++;
			}


        }

       $MarksInfo = $this->marksCalculation($testID);
         $info =json_encode(array('correct'=>$correct,'incorrect'=>$incorrect,'skipped'=>$skipped));
	   
	   if($MarksInfo != null)
	   {

			$totalMarks = sizeof($datas) * $MarksInfo['PositiveMarking'];

			$obtain = ($correct * $MarksInfo['PositiveMarking']) - ($incorrect * $MarksInfo['NegativeMarking']);
            
            $obtain = round($obtain,2);
			$data = Result::create([       
				'test_info_id'=>$testID,
				'user_id'=>$userID,
				'stud_answer_json'=>json_encode($datas),
				'total_marks'=>$totalMarks,
				'obtain_marks'=>$obtain,
			'info'=>$info,
				 ]);

			$id = $data->id;


          $AIR = $this->getAIR($userID,$testID);
	       return response()->json(['received'=>'yes','resultID'=>$id,'totalMarks'=>$totalMarks,'obtain'=>$obtain,'AIR'=>$AIR,'info'=>$info]);

		}
		else
		{
	       return response()->json(['received'=>'no']);	
		}

       /***  $datas = DB::table('result_tab')
        ->select('result_id as resultID', 'test_info_id as testID', 'stud_answer_json as answers', 'total_marks as total', 'obtain_marks as obtain')
        ->where('result_id','=',$id)
        ->get();*/

		
    }

    public function marksCalculation($testID)
    {
        $data = DB::table('test_info_tab')
        ->select('marks_on_correct as PositiveMarking','marks_on_incorrect as NegativeMarking')
        ->where('test_info_id', '=', $testID)
        ->get();

		if($data == null)
		{	
			return null;
		}
		else
		{
			$newData = $data[0];

			return ["PositiveMarking"=>$newData->PositiveMarking,"NegativeMarking"=>$newData->NegativeMarking];
		}

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
    function getAIR($user_id,$test_info_id)
    {

        $statement = DB::statement("SET @row_number = 0 ");
        $datas = DB::select('
                    SELECT rownum as AIRrank from (

                        SELECT   (@row_number:=@row_number + 1) AS rownum,obtain_marks,user_id,test_info_id,created_at FROM `result_tab`    
                        ORDER BY `result_tab`.`obtain_marks`  DESC
                    ) as resultList WHERE user_id = '.$user_id.' and test_info_id = '.$test_info_id.' ORDER by created_at DESC LIMIT 1 
                ');

        $data = $datas[0]->AIRrank;

        return($data);
        // return response()->json(['received'=>'yes',"data"=>$data]);
    }
}
