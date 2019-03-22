<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use  App\ExameType;
use Redirect;

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

      ExameType::create(['cat_name'=>$request->name]);
      return redirect('Exame');

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
         
        $update = ['cat_name'=>$request->title];
        ExameType::where('test_cat_id',$id)->update($update);
   
        return Redirect::to('Exame')
       ->with('success','Great! Notes updated successfully');
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
   
        return Redirect::to('/Exame')->with('success','Note deleted successfully');
      
    }
}
