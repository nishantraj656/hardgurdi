<?php

namespace App\Http\Controllers;

use App\SectionalPackage;
use App\Http\Controllers\Test\packageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Test\QuestionSetController;

class SectionalPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /***
   SELECT `test_info_tab`.`test_name`,`test_info_tab`.`test_name`,`test_info_tab`.`pic`,
        `test_info_tab`.`enroll_stud_count`, `test_info_tab`.`test_price`,`test_info_tab`.`marks_on_correct`,
        `test_info_tab`.`marks_on_incorrect`, `package_tab`.`subcat_name`,
         (Select `test_name` from `test_info_tab` WHERE `parent_test_info_id` = `test_info_id`) as name 
         from `test_info_tab` INNER JOIN `package_tab` ON `package_tab`.`package_id` = 
         `test_info_tab`.`package_id` WHERE `test_info_tab`.`issectional` != 0      
     */
    $datas =DB::table('test_info_tab')
    ->select('test_info_tab.test_name as title','test_info_tab.test_info_id as infoID','test_info_tab.pic','test_info_tab.enroll_stud_count as count',
    'test_info_tab.test_price as price','test_info_tab.marks_on_correct','test_info_tab.marks_on_incorrect','package_tab.subcat_name as package',
    'test_info_tab.status','test_info_tab.expDate','test_info_tab.issectional','test_info_tab.parent_test_info_id as pid')
    ->join('package_tab','package_tab.package_id','=','test_info_tab.package_id')
    ->where('test_info_tab.issectional','!=', 0)
    ->get();





          $section =array(["title"=>'English',"id"=>1],["title"=>'Maths',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5],["title"=>'Letter/Essay',"id"=>7],["title"=>'puzzle',"id"=>6]);
      
        // var_dump($datas);

        return view('section.index',['datas'=>$datas,'lists'=>$section]);

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

        $questionSetController = new QuestionSetController();
        $questionQuestion = $questionSetController->list();
        
        $section =array(["title"=>'English',"id"=>1],["title"=>'Maths',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5],["title"=>'Letter/Essay',"id"=>7],["title"=>'puzzle',"id"=>6]);
      

        return view('section.create',['list'=>$list,'qSet'=>$questionQuestion,'section'=>$section]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           
            'sectionname'=>'required',
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
            
                   
          SectionalPackage::create( [
            'package_id'=>$request->pid,
            'test_name'=>$request->sectionname,
            'descrption'=>$request->descrption,
            'pic'=>$path,       
           'parent_test_info_id'=>$request->setid,
           'issectional'=>$request->sectionId,
            'test_price'=>$request->price,
            'marks_on_correct'=>$request->correct,
            'marks_on_incorrect'=>$request->incorrect,
            'status'=>0,
            'expDate'=>$request->expDate,
            'time'=>$request->Time,
       ]);
        return redirect('SectionS');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SectionalPackage  $sectionalPackage
     * @return \Illuminate\Http\Response
     */
    public function show(SectionalPackage $sectionalPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SectionalPackage  $sectionalPackage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $packageController = new packageController();
        $list = $packageController->list();

        $questionSetController = new QuestionSetController();
        $questionQuestion = $questionSetController->list();
        
        $section =array(["title"=>'English',"id"=>1],["title"=>'Maths',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5],["title"=>'Letter/Essay',"id"=>7],["title"=>'puzzle',"id"=>6]);
      

        $where = array('test_info_id' => $id);
        $sectionalPackage= SectionalPackage::where($where)->first();
       // var_dump($sectionalPackage);
      
return view('section.edit',["data"=>$sectionalPackage,'list'=>$list,'qSet'=>$questionQuestion,
                            'section'=>$section]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SectionalPackage  $sectionalPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
           
            'sectionname'=>'required',
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
                else
                    $path = $request->npic;

                    SectionalPackage::where('test_info_id',$id)->update( [
                        'package_id'=>$request->pid,
                        'test_name'=>$request->sectionname,
                        'descrption'=>$request->descrption,
                        'pic'=>$path,       
                       'parent_test_info_id'=>$request->setid,
                       'issectional'=>$request->sectionId,
                        'test_price'=>$request->price,
                        'marks_on_correct'=>$request->correct,
                        'marks_on_incorrect'=>$request->incorrect,
                        'status'=>0,
                        'expDate'=>$request->expDate,
                        'time'=>$request->Time,
                   ]);
                 
                 //  return redirect('SectionS');
           
    }

    public function Activate(Request $request, $id)
    {
       

                    SectionalPackage::where('test_info_id',$id)->update( [
                        
                        'status'=>$request->status
                       
                   ]);
                    return redirect('SectionS');
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SectionalPackage  $sectionalPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SectionalPackage::where('section_info_id',$id)->delete();
        return redirect('SectionS');
    }
}
