<?php

namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class QuestionController extends Controller
{


    public function getTestQuestion(Request $request)
    {

        /**SELECT `question_id`, `test_info_id`, `section_id`, `question_json`, `option_json`, `answer_json`, 
         * `explaination` FROM `question_tab` WHERE `test_info_id`=9 */
       $datas = DB::table('question_tab')
        ->select('question_id as questionID','test_info_id','section_id','question_json as question','option_json as option','answer_json','explaination')
        ->where('test_info_id','=',9)
        ->get();

        // $hindi=[];
        // $english=[];

        // foreach($datas as $data)
        // {
        //    // var_dump($data);
            
        //     echo '<br>';
        //     echo $data->questionID.'  '.json_decode($data->question)->eng->text.'<br>' ;
        //     echo '<br>';
        //     echo $data->questionID.'  '.json_decode($data->question)->eng->pic.'<br>' ;
        //     echo '<br>';
        //     echo $data->questionID.'  '.json_decode($data->question)->hindi->text.'<br>' ;
        //     echo '<br>';
        //     echo $data->questionID.'  '.json_decode($data->question)->hindi->pic.'<br>' ;
          
        //     $english =json_decode($data->option);
        //  foreach(json_decode($data->option) as $option)
        //  {
        //      foreach($option as $lang)
        //         foreach($lang as $obj)
        //         {
        //         var_dump($obj);
        //          echo '<br>';
        //             // foreach($obj as $o)
        //             //     var_dump($o);
        //                // echo '<br>'.$o;
        //         }   
        //  }
            
           
        //     // var_dump($english);
        //     // echo '<br>'. json_decode($data->option)->eng->A->text;
        // }
       
        return response()->json(['received'=>'yes','data'=>$datas]);

    }
}
 