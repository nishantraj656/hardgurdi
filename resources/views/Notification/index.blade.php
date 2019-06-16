@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
           
            <a href="{{ URL::to('notifiction/create') }}">
              <button type="button" class="btn btn-success ml-4">New</button>
          </a>&nbsp;
        </div>

        <div class="row mt-4">
                <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th>#</th>                           
                            <th>Title</th>
                            <th>Message</th>
                           
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php $i=0;  @endphp
                            @foreach ($datas as $value)
                              <tr class="@if($value->status == 0) text-danger @endif">
                              <td>{{++$i}}</td>
                               
                                <td>{{$value->title}}</td>
                                <td>{{$value->message}}</td>
                              
                                <td>
                                  <div class="row">
                                    <div class="ml-5">
                                      <form class="form-inline" action="{{url('notifiction',[$value->noti_tab_id])}}" method="POST" onsubmit="return deleteQuestion()">
                                          <input type="hidden" name="_method" value="DELETE">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          
                                        
                                          <button type="submit" class="btn btn-danger ml-4">Delete</button>
                                      </form> 
                                    </div>
                                    <div class="ml-5">

                                    {{-- <form class="form-inline" action="{{url('Exame/'.$value->examID.'/edit')}}" method="GET">
                                      <button type="submit" class="btn btn-success ml-4">Edit</button>
                                    </form>  --}}
                                    <a href="{{ URL::to('notifiction/' .$value->noti_tab_id. '/edit') }}">
                                        <button type="button" class="btn btn-success ml-4">Edit</button>
                                    </a>&nbsp;
                                    </div>
                                    @if ($value->status!=0)
                                    <div class="ml-1 mt-1">
                                      
                                    
                                          
                                      
                                      <form action="{{url('notifiction/'.$value->noti_tab_id.'/a')}}" method="POST">
                                        <input type="hidden" name="status" value='0'/>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <Button id="status" type="submit" class="btn btn-warning">Deactivate</Button>
                                      </form> 
                                    </div>
                                   @else
                                    
                                    {{-- <div class="ml-1 mt-1">
                                      <form action="{{url('notifiction/'.$value->noti_tab_id.'/a')}}" method="POST">
                                        <input type="hidden" name="status" value='1'/>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <Button id="status" type="submit" class="btn btn-primary ">Activate</Button>
                                      </form> 
                                    
                                    </div> --}}
                                    @endif
                                  </div>
                                </td>
                              </tr>
                            
                            @endforeach
                         
                          
                        </tbody>
                      </table>
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
