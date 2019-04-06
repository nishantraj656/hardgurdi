@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
            <form action="{{url('Package',$data->package_id)}}" method="POST">
                <div class="form-group">
                    <label for="pname">Package Name:</label>
                <input type="text" value="{{$data->subcat_name}}" class="form-control" id="pname" name="pname" required>
                   
                  </div>
                  <div class="form-group">
                    <label for="sel1">Select Exame:</label>
                    <select class="form-control" id="sel1" name="catID" value="{{$data->test_cat_id}}">
                    @foreach ($list as $l )
                    <option value="{{$l->test_cat_id}}">{{$l->cat_name}}</option>
                    @endforeach
                      
                      
                    </select>
                  </div>

                  <div class="form-group">
                        <label for="price">Price :</label>
                        <input type="number" min="0" class="form-control" value="{{$data->package_price}}" id="price" name="price" required>
                       
                      </div>

                      <div class="form-group">
                            <label for="expDate">Validity :</label>
                            <input type="date" min="0" value="{{$data->expDate}}" class="form-control" id="expDate" name="expDate" required>
                            
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
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-primary ml-4">Save</button>
            </form> 
           
        </div>
        
    </div>
    
 @endsection