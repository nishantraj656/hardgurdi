@extends('layouts.app')
 @section('content')
<script type="text/javascript" src="{{url('/')}}/js/jquery.toggler.js"></script>

    <div class="container">
        <div class="row">
           
            <a href="{{ URL::to('SectionS/create') }}">
              <button type="button" class="btn btn-success ml-4">New</button>
          </a>&nbsp;
        </div>

        <div class="row mt-4">
                <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th>#</th>
                            <th>Section Package Name</th>
                            <th>Package Name</th>
                            <th>Price </th>
                            <th>Test Set Name </th>
                            <th>Section Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $i = 0;   @endphp
                              
                          
                            @foreach ($datas as $value)
                              <tr class="@if($value->status == 0) text-danger @endif">
                              <td>{{++$i}}</td>
                               
                                <td>{{$value->name}}</td>
                                <td>{{$value->subcat_name}}</td>
                                <td>@if($value->price == 0)<p style="color:green"> Free</p>                                   
                                  @else
                                        {{$value->price}}
                                    @endif
                                </td>
                                    <td>{{$value->test_name}}</td>
                                    <td>
                                      @foreach ($lists as $list)
                                          @if ($list['id'] == $value->section_id)
                                          {{$list['title']}}
                                           @endif
                                      @endforeach
                                    </td>
                                  <td>
                                  <div class="row">
                                    <div class="ml-1">
                                      <form class="form-inline" action="{{url('SectionS',[$value->section_info_id])}}" method="POST" onsubmit="return deleteQuestion()">
                                          <input type="hidden" name="_method" value="DELETE">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          
                                        
                                          <button type="submit" class="btn btn-danger ml-4">Delete</button>
                                      </form> 
                                    </div>
                                    <div class="ml-1">

                                    {{-- <form class="form-inline" action="{{url('Exame/'.$value->examID.'/edit')}}" method="GET">
                                      <button type="submit" class="btn btn-success ml-4">Edit</button>
                                    </form>  --}}
                                    <a href="{{ URL::to('SectionS/' .$value->section_info_id. '/edit') }}">
                                        <button type="button" class="btn btn-success ml-4">Edit</button>
                                    </a>&nbsp;
                                    </div>
                                    @if ($value->status!=0)
                                    <div class="ml-1 mt-1">
                                      
                                    
                                          
                                      
                                      <form action="{{url('SectionS/'.$value->section_info_id.'/a')}}" method="POST">
                                        <input type="hidden" name="status" value='0'/>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <Button id="status" type="submit" class="btn btn-warning">Deactivate</Button>
                                      </form> 
                                    </div>
                                   @else
                                    
                                    <div class="ml-1 mt-1">
                                      <form action="{{url('SectionS/'.$value->section_info_id.'/a')}}" method="POST">
                                        <input type="hidden" name="status" value='1'/>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <Button id="status" type="submit" class="btn btn-primary ">Activate</Button>
                                      </form> 
                                    
                                    </div>
                                    @endif
                                  </div>
                                </td>
                              </tr>
                            
                            @endforeach
                           
                          
                        </tbody>
                      </table>
        </div>
    </div>

       <script type="text/javascript">
       $(document).ready(function(){
      $(function(){

          $('#status').checkToggler({
              labelOn:'On',
              labelOff:'Off'
          });

         

      });});
  </script>

    
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
      return(false)
      alert("Opps.. Not Deleted")

    }
  }
</script>