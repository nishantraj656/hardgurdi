<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class QuestionController extends Controller
{


    public function getTestQuestion(Request $request)
    {
        $sectionArray =array(["title"=>'English',"id"=>1],["title"=>'Maths',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5]
        ,["title"=>'Letter/Essay',"id"=>7],["title"=>'puzzle',"id"=>6]);
      
        /**SELECT `question_id`, `test_info_id`, `section_id`, `question_json`, `option_json`, `answer_json`, 
         * `explaination` FROM `question_tab` WHERE `test_info_id`=9 */
       $datas = DB::table('question_tab')
        ->select('question_id as questionID','test_info_id','section_id','question_json as question','option_json as option','answer_json','explaination')
        ->where('test_info_id','=',$request->testID)
         ->simplePaginate(200);

        $sections = DB::table('question_tab')
        ->select('section_id')
         ->where('test_info_id','=',$request->testID)
         ->distinct()->get();
        
         $tempArray=array();


         foreach($sections as $section)
         {
            foreach($sectionArray as $el)
            {
                // var_dump($section);
                if($el['id'] == $section->section_id)
                array_push($tempArray,$el);
            }
            
         }

        //  var_dump($tempArray);
      
       return response()->json(['received'=>'yes','data'=>$datas,'section'=>$tempArray]);

    }
}
 