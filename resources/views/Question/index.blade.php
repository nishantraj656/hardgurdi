@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
           
            <a href="{{ URL::to('Question/create') }}">
              <button type="button" class="btn btn-success ml-4">New</button>
          </a>;
        </div>

        {{-- <div class="row mt-4">
                <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th>#</th>
                            <th>Questions</th>
                            <th>Package Name</th>
                            <th>Price </th>
                            <th>Student </th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $value)
                              <tr>
                                <td></td>
                               
                                <td>{{$value->title}}</td>
                                <td>{{$value->package}}</td>
                                <td>@if($value->price == 0)<p style="color:green"> Free</p>                                   
                                  @else
                                        {{$value->price}}
                                    @endif
                                </td>
                                    <td>{{$value->count}}</td>
                                  <td>
                                  <div class="row">
                                    <div class="ml-5">
                                      <form class="form-inline" action="{{url('QuestionS',[$value->infoID])}}" method="POST">
                                          <input type="hidden" name="_method" value="DELETE">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          
                                        
                                          <button type="submit" class="btn btn-danger ml-4">Delete</button>
                                      </form> 
                                    </div>
                                    <div class="ml-5">

                                   
                                    <a href="{{ URL::to('QuestionS/' .$value->infoID. '/edit') }}">
                                        <button type="button" class="btn btn-success ml-4">Edit</button>
                                    </a>&nbsp;
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            
                            @endforeach
                         
                          
                        </tbody>
                      </table>
        </div> --}}

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
                        <form class="form-inline" action="{{url('Question',[$value->question_id])}}" method="POST" onsubmit="return deleteQuestion()">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                          
                            <button type="submit" id = "deleteButton" class="btn btn-danger ml-4" >Delete</button>
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

<script type="text/javascript">
  // console.log("helrrrlo");
  

  // confrmation on delte 
  function deleteQuestion() {
    var result = prompt("Type yes to ensure you are serious?");
    if ( result == 'yes') {
      return(true)
    }
    else{
      alert("Opps.. Not Deleted")

      return(false)
    }
  }
</script>