<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use  App\ExameType;
use Redirect;
use Illuminate\Http\Response;

class ExameTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $data = ExameType::all();
     
        
      return view('Test.ExameType',["data"=>$data,'received' => 'yes']);
        
  
    }

    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function List()
    {
      
        $data = ExameType::all();
     
        
        return $data;
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required', ]);

            $pic = $request->file('pic');
            if($pic != null)
                $pic = $this->imagePath($pic->store('Set','public'));
            
    

      ExameType::create(['cat_name'=>$request->name,'pic'=>$pic]);
      return redirect('Exam');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
       
        $where = array('test_cat_id' => $id);
        $data= ExameType::where($where)->first();
        return view('Test.ExameTypeEdit',["data"=> $data]);
        // return view('Test.ExameTypeEdit',compact('task',$exameType));
    }

    /**
     * Update the specified resource in storage. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required', ]);

            $picpath = $request->file('pic'); 
            if($picpath != null)
                $picpath = $this->imagePath($picpath->store('public/Set'));
            else
            {
                $picpath = $request->npic;
                echo $picpath;
            }
        
        $update = ['cat_name'=>$request->title,'pic'=>$picpath];
        ExameType::where('test_cat_id',$id)->update($update);
   
       return Redirect::to('Exam')
       ->with('success','Great! Notes updated successfully');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $examID)
    {
        ExameType::where('test_cat_id',$examID)->delete();
   
        return Redirect::to('/Exam')->with('success','Note deleted successfully');
      
    }
}
