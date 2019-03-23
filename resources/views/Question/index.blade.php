@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
           
            <a href="{{ URL::to('Question/create') }}">
              <button type="button" class="btn btn-success ml-4">New</button>
          </a>;
        </div>
        @if (session('status'))
        <div class="alert alert-success">
                <strong>Success!</strong> {{session('status')}}.
              </div>         
    @endif

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
              <th>ID(Sl.No.)</th>
              <th>Question</th>
              <th>Section</th>
              <th>Test Set </th>
            
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @php $i = 0;  @endphp
              @foreach ($data as $value)
                <tr>

                @php $i++;  @endphp
                
                <td>{{$value->question_id}} ({{$i}})</td>
                 
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