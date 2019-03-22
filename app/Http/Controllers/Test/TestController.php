<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TestController extends Controller
{
            /**
             * Display a listing of the resource.
             *
             * @return Response
             */
            public function index()
            {
                //
            }

            /**
             * Show the form for creating a new resource.
             *
             * @return Response
             */
            public function create()
            {

                return view('Test.TestHome');
            }

            /**
             * Store a newly created resource in storage.
             *
             * @return Response
             */
            public function store(Request $request)
            {

                $validatedData = $request->validate([
                    'packageID' => 'required|max:255|numeric',
                    'name' => 'required|max:255',
                    'descrption' => 'required|max:255',
                    'pic' => 'required|max:255|nullable',
                    'price' =>'required|numeric',
                    'correct' => 'required|numeric',
                    'incorrect' => 'required|numeric',
                ]);


                \App\Product::create( [
                      'package_id',
                      'test_name',
                      'descrption',
                      'pic',
                      'enroll_stud_count',
                      'test_price',
                      'marks_on_correct',
                      'marks_on_incorrect'
                ]);
          
            }

            /**
             * Display the specified resource.
             *
             * @param  int  $id
             * @return Response
             */
            public function show($id)
            {
                //
            }

            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return Response
             */
            public function edit($id)
            {
                //
            }

            /**
             * Update the specified resource in storage.
             *
             * @param  int  $id
             * @return Response
             */
            public function update($id)
            {
                //
            }

            /**
             * Remove the specified resource from storage.
             *
             * @param  int  $id
             * @return Response
             */
            public function destroy($id)
            {
                //
            }
}
