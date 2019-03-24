@extends('layouts.app')
 @section('content')
 
    <div class="container">
       
            <form action="{{url('QuestionS')}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="setname">Set Name:</label>
                    <input type="text" class="form-control" id="setname" name="setname" required>
                   
                  </div>
                  <div class="form-group">
                    <label for="sel1">Select Package:</label>
                    <select class="form-control" id="sel1" name="pid">
                    @foreach ($list as $l )
                    <option value="{{$l->pid}}">{{$l->sname}}</option>
                    @endforeach
                      
                      
                    </select>
                  </div>

                  <div class="form-group">
                      <label for='descrption'>Descrption :</label>
                      <textarea  rows="5" required class="form-control" id="descrption" name="descrption"></textarea>
                  </div>

                  <div class="form-group">
                        <label for="price">Test Price :</label>
                        <input type="number" value="0" min="0" class="form-control" id="price" name="price" required>
                       
                      </div>

                      <div class="form-group">
                            <label for="correct">Marks on correct:</label>
                            <input type="number" value="0" class="form-control" min="0" id="correct" name="correct" required>
                           
                          </div>
                    <div class="form-group">
                        <label for="incorrect">Marks on incorrect:</label>
                        <input type="text" min="0" value="0" class="form-control" id="incorrect" name="incorrect" required>
                        
                        </div>
                      
                        <div class="form-group">
                            <label for="Time">Test Time :</label>
                            <input type="time" value="0" min="0" class="form-control" id="Time" name="Time" required>
                           
                          </div>
                      
                        <div class="form-group">
                          <label for="expDate">Validity :</label>
                          <input type="date" min="0" value="0" class="form-control" id="expDate" name="expDate" required>
                          
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
               
                <button type="submit" class="btn btn-primary ml-4">New</button>
            </form> 
           
       
        
    </div>
    
 @endsection