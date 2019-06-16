@extends('layouts.app')
 @section('content')
 
    <div class="container">
       
            <form action="{{url('QuestionS')}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="setname">Set Title:</label>
                    <input type="text" class="form-control" id="Title" name="Title" required>
                   
                  </div>
                

                  <div class="form-group">
                      <label for='descrption'>Descrption :</label>
                      <textarea  rows="5" required class="form-control" id="descrption" name="descrption"></textarea>
                  </div>

                      
                      
                        <div class="form-group">
                                <label for="pic">Insert Pic:</label>
                                <input type="file" name="pic">
                               
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
               
                <button type="submit" class="btn btn-primary ml-4">Save</button>
            </form> 
           
       
        
    </div>
    
 @endsection