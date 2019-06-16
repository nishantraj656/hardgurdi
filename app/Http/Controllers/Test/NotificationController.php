<?php

namespace App\Http\Controllers\Test;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Notification::all();
        return view('Notification.index',['datas'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('Notification.create');
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
            'title' => 'required',
            'msg'=> 'required',
             ]);
            
        $media =$request->file('media');
        if($media != null)
        {
            $media =url('/').'/'.$this->imagePath($media);
        }
        else
        {
            $media = $request->url;
        }

        Notification::create([
                                'title'=>$request->title,
                                'message'=>$request->msg,
                                'media'=>$media,
                            ]);

        return redirect('notifiction');
        
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
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Notification::where('noti_tab_id','=',$id)->first();
        
        return view('Notification.edit',['datas'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required',
            'msg'=> 'required',
             ]);
            
        $media =$request->file('media');
        if($media != null)
        {
            $media =url('/').'/'.$this->imagePath($media);
        }
        else
        {
            $media = $request->url;
        }

        
        Notification::where('noti_tab_id',$id)
                        ->update([
                            'title'=>$request->title,
                            'message'=>$request->msg,
                            'media'=>$media,
                        ]);
        return redirect('notifiction');
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
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data = Notification::where('noti_tab_id','=',$id)->delete();
       return redirect('notifiction');
    }
}
