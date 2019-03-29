@extends('layouts.app')
<style >
    img {
        height:100px;
        width: 150px;
    }
</style>
 @section('content')
 
    <div class="container">
        <div class="row">
            <form action="{{url('QuestionS',$data->test_info_id)}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="setname">Set Name:</label>
                <input type="text" class="form-control" id="setname" value="{{$data->test_name}}" name="setname" required>
                   
                  </div>
                  <div class="form-group">
                    <label for="sel1">Select Package:</label>
                    <select class="form-control" id="sel1"  name="pid">
                    @foreach ($list as $l )
                        @if($data->package_id == $l->pid)
                         <option value="{{$l->pid}}" selected="selected">{{$l->sname}}</option>
                         @else
                         <option value="{{$l->pid}}" selected="selected">{{$l->sname}}</option>
                         @endif
                    @endforeach
                      
                      
                    </select>
                  </div>

                  <div class="form-group">
                      <label for='descrption'>Descrption :</label>
                      <textarea  rows="5" class="form-control" id="descrption" name="descrption" required>{{$data->descrption}}</textarea>
                  </div>

                  <div class="form-group">
                        <label for="price">Test Price :</label>
                        <input type="number" value="{{$data->test_price}}" class="form-control" id="price" name="price" required>
                       
                      </div>

                      <div class="form-group">
                            <label for="correct">Marks on correct:</label>
                            <input type="number" value="{{$data->marks_on_correct}}" class="form-control" id="correct" name="correct" required>
                           
                          </div>
                    <div class="form-group">
                        <label for="incorrect">Marks on incorrect:</label>
                        <input type="text" value="{{$data->marks_on_incorrect}}" class="form-control" id="incorrect" name="incorrect" required>

                        
                        </div>

                        <div class="form-group">
                                <label for="Time">Test Time :</label>
                                <input type="number" value="{{$data->time}}" min="0" class="form-control" id="Time" name="Time" required>
                               
                              </div>
                          
                            <div class="form-group">
                              <label for="expDate">Validity :</label>
                              <input type="date" min="0" value="{{$data->expDate}}" class="form-control" id="expDate" name="expDate" required>
                              
                              </div>

                        <div class="form-group">
                                <label for="pic">Insert Pic:</label>
                                <input type="file" name="pic">
                                <input name="npic" value="{{$data->pic}}" type="hidden"/>
                             
                                @if($data->pic!=null)
                               <img src="{{asset($data->pic)}}" class ="img-thumbnail"/>
                               
                                 @endif
                               
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
                <button type="submit" class="btn btn-primary ml-4">Update</button>
            </form> 
           
        </div>
        
    </div>
    
 @endsection