<?php

namespace App\Http\Controllers\Test;

use App\QuestionS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Test\packageController;

class QuestionSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           /**SELECT `test_info_tab`.`test_name`,`test_info_tab`.`test_name`,`test_info_tab`.`pic`,`test_info_tab`.`enroll_stud_count`,
`test_info_tab`.`test_price`,`test_info_tab`.`marks_on_correct`,`test_info_tab`.`marks_on_incorrect`,`package_tab`.`subcat_name` from `test_info_tab`
INNER JOIN `package_tab` ON `package_tab`.`package_id` = `test_info_tab`.`package_id` */
$data =DB::table('test_info_tab')
->select('test_info_tab.test_name as title','test_info_tab.test_info_id as infoID','test_info_tab.pic','test_info_tab.enroll_stud_count as count',
'test_info_tab.test_price as price','test_info_tab.marks_on_correct','test_info_tab.marks_on_incorrect','package_tab.subcat_name as package',
'test_info_tab.status','test_info_tab.expDate')
->join('package_tab','package_tab.package_id','=','test_info_tab.package_id')
->where('test_info_tab.issectional','!=', -1)
->get();
return view('QuestionSet.index',['data'=>$data]);
    }

    public function list() 
    {
          /**SELECT `test_info_tab`.`test_name`,`test_info_tab`.`test_name`,`test_info_tab`.`pic`,`test_info_tab`.`enroll_stud_count`,
`test_info_tab`.`test_price`,`test_info_tab`.`marks_on_correct`,`test_info_tab`.`marks_on_incorrect`,`package_tab`.`subcat_name` from `test_info_tab`
INNER JOIN `package_tab` ON `package_tab`.`package_id` = `test_info_tab`.`package_id` */
$data =DB::table('test_info_tab')
->select('test_info_tab.test_name as title','test_info_tab.test_info_id as infoID','test_info_tab.pic','test_info_tab.enroll_stud_count as count',
'test_info_tab.test_price as price','test_info_tab.marks_on_correct','test_info_tab.marks_on_incorrect','package_tab.subcat_name as package',
'test_info_tab.status','test_info_tab.expDate')
->join('package_tab','package_tab.package_id','=','test_info_tab.package_id')
->get();
return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packageController = new packageController();
        $list = $packageController->list();

        return view('QuestionSet.create',['list'=>$list]);

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
           
        'setname'=>'required',
        'descrption'=>'required',
        
        'price'=>'required|numeric',
        'correct'=>'required|numeric',
        'incorrect'=>'required',
        'expDate'=>'required',
        'Time'=>'required'
             ]);
       $path = $request->file('pic');
            if($path != null)
                $path = $this->imagePath($path->store('public/Set'));
           
                
      
     QuestionS::create( [
        'package_id'=>$request->pid,
        'test_name'=>$request->setname,
        'descrption'=>$request->descrption,
        'pic'=>$path,       
        'enroll_stud_count'=>0,
        'test_price'=>$request->price,
        'marks_on_correct'=>$request->correct,
        'marks_on_incorrect'=>$request->incorrect,
        'status'=>0,
        'expDate'=>$request->expDate,
        'time'=>$request->Time,
   ]);
    return redirect('QuestionS');
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
        echo "Path ".$imageFullPath;
        return $imageFullPath;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionS  $questionS
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionS  $questionS
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $packageController = new packageController();
        $list = $packageController->list();

        $where = array('test_info_id' => $id);
        $questionS= QuestionS::where($where)->first();
        var_dump($questionS[0]);
      
       return view('QuestionSet.edit',["data"=>$questionS,"list"=>$list]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionS  $questionS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
           
            'setname'=>'required',
            'descrption'=>'required',
            
            'price'=>'required|numeric',
            'correct'=>'required|numeric',
            'incorrect'=>'required|numeric',
            'Time'=>'required'
                 ]);

            $path = $request->file('pic');
            if($path != null)
                $path = $this->imagePath($path->store('public/Set'));
            else
                $path = $request->npic;
        
    
        $update= [
            'package_id'=>$request->pid,
            'test_name'=>$request->setname,
            'descrption'=>$request->descrption,
            'pic'=>$path, 
           
            'enroll_stud_count'=>0,
            'test_price'=>$request->price,
            'marks_on_correct'=>$request->correct,
            'marks_on_incorrect'=>$request->incorrect,
            'status'=>0,
            'expDate'=>$request->expDate,
            'time'=>$request->Time,
       ];

        QuestionS::where('test_info_id',$id)->update($update);
          return redirect('QuestionS');
    }

    public function Activate(Request $request,$id)
    {
        
      
        $update= [
            'status'=>$request->status,
           
       ];

        QuestionS::where('test_info_id',$id)->update($update);
          return redirect('QuestionS');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionS  $questionS
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QuestionS::where('test_info_id',$id)->delete();
        return redirect('QuestionS');
    }
}
