@extends('layouts.app')
 @section('content')
 
    <div class="container">
       
            <form action="{{url('SectionS',$data['test_info_id'])}}" method="POST" enctype="multipart/form-data">
             
                <div class="form-group">
                    <label for="sectionname">Section Package Name :</label>
                <input type="text" value="{{$data['test_name']}}" class="form-control" id="setname" name="sectionname" required>
                   
                  </div>
                  <div class="form-group">
                    <label for="sel1">Select Package:</label>
                    <select class="form-control" id="sel1" name="pid">
                    @foreach ($list as $l )
                    <option value="{{$l->pid}}" @if ($data['package_id'] == $l->pid)
                      selected="selected"  
                    @endif   >{{$l->sname}}</option>
                    @endforeach
                      
                      
                    </select>
                  </div>

                  <div class="form-group">
                      <label for="sel1">Select Test Set Name:</label>
                      <select class="form-control" id="sel1" name="setid">
                      @foreach ($qSet as $l )
                      <option value="{{$l->infoID}}" @if ($l->infoID == $data['parent_test_info_id'])
                        selected="selected"  
                      @endif >{{$l->title}}</option>
                      @endforeach
                        
                        
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="sel1">Select Section :</label>
                        <select class="form-control" id="sel1" name="sectionId">
                        @foreach ($section as $l )
                        <option value="{{$l['id']}}"  @if ($l['id'] == $data['issectional'])
                          selected="selected"  
                        @endif>{{$l['title']}}</option>
                        @endforeach
                          
                          
                        </select>
                      </div>
  
                  <div class="form-group">
                      <label for='descrption'>Descrption :</label>
                  <textarea  rows="5" required class="form-control" id="descrption" name="descrption">{{$data['descrption']}}</textarea>
                  </div>

                  <div class="form-group">
                        <label for="price">Test Price :</label>
                        <input type="number" value="{{$data['test_price']}}" min="0" class="form-control" id="price" name="price" required>
                       
                      </div>

                      <div class="form-group">
                            <label for="correct">Marks on correct:</label>
                            <input type="number" value="{{$data['marks_on_correct']}}" class="form-control" min="0" id="correct" name="correct" required>
                           
                          </div>
                    <div class="form-group">
                        <label for="incorrect">Marks on incorrect:</label>
                        <input type="text" min="0" value="{{$data['marks_on_incorrect']}}" class="form-control" id="incorrect" name="incorrect" required>
                        
                        </div>
                      
                        <div class="form-group">
                            <label for="Time">Test Time :</label>
                            <input type="number" value="{{$data['time']}}" min="0" class="form-control" id="Time" name="Time" required>
                           
                          </div>
                      
                        <div class="form-group">
                          <label for="expDate">Validity :</label>
                          <input type="date" min="0" value="{{$data['expDate']}}" class="form-control" id="expDate" name="expDate" required>
                          
                          </div>

                        <div class="form-group">
                                <label for="pic">Insert Pic:</label>
                                <input type="file" name="pic">
                                <input name="npic" value="{{$data['pic']}}" type="hidden"/>
                                   
                                @if($data['pic']!=null)
                                <img src="{{asset($data['pic'])}}" class ="img-thumbnail"/>
                                @endif
                               
                              </div>

                              <input type="hidden" name="_method" value="PUT">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif
               <button type="submit" class="btn btn-primary ml-4">Save</button>
            </form> 
           
       
        
    </div>
    
 @endsection