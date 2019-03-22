@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
            <form class="form-inline" action="{{url('Exam')}}" method="POST">
                <label for="name">Name :</label>
                <input type="name" class="form-control ml-4" name="name" id="name">
                @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
               
                <button type="submit" class="btn btn-primary ml-4">New</button>
            </form> 
        </div>
        <div class="row mt-4">
                <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $value)
                              <tr>
                               
                                <td></td>
                                <td>{{$value->cat_name}}</td>
                                <td>
                                  <div class="row">
                                    <div class="ml-5">
                                      <form class="form-inline" action="{{url('Exam',[$value->test_cat_id])}}" method="POST">
                                          <input type="hidden" name="_method" value="DELETE">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          
                                        
                                          <button type="submit" class="btn btn-danger ml-4">Delete</button>
                                      </form> 
                                    </div>
                                    <div class="ml-5">

                                      <a href="{{ URL::to('Exam/' .$value->test_cat_id. '/edit') }}">
                                        <button type="button" class="btn btn-success ml-4">Edit</button>
                                    </a>;
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            
                            @endforeach
                         
                          
                        </tbody>
                      </table>
        </div>
    </div>
    
 @endsection