<?php

namespace App\Http\Controllers\Test;

use App\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Test\ExameTypeController;
use Redirect;

class packageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SELECT `package_tab`.`package_id`, `test_cat_tab`.`cat_name` , `package_tab`.`subcat_name`, `package_tab`.`package_price` FROM `package_tab` 
//INNER JOIN `test_cat_tab` ON `test_cat_tab`.`test_cat_id` = package_tab.test_cat_id
        $data=DB::table('package_tab')
        ->select('package_tab.package_id as pid','test_cat_tab.cat_name as cname','package_tab.subcat_name as sname','package_tab.package_price as price','package_tab.status as status')
        ->join('test_cat_tab','test_cat_tab.test_cat_id','=','package_tab.test_cat_id')
        ->get();
        return view('package.index',['data'=>$data]);
        
    }

    public function list()
    {
       
        $data=DB::table('package_tab')
        ->select('package_tab.package_id as pid','test_cat_tab.cat_name as cname','package_tab.subcat_name as sname','package_tab.package_price as price')
        ->join('test_cat_tab','test_cat_tab.test_cat_id','=','package_tab.test_cat_id')
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
        $exameTypeController= new ExameTypeController(); 
        $list=$exameTypeController->List();
      
        //var_dump($list);
        return view('package.create',['list'=>$list]);
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
            'pname' => 'required',
            'price'=> 'required|numeric|max:1000000|min:0',
             ]);

     Package::create( [
        'test_cat_id'=>$request->catID,
        'subcat_name'=>$request->pname,
        'package_price'=>$request->price
   ]);
      return redirect('Package');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $where = array('package_id' => $id);
        $data= Package::where($where)->first();

        $exameTypeController= new ExameTypeController(); 
        $list=$exameTypeController->List();

        return view('package.edit',["data"=> $data,"list"=>$list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'pname' => 'required',
            'price'=> 'required|numeric|max:1000000|min:0',
             ]);

    
         
        $update =  [
            'test_cat_id'=>$request->catID,
            'subcat_name'=>$request->pname,
            'package_price'=>$request->price
            ];
     Package::where('package_id',$id)->update($update);
   
        return Redirect::to('Package')
       ->with('success','Great! Notes updated successfully');
    }

    public function Activate(Request $request,$id)
    {
        
      
        $update= [
            'status'=>$request->status,
           
       ];

       Package::where('package_id',$id)->update($update);
          return redirect('Package');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Package::where('package_id',$id)->delete();
   
        return Redirect::to('/Package')->with('success','Note deleted successfully');
    }
}
