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
       
        $resultID=$request->resultID;
        
        if($datas != null)
        {
           
        
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

                    $resultID = $data->id;

                 //  return response()->json(['received'=>'yes','resultID'=>$id,'totalMarks'=>$totalMarks,'obtain'=>$obtain,'AIR'=>$AIR,'info'=>$info]);
                                
                                //    $AIR = $this->getAIR($userID,$testID);
                    //return response()->json(['received'=>'yes','resultID'=>$id,'totalMarks'=>$totalMarks,'obtain'=>$obtain,'AIR'=>$AIR]);

            }
            else
            {
                
                 return response()->json(['received'=>'no']);	
            }
        }

/***SELECT `result_id`, `test_info_id`, `user_id`, `stud_answer_json`, `total_marks`, `obtain_marks`, `info`, 
 *  FROM `result_tab` WHERE 1 */

        $results =  DB::table('result_tab')
                        ->select('test_info_id','result_id','test_info_id','total_marks','obtain_marks','info')
                        ->where('result_id','=',$resultID)
                        ->get();

        // $AIR = $this->getAIR($userID,$testID);

        // $MaxMarks =,"MaxMarks"=>$MaxMarks
        if(sizeof($results)!=0)
        {



            $results =$results[0];


            $AIR = $this->getAIR($userID,$results->test_info_id);
            $maxMarks = $this->getHighMarks($results->test_info_id);

            return response()->json(['maxMarks'=>$maxMarks,'received'=>'yes','resultID'=>$resultID,'totalMarks'=>$results->total_marks,'obtain'=>$results->obtain_marks,'AIR'=>$AIR,'info'=>$results->info,'testgiuvenID'=>$testID]);

        }



        // $AIR = $this->getAIR($userID,$testID);
        // $MaxMarks = $this->getHighMarks($testID);   //"MaxMarks"=>$MaxMarks

        // return response()->json(['received'=>'yes','resultID'=>$id,'totalMarks'=>$totalMarks,'obtain'=>$obtain,'AIR'=>$AIR,'info'=>$info]);
                

        
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
    public function getAIR($user_id,$test_info_id)
    {

        $sql = '
                    SELECT rownum as AIRrank from (

                        SELECT   (@row_number:=@row_number + 1) AS rownum,obtain_marks,user_id,created_at FROM `result_tab`  where  test_info_id = '.$test_info_id.' 
                         ORDER BY CAST(`result_tab`.`obtain_marks` AS DECIMAL(5,2)) DESC
                    ) as resultList WHERE user_id = '.$user_id.'  ORDER by created_at DESC LIMIT 1 
                ';

        $statement = DB::statement("SET @row_number = 0 ");
        $datas = DB::select($sql);

             
        if(sizeof($datas)!=0)
            $finalData = $datas[0]->AIRrank;
        else 
            $finalData = 0;

        return($finalData);
        // return response()->json(['received'=>'yes',"data"=>$finalData]);

    }
    
    function getHighMarks($testID)  
    {
        $marks = DB::table('result_tab')
                    // ->select('')
                    ->select(DB::raw('CAST(obtain_marks as DECIMAL(5,2)) as maxMarks'),'user_id')

                    // ->max('CAST(`obtain_marks`AS DECIMAL(5,2) ) as maxMarks')

                    ->where('test_info_id',$testID)
                    ->orderByRaw('CAST(`result_tab`.`obtain_marks` AS DECIMAL(5,2)) DESC')
                    ->limit(3)
                    ->get();



        // $marks= DB::select('SELECT MAX(CAST(`obtain_marks`AS DECIMAL(5,2) )) as maxMarks FROM result_tab WHERE test_info_id ='.$testID.';');
       
       
       return($marks);
        // if(sizeof($marks))
        //     return($marks[0]->maxMarks);
        // else 
        //     return 0;
    }
}
