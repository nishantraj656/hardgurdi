@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
            <form action="{{url('Package')}}" method="POST">
                <div class="form-group">
                    <label for="pname">Package Name:</label>
                    <input type="text" required class="form-control" id="pname" name="pname">
                   
                  </div>
                  <div class="form-group">
                    <label for="sel1">Select Exame:</label>
                    <select class="form-control" id="sel1" name="catID">
                    @foreach ($list as $l )
                    <option value="{{$l->test_cat_id}}">{{$l->cat_name}}</option>
                    @endforeach
                      
                      
                    </select>
                  </div>

                  <div class="form-group">
                        <label for="price">Price :</label>
                        <input type="number" min="0" value="0" class="form-control" id="price" name="price">
                       
                      </div>
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
        
    </div>
    
 @endsection