<?php

namespace App\Http\Controllers\Test;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Test\QuestionSetController;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    /**SELECT `question_tab`.`question_id`,`question_tab`.`question_json`,`question_tab`.`option_json`,`test_info_tab`.`test_name` FROM `question_tab`
INNER JOIN `test_info_tab` ON `test_info_tab`.`test_info_id` = `question_tab`.`test_info_id` ; */

        $datas =DB::table('question_tab')
        ->select('question_tab.question_id','question_tab.question_json','test_info_tab.test_name','question_tab.section_id')
        ->join('test_info_tab','test_info_tab.test_info_id','=','question_tab.test_info_id')
        ->simplePaginate(100);

        $list =new QuestionSetController();
        $list = $list->list();
        $section =array(["title"=>'English',"id"=>1],["title"=>'Math',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5]);
      
      
        
        
        return view('Question.index',['data'=>$datas,"list"=>$list,'section'=>$section,'s'=>'All','li'=>'All']);
    }

    /**Filter data */
    public function filter(Request $request)
    {
    /**SELECT `question_tab`.`question_id`,`question_tab`.`question_json`,`question_tab`.`option_json`,`test_info_tab`.`test_name` FROM `question_tab`
INNER JOIN `test_info_tab` ON `test_info_tab`.`test_info_id` = `question_tab`.`test_info_id` ; */
        $where=array();

        if($request->setname != 'All'){
            $set=['question_tab.test_info_id','=',$request->setname];
            array_push($where,$set);
        }

        if($request->section != 'All'){
            $set=['question_tab.section_id',"=",$request->section];
            array_push($where,$set);
        }
            
        
        $datas='';

        if(sizeof($where)!=0)
            $datas =DB::table('question_tab')
            ->select('question_tab.question_id','question_tab.question_json','test_info_tab.test_name','question_tab.section_id')
            ->join('test_info_tab','test_info_tab.test_info_id','=','question_tab.test_info_id')
            ->where($where)
            ->simplePaginate(100);
        else
            $datas =DB::table('question_tab')
            ->select('question_tab.question_id','question_tab.question_json','test_info_tab.test_name','question_tab.section_id')
            ->join('test_info_tab','test_info_tab.test_info_id','=','question_tab.test_info_id')
            ->simplePaginate(100);



        $list =new QuestionSetController();
        $list = $list->list();
        $section =array(["title"=>'English',"id"=>1],["title"=>'Math',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5]);
      
        
        
        return view('Question.index',['data'=>$datas,"list"=>$list,'section'=>$section,'s'=>$request->setname,'li'=>$request->section]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        
        $list =new QuestionSetController();
        $list = $list->list();
        $section =array(["title"=>'English',"id"=>1],["title"=>'Math',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5]);
      

        return view('Question.create',["list"=>$list,'section'=>$section]);
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'eng'=>'required',
        //    'hindi'=>'required',
           'engRadio'=>'required',
           'engOptionA'=>'required',
           'engOptionB'=>'required',
           'engOptionC'=>'required',
           'engOptionD'=>'required',
        //    'hindiOptionA'=>'required',
        //    'hindiOptionB'=>'required',
        //    'hindiOptionC'=>'required',
        //    'hindiOptionD'=>'required',
        //    'hindiRadio'=>'required',
        //    'hindiExplaination'=>'required',
        //    'engExplaination'=>'required',
        ]);

        $picEngpath = $request->file('picEng');
        if($picEngpath != null)
            $picEngpath = $picEngpath->store('Question');
        else
            var_dump($picEngpath);

        $picEngOptionApath = $request->file('picEngOptionA');
        if($picEngOptionApath != null)
            $picEngOptionApath = $picEngOptionApath->store('Set');

        $picEngOptionBpath = $request->file('picEngOptionB');
        if($picEngOptionBpath != null)
            $picEngOptionBpath = $picEngOptionBpath->store('Set');

        $picEngOptionCpath = $request->file('picEngOptionC');
        if($picEngOptionCpath != null)
            $picEngOptionCpath = $picEngOptionCpath->store('Set');
        
        $picEngOptionDpath = $request->file('picEngOptionD');
        if($picEngOptionDpath != null)
            $picEngOptionDpath = $picEngOptionDpath->store('Set');

        $picHindipath = $request->file('picHindi');
        if($picHindipath != null)
            $picHindipath = $picHindipath->store('Set');

        $picHindiOptionApath = $request->file('picHindiOptionA');
        if($picHindiOptionApath != null)
            $picHindiOptionApath = $picHindiOptionApath->store('Set');

        $picHindiOptionBpath = $request->file('picHindiOptionB');
        if($picHindiOptionBpath != null)
            $picHindiOptionBpath = $picHindiOptionBpath->store('Set');

        $picHindiOptionCpath = $request->file('picHindiOptionC');
        if($picHindiOptionCpath != null)
            $picHindiOptionCpath = $picHindiOptionCpath->store('Set');

        $picHindiOptionDpath = $request->file('picHindiOptionD');
        if($picHindiOptionDpath != null)
            $picHindiOptionDpath = $picHindiOptionDpath->store('Set');

        $picHindiExplainationpath = $request->file('picHindiExplaination');
        if($picHindiExplainationpath != null)
            $picHindiExplainationpath = $picHindiExplainationpath->store('Set');

        $picEngExplainationpath = $request->file('picEngExplaination');
        if($picEngExplainationpath != null)
            $picEngExplainationpath = $picEngExplainationpath->store('Set');

    




            /**{eng:{text:'',pic:''},hindi:{text:'',pic:''}} */
        $question=array("eng"=>array("text"=>$request->eng,"pic"=>$picEngpath),"hindi"=>array("text"=>$request->hindi,"pic"=>$picHindipath));
        $option=array("eng"=>array("A"=>array("text"=>$request->engOptionA,"pic"=>$picEngOptionApath),"B"=>array("text"=>$request->engOptionB,"pic"=>$picEngOptionBpath),"C"=>array("text"=>$request->engOptionC,"pic"=>$picEngOptionCpath),"D"=>array("text"=>$request->engOptionD,"pic"=>$picEngOptionDpath)),
        "hindi"=>array("A"=>array("text"=>$request->hindiOptionA,"pic"=>$picHindiOptionApath),"B"=>array("text"=>$request->hindiOptionB,"pic"=>$picHindiOptionBpath),"C"=>array("text"=>$request->hindiOptionC,"pic"=>$picHindiOptionCpath),"D"=>array("text"=>$request->hindiOptionD,"pic"=>$picHindiOptionDpath)));
        $answer=array("eng"=>$request->engRadio,"hindi"=>$request->hindiRadio);
        $explaination=array("eng"=>array("text"=>$request->engExplaination,"pic"=>$picEngExplainationpath),"hindi"=>array("text"=>$request->hindiExplaination,"pic"=>$picHindiExplainationpath));

        Question::create( [
              'test_info_id'=>$request->setname,
              'section_id'=>$request->section,
              'question_json'=>json_encode($question), 
              'option_json'=>json_encode($option), 
              'answer_json'=>json_encode($answer), 
              'explaination'=>json_encode($explaination),
           ]);

           $request->session()->flash('status', 'Task was successful!');
           return redirect('Question/create')
           ->with('success','Great! Notes updated successfully');
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list =new QuestionSetController();
        $list = $list->list();
        $section =array(["title"=>'English',"id"=>1],["title"=>'Math',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5]);
       
       $datas=Question::where(['question_id'=>$id])->first();
      // var_dump(json_decode($datas->answer_json)->hindi);

    //    var_dump($datas);
    //    var_dump($list);
    //    var_dump($section);
       return view('Question.edit',['datas'=>$datas,"list"=>$list,'section'=>$section]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'eng'=>'required',
           
            'engRadio'=>'required',
            'engOptionA'=>'required',
            'engOptionB'=>'required',
            'engOptionC'=>'required',
            'engOptionD'=>'required',
           
         ]);

         $picEngpath = $request->file('picEng');
        if($picEngpath != null){
            $picEngpath = $picEngpath->store('Question');
           
            }
      

        $picEngOptionApath = $request->file('picEngOptionA');
        if($picEngOptionApath != null){     
            $picEngOptionApath = $picEngOptionApath->store('Set');
          
        }

        $picEngOptionBpath = $request->file('picEngOptionB');
        if($picEngOptionBpath != null)
            $picEngOptionBpath = $picEngOptionBpath->store('Set');

        $picEngOptionCpath = $request->file('picEngOptionC');
        if($picEngOptionCpath != null)
            $picEngOptionCpath = $picEngOptionCpath->store('Set');
        
        $picEngOptionDpath = $request->file('picEngOptionD');
        if($picEngOptionDpath != null)
            $picEngOptionDpath = $picEngOptionDpath->store('Set');

        $picHindipath = $request->file('picHindi');
        if($picHindipath != null)
            $picHindipath = $picHindipath->store('Set');

        $picHindiOptionApath = $request->file('picHindiOptionA');
        if($picHindiOptionApath != null)
            $picHindiOptionApath = $picHindiOptionApath->store('Set');

        $picHindiOptionBpath = $request->file('picHindiOptionB');
        if($picHindiOptionBpath != null)
            $picHindiOptionBpath = $picHindiOptionBpath->store('Set');

        $picHindiOptionCpath = $request->file('picHindiOptionC');
        if($picHindiOptionCpath != null)
            $picHindiOptionCpath = $picHindiOptionCpath->store('Set');

        $picHindiOptionDpath = $request->file('picHindiOptionD');
        if($picHindiOptionDpath != null)
            $picHindiOptionDpath = $picHindiOptionDpath->store('Set');

        $picHindiExplainationpath = $request->file('picHindiExplaination');
        if($picHindiExplainationpath != null)
            $picHindiExplainationpath = $picHindiExplainationpath->store('Set');

        $picEngExplainationpath = $request->file('picEngExplaination');
        if($picEngExplainationpath != null)
            $picEngExplainationpath = $picEngExplainationpath->store('Set');

   /**{eng:{text:'',pic:''},hindi:{text:'',pic:''}} */
   $question=array("eng"=>array("text"=>$request->eng,"pic"=>$picEngpath),"hindi"=>array("text"=>$request->hindi,"pic"=>$picHindipath));
   $option=array("eng"=>array("A"=>array("text"=>$request->engOptionA,"pic"=>$picEngOptionApath),"B"=>array("text"=>$request->engOptionB,"pic"=>$picEngOptionBpath),"C"=>array("text"=>$request->engOptionC,"pic"=>$picEngOptionCpath),"D"=>array("text"=>$request->engOptionD,"pic"=>$picEngOptionDpath)),
   "hindi"=>array("A"=>array("text"=>$request->hindiOptionA,"pic"=>$picHindiOptionApath),"B"=>array("text"=>$request->hindiOptionB,"pic"=>$picHindiOptionBpath),"C"=>array("text"=>$request->hindiOptionC,"pic"=>$picHindiOptionCpath),"D"=>array("text"=>$request->hindiOptionD,"pic"=>$picHindiOptionDpath)));
   $answer=array("eng"=>$request->engRadio,"hindi"=>$request->hindiRadio);
   $explaination=array("eng"=>array("text"=>$request->engExplaination,"pic"=>$picEngExplainationpath),"hindi"=>array("text"=>$request->hindiExplaination,"pic"=>$picHindiExplainationpath));

         Question::where('question_id',$id)->update( [
               'test_info_id'=>$request->setname,
               'section_id'=>$request->section,
               'question_json'=>json_encode($question), 
               'option_json'=>json_encode($option), 
               'answer_json'=>json_encode($answer), 
               'explaination'=>json_encode($explaination),
            ]);
            $request->session()->flash('status', ' Notes updated successfully');
          return redirect('Question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::where('question_id',$id)->delete();
        return redirect('Question');
    }
}
