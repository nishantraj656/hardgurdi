@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
            <form class="form-inline" action="{{url('Exam')}}" method="POST" enctype="multipart/form-data">
                <label for="name">Name :</label>
                <input type="name" class="form-control ml-4 mr-4 mb-4" name="name" id="name">
                <label for="name">Upload Cover :</label>
                <input type="file" class="form-control ml-4 mb-4" name="pic" id="pic">
                
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
                                      <form class="form-inline" action="{{url('Exam',[$value->test_cat_id])}}" method="POST" onsubmit="return deleteQuestion()">
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



<script type="text/javascript">
  // console.log("helrrrlo");
  

  // confrmation on delte 
  function deleteQuestion() {
    var result = prompt("Type yes to ensure you are serious?");
    if (result == 'yes') {
      return(true)
    }
    else{
      alert("Opps.. Not Deleted")
      return(false)
    }
  }
</script>