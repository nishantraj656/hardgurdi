@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
            <form action="{{url('/notifiction',$datas->noti_tab_id)}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pname">Notification Title :</label>
                <input type="text" required class="form-control" value="{{$datas->title}}" id="title" name="title">
                   
                  </div>

                  <div class="form-group">
                    <label for="pname">Notification Message :</label>
                    <textarea rows="10" required class="form-control" id="msg" name="msg">
                        {{$datas->message}}
                    </textarea>
                   
                  </div>
                
                  <div class="form-inline o">
                    <label for="media" class="m-2">Media</label>
                        <div class="form-group m-2">
                            <label for="pic">Insert File: </label>
                            <input type="file" name="media"/>                       
                      </div>
                      <label class="text-primary">Or</label>
                      <div class="form-group m-2">
                        <label for="pic">Media URL : </label>
                        <input type="text" value="{{$datas->media}}" name="url" class="from-control"/>                       
                  </div>
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
                <button type="submit" class="btn btn-primary ml-4"> Done </button>
            </form> 
           
        </div>
        
    </div>
    
 @endsection