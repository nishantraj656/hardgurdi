<?php

namespace App\Http\Controllers\Test;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; 
use App\Http\Controllers\Test\QuestionSetController;
use Illuminate\Support\Facades\Storage;

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
        $section =array(["title"=>'English',"id"=>1],["title"=>'Maths',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5],["title"=>'Letter/Essay',"id"=>7],["title"=>'puzzle',"id"=>6]);
       
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
        $section =array(["title"=>'English',"id"=>1],["title"=>'Maths',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5],["title"=>'Letter/Essay',"id"=>7],["title"=>'puzzle',"id"=>6]);
      
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
        $section =array(["title"=>'English',"id"=>1],["title"=>'Maths',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5]
        ,["title"=>'Letter/Essay',"id"=>7],["title"=>'puzzle',"id"=>6]);
      
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
        if($request->section!=7)
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
            $picEngpath =$this->imagePath( $picEngpath->store('public/Question'));
       
        

        $picEngOptionApath = $request->file('picEngOptionA');
        if($picEngOptionApath != null)
            $picEngOptionApath = $this->imagePath($picEngOptionApath->store('public/Set'));

        $picEngOptionBpath = $request->file('picEngOptionB');
        if($picEngOptionBpath != null)
            $picEngOptionBpath = $this->imagePath( $picEngOptionBpath->store('public/Set'));

        $picEngOptionCpath = $request->file('picEngOptionC');
        if($picEngOptionCpath != null)
            $picEngOptionCpath = $this->imagePath($picEngOptionCpath->store('public/Set'));
        
        $picEngOptionDpath = $request->file('picEngOptionD');
        if($picEngOptionDpath != null)
            $picEngOptionDpath = $this->imagePath($picEngOptionDpath->store('public/Set'));
        
        $picEngOptionEpath = $request->file('picEngOptionE');
        if($picEngOptionEpath != null)
            $picEngOptionEpath = $this->imagePath($picEngOptionEpath->store('public/Set'));
    

        $picHindipath = $request->file('picHindi');
        if($picHindipath != null)
            $picHindipath = $this->imagePath($picHindipath->store('public/Set'));

        $picHindiOptionApath = $request->file('picHindiOptionA');
        if($picHindiOptionApath != null)
            $picHindiOptionApath = $this->imagePath($picHindiOptionApath->store('public/Set'));

        $picHindiOptionBpath = $request->file('picHindiOptionB');
        if($picHindiOptionBpath != null)
            $picHindiOptionBpath = $this->imagePath($picHindiOptionBpath->store('public/Set'));

        $picHindiOptionCpath = $request->file('picHindiOptionC');
        if($picHindiOptionCpath != null)
            $picHindiOptionCpath = $this->imagePath($picHindiOptionCpath->store('public/Set'));

        $picHindiOptionDpath = $request->file('picHindiOptionD');
        if($picHindiOptionDpath != null)
            $picHindiOptionDpath = $this->imagePath($picHindiOptionDpath->store('public/Set'));
        
        $picHindiOptionEpath = $request->file('picHindiOptionE');
        if($picHindiOptionEpath != null)
            $picHindiOptionEpath = $this->imagePath($picHindiOptionEpath->store('public/Set'));
    
        $picHindiExplainationpath = $request->file('picHindiExplaination');
        if($picHindiExplainationpath != null)
            $picHindiExplainationpath = $this->imagePath($picHindiExplainationpath->store('public/Set'));

        $picEngExplainationpath = $request->file('picEngExplaination');
        if($picEngExplainationpath != null)
            $picEngExplainationpath = $this->imagePath($picEngExplainationpath->store('public/Set'));

    
            /**{eng:{text:'',pic:''},hindi:{text:'',pic:''}} */
        $question=array("eng"=>array("text"=>$request->eng,"pic"=>$picEngpath),"hindi"=>array("text"=>$request->hindi,"pic"=>$picHindipath));
        $option=array("eng"=>array("A"=>array("text"=>$request->engOptionA,"pic"=>$picEngOptionApath),"B"=>array("text"=>$request->engOptionB,"pic"=>$picEngOptionBpath),"C"=>array("text"=>$request->engOptionC,"pic"=>$picEngOptionCpath),"D"=>array("text"=>$request->engOptionD,"pic"=>$picEngOptionDpath),"E"=>array("text"=>$request->engOptionE,"pic"=>$picEngOptionEpath)),
        "hindi"=>array("A"=>array("text"=>$request->hindiOptionA,"pic"=>$picHindiOptionApath),"B"=>array("text"=>$request->hindiOptionB,"pic"=>$picHindiOptionBpath),"C"=>array("text"=>$request->hindiOptionC,"pic"=>$picHindiOptionCpath),"D"=>array("text"=>$request->hindiOptionD,"pic"=>$picHindiOptionDpath),"E"=>array("text"=>$request->hindiOptionE,"pic"=>$picHindiOptionEpath)));
        $answer=array("eng"=>$request->engRadio,"hindi"=>$request->hindiRadio);
        $explaination=array("eng"=>array("text"=>$request->engExplaination,"pic"=>$picEngExplainationpath),"hindi"=>array("text"=>$request->hindiExplaination,"pic"=>$picHindiExplainationpath));

        Question::create( [
              'test_info_id'=>$request->setname,
              'section_id'=>$request->section,
              'question_json'=>json_encode($question), 
              'option_json'=>json_encode($option), 
              'answer_json'=>json_encode($answer), 
              'explaination'=>json_encode($explaination),
              'ispuzzle' => ($request->checkBoxPuzzel == '1' ? '1': '0'),
              
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
        $section =array(["title"=>'English',"id"=>1],["title"=>'Maths',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5],["title"=>'Letter/Essay',"id"=>7],["title"=>'puzzle',"id"=>6]);
       
       $datas=Question::where(['question_id'=>$id])->first();

    

       return view('Question.edit',['datas'=>$datas,"list"=>$list,'section'=>$section]);
    }

    private function imagePath($pic)
    {
        $imagePath =$pic;//json_decode($datas->question_json)->eng->pic;
        $imageFullPath='/';
        if($imagePath !=null)
        {
            $pathArray= explode('/',$imagePath);
            for($i =0;$i< sizeof($pathArray);$i++)
            {
                if($pathArray[$i] == 'public')
                {
                     $imageFullPath = $imageFullPath.'storage';
                }
                else
                {
                  $imageFullPath = $imageFullPath.'/'.$pathArray[$i]; 
                }
            }

        }
        else
        {
            $imageFullPath =null;
        }
       // echo "Path ".$imageFullPath;
        return $imageFullPath;
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
        if($request->section!=7)
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
            $picEngpath = $this->imagePath($picEngpath->store('public/Question'));
           
        }
        else
        {
            $picEngpath = $request->npicEng;
        }
      

        $picEngOptionApath = $request->file('picEngOptionA');
        if($picEngOptionApath != null){     
            $picEngOptionApath = $this->imagePath($picEngOptionApath->store('public/Set'));
          
        }
        else
        {
            $picEngOptionApath = $request->npicEngOptionA;
        }
      

        $picEngOptionBpath = $request->file('picEngOptionB');
        if($picEngOptionBpath != null)
            $picEngOptionBpath = $this->imagePath($picEngOptionBpath->store('public/Set'));
            else
            {
                $picEngOptionBpath = $request->npicEngOptionB;
            }

        $picEngOptionCpath = $request->file('picEngOptionC');
        if($picEngOptionCpath != null)
            $picEngOptionCpath = $this->imagePath($picEngOptionCpath->store('public/Set'));
            else
            {
                $picEngOptionCpath = $request->npicEngOptionC;
            }
        
        $picEngOptionDpath = $request->file('picEngOptionD');
        if($picEngOptionDpath != null)
            $picEngOptionDpath = $this->imagePath($picEngOptionDpath->store('public/Set'));
        else
        {
            $picEngOptionDpath = $request->npicEngOptionD;
        }

        $picEngOptionEpath = $request->file('picEngOptionE');
        if($picEngOptionEpath != null)
            $picEngOptionEpath = $this->imagePath($picEngOptionEpath->store('public/Set'));
        else
        {
            $picEngOptionEpath = $request->npicEngOptionE;
        }
    

        $picHindipath = $request->file('picHindi');
        if($picHindipath != null)
            $picHindipath = $this->imagePath($picHindipath->store('public/Set'));
            else
            {
                $picHindipath = $request->npicHindi;
            }

        $picHindiOptionApath = $request->file('picHindiOptionA');
        if($picHindiOptionApath != null)
            $picHindiOptionApath = $this->imagePath($picHindiOptionApath->store('public/Set'));
            else
            {
                $picHindiOptionApath = $request->npicHindiOptionA;
            }

        $picHindiOptionBpath = $request->file('picHindiOptionB');
        if($picHindiOptionBpath != null)
            $picHindiOptionBpath = $this->imagePath($picHindiOptionBpath->store('public/Set'));
            else
            {
                $picHindiOptionBpath = $request->npicHindiOptionB;
            }
        $picHindiOptionCpath = $request->file('picHindiOptionC');
        if($picHindiOptionCpath != null)
            $picHindiOptionCpath = $this->imagePath($picHindiOptionCpath->store('public/Set'));
            else
            {
                $picHindiOptionCpath = $request->npicHindiOptionC;
            }
        $picHindiOptionDpath = $request->file('picHindiOptionD');
        if($picHindiOptionDpath != null)
            $picHindiOptionDpath = $this->imagePath($picHindiOptionDpath->store('public/Set'));
            else
            {
                $picHindiOptionDpath = $request->npicHindiOptionD;
            }
        $picHindiOptionEpath = $request->file('picHindiOptionE');
        if($picHindiOptionEpath != null)
            $picHindiOptionEpath = $this->imagePath($picHindiOptionEpath->store('public/Set'));
            else
            {
                $picHindiOptionEpath = $request->npicHindiOptionE;
            }    
        $picHindiExplainationpath = $request->file('picHindiExplaination');
        if($picHindiExplainationpath != null)
            $picHindiExplainationpath = $this->imagePath($picHindiExplainationpath->store('public/Set'));
            else
            {
                $picHindiExplainationpath = $request->npicHindiExplainationpath;
            }
        $picEngExplainationpath = $request->file('picEngExplaination');
        if($picEngExplainationpath != null)
            $picEngExplainationpath = $this->imagePath($picEngExplainationpath->store('public/Set'));
            else
            {
            
                $picEngExplainationpath = $request->npicEngExplainationpath;
            }

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
                'ispuzzle' => ($request->checkBoxPuzzel == '1' ? '1': '0'),

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
