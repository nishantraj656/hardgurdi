<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{


    public function getTestQuestion(Request $request)
    {

        $where = array(['test_info_id','=',$request->testID]);

        if($request->section != null)
          array_push($request,['section_id','=',$request->section]);
       



        $sectionArray =array(["title"=>'English',"id"=>1],["title"=>'Maths',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5]
        ,["title"=>'Letter/Essay',"id"=>7],["title"=>'puzzle',"id"=>6]);
      
        /**SELECT `question_id`, `test_info_id`, `section_id`, `question_json`, `option_json`, `answer_json`, 
         * `explaination` FROM `question_tab` WHERE `test_info_id`=9 */
       $datas = DB::table('question_tab')
        ->select('question_id as questionID','test_info_id','section_id','question_json as question','option_json as option','answer_json','explaination')
        ->where($where)
       ->orderBy('question', 'desc')
         ->simplePaginate(200);

        $data = $this->questionMixing($datas);

       

        $sections = DB::table('question_tab')
        ->select('section_id')
         ->where('test_info_id','=',$request->testID) 
         ->distinct()->get();
        
         $tempArray=array();


         foreach($sections as $section)
         {
            foreach($sectionArray as $el)
            {
              if($el['id'] == $section->section_id)
                array_push($tempArray,$el);
            }
            
         }

       // var_dump($tempArray);
      
     return response()->json(['received'=>'yes','data'=>$data,'section'=>$tempArray]);

    }

    public function questionMixing($datas)
    {
        $arrayTemp=array();
        foreach($datas as $data)
        {
            $arr=array();
            $questionDecode = json_decode($data->question);

            $questionDecode = json_encode($this->questionSelf($questionDecode));

            $option =json_decode($data->option);
            $option = json_encode($this->optionSelf($option));


            $explaination = json_decode($data->explaination);

            $answer = $data->answer_json;

            $section = $data->section_id;

            $test_info_id = $data->test_info_id;

            $questionID = $data->questionID;

            $arr['question']=$questionDecode;
            $arr['option']=$option;
            $arr['explaination']=$explaination;
            $arr['answer_json']=$answer;
            $arr['section_id']=$section;
            $arr['test_info_id']=$test_info_id;
            $arr['questionID']=$questionID;
            
           array_push($arrayTemp,$arr);

        }

        return $arrayTemp;

    }

    public function questionSelf($strings)
    {
      

        $eng = $strings->eng;
       

        $hindi = $strings->hindi;
        

        return array("eng"=> $this->imageBase64Converter($strings->eng),"hindi"=>$this->imageBase64Converter($strings->hindi));

    }

    public function optionSelf($strings)
    {
       // var_dump($strings->eng);
       // var_dump($strings->hindi);

       $tempArray=array();

       foreach($strings as $key1=>$values1)
       {

            $arraylang=array();

            foreach($values1 as $key=>$values)
            {
                
                
                $arraylang[$key]=$this->imageBase64Converter($values);
                


            }

           $tempArray[$key1] =  $arraylang;
        }

        return $tempArray;
    }

    function isfileAvilable($filename)  
    {
        // Your code here!
        // $filename = 'https://ichef.bbci.co.uk/news/2048/cpsprodpb/0288/production/_105284600_44935b21-9f20-4727-a2c0-84bef85a4548.jpg';


        $ch = curl_init($filename);

        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // $retcode >= 400 -> not found, $retcode = 200, found.
        
        if ($retcode == 200) {
            return(true);
        }else{
            return(false);
        }
        // var_dump($retcode);
    }

    public function imageBase64Converter($strings)
    {
	//	$pic = $strings->pic;
       if($strings->pic !=null)
       {
           if($this->isfileAvilable(asset($strings->pic))) 
		   {
			    $file =file_get_contents(asset($strings->pic));

				return array("text"=>$strings->text,"pic"=>base64_encode($file));
            
		   }
            else
            return array("text"=>$strings->text,"pic"=>null);
        }
		else
		  return array("text"=>$strings->text,"pic"=>null);
	}
}
 