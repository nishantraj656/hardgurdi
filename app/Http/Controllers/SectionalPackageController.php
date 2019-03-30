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
       /**
        * SELECT `sectional_packages`.`section_info_id`, `test_info_tab`.`test_name`,
        `package_tab`.`subcat_name`, `sectional_packages`.`name`, `sectional_packages`.
        `descrption`, `sectional_packages`.`pic`, `sectional_packages`.`price`,
         `sectional_packages`.`marks_on_correct`, `sectional_packages`.`marks_on_incorrect`,
          `sectional_packages`.`status`, `sectional_packages`.`time`,
           `sectional_packages`.`expDate`, `sectional_packages`.`section_id` 
           FROM `sectional_packages`
INNER JOIN `package_tab` ON `sectional_packages`.`package_id` = `package_tab`.`package_id`
INNER JOIN `test_info_tab` ON `test_info_tab`.`test_info_id` = `sectional_packages`.`test_info_id`
WHERE 1
        */
       $datas = DB::table('sectional_packages')
       ->select( 'sectional_packages.section_info_id', 'test_info_tab.test_name',
       'package_tab.subcat_name', 'sectional_packages.name', 'sectional_packages.descrption', 
       'sectional_packages.pic', 'sectional_packages.price',
        'sectional_packages.marks_on_correct', 'sectional_packages.marks_on_incorrect',
         'sectional_packages.status', 'sectional_packages.time',
          'sectional_packages.expDate', 'sectional_packages.section_id')
          ->join('package_tab','sectional_packages.package_id','=','package_tab.package_id')
          ->join('test_info_tab','test_info_tab.test_info_id','=','sectional_packages.test_info_id')
          ->simplePaginate(100);

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
            'name'=>$request->sectionname,
            'descrption'=>$request->descrption,
            'pic'=>$path,       
           'test_info_id'=>$request->setid,
           'section_id'=>$request->sectionId,
            'price'=>$request->price,
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
      

        $where = array('section_info_id' => $id);
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

                    SectionalPackage::where('section_info_id',$id)->update( [
                        'package_id'=>$request->pid,
                        'name'=>$request->sectionname,
                        'descrption'=>$request->descrption,
                        'pic'=>$path,       
                       'test_info_id'=>$request->setid,
                       'section_id'=>$request->sectionId,
                        'price'=>$request->price,
                        'marks_on_correct'=>$request->correct,
                        'marks_on_incorrect'=>$request->incorrect,
                        'status'=>0,
                        'expDate'=>$request->expDate,
                        'time'=>$request->Time,
                   ]);
                    return redirect('SectionS');
           
    }

    public function Activate(Request $request, $id)
    {
       

                    SectionalPackage::where('section_info_id',$id)->update( [
                        
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
