@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
           
            <a href="{{ URL::to('Question/create') }}">
              <button type="button" class="btn btn-success ml-4">New</button>
          </a>;
        </div>

        <form method="POST" action="{{url('Question/filter')}}">
        <div class="row m-2">
      
          <div class="col-sm-4">
            <div class="row form-inline">
              <label class="ml-2">Test Name  : </label>
              <select class="form-control" name="setname">
                  <option value="All">All</option>   
                  @foreach ($list as $l)
                            @if($l->infoID == $s )
                            <option value="{{$l->infoID}}" selected='selected'>{{$l->title}}</option>
                            @else 
                            <option value="{{$l->infoID}}" >{{$l->title}}</option>  
                            @endif
                        @endforeach
                  </select>
           
            </div>
          </div>
          <div class="col-sm-4">
              <div class="row form-inline">
                  <label class="ml-2">Section  : </label>
                  <select class="form-control" name="section">
                      <option value="All">All</option>   
                      @foreach ($section as $l)
                      @if($l['id'] == $li.'')
                          <option value="{{$l['id']}}" selected='selected'>{{$l['title']}}</option>
                      @else
                           <option value="{{$l['id']}}">{{$l['title']}}</option>
                      @endif
                  @endforeach
                      </select>
                </div>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
          <div class="col-sm-4">
            <div class="row">
                <button type="submit" class="btn btn-primary"> Go </button>
              </div>
        </div>
     
        </div>
      </form>
       

        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Question ID</th>
              <th>Question</th>
              <th>Section</th>
              <th>Test Set </th>
            
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $value)
                <tr>
                <td>{{$value->question_id}}</td>
                 
                  <td>{{json_decode($value->question_json)->eng->text}}</td>
                  <td>{{$value->section_id}}</td>
                  <td>{{$value->test_name}}</td>
                  
                      
                    <td>
                    <div class="row">
                      <div class="ml-5">
                        <form class="form-inline" action="{{url('Question',[$value->question_id])}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                          
                            <button type="submit" class="btn btn-danger ml-4">Delete</button>
                        </form> 
                      </div>
                      <div class="ml-5">

                     
                      <a href="{{ URL::to('Question/' .$value->question_id. '/edit') }}">
                          <button type="button" class="btn btn-success ml-4">Edit</button>
                      </a>&nbsp;
                      </div>
                    </div>
                  </td>
                </tr>
              
              @endforeach
           
            
          </tbody>
        </table>

        <div class="row">
         {{ $data->links()}}
        </div>
    </div>
   
    
 @endsection