<?php

namespace App\Http\Controllers;

use App\SubmitFeedback;
use Illuminate\Http\Request;

class SubmitFeedback_C extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
           'name'=>'required | max: 150',
           'email'=>'required | max: 150',
           'message'=>'required | max: 5000'
       ]);

        SubmitFeedback::create( [
              'name'=>$request->name,
              'email'=>$request->email,
              'message'=>$request->message
       ]);

       $request->session()->flash('status', 'Our Team Will Ping back you soon.');
       
       return redirect('/')
                    ->with('success','Great! Successfully  Submitted ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubmitFeedback  $submitFeedback
     * @return \Illuminate\Http\Response
     */
    public function show(SubmitFeedback $submitFeedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubmitFeedback  $submitFeedback
     * @return \Illuminate\Http\Response
     */
    public function edit(SubmitFeedback $submitFeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubmitFeedback  $submitFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubmitFeedback $submitFeedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubmitFeedback  $submitFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubmitFeedback $submitFeedback)
    {
        //
    }
}
