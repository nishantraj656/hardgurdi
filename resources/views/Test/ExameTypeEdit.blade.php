@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
                <h1>Edit Exme</h1>
        </div>
        <div class="row"> 
                 <form action="{{url('Exam',$data->test_cat_id)}}" method="POST" enctype="multipart/form-data">
                 <input type="hidden" name="_method" value="PUT">
                 {{ csrf_field() }}
                  <div class="form-group">
                    <label for="title">Task Title : </label>
                    <input type="text" value="{{$data->cat_name}}" class="form-control" id="taskTitle"  name="title" >
                  </div>

                  <div class="form-group">
                    <label for="title">Upload Cover : </label>
                    <input type="file"  class="form-control" id="pic"  name="pic" >
                    <input type="hidden" value="{{$data->pic}}" name="npic" id="npic"/>
                    {{-- <input name="npicHindiExplaination" value="{{json_decode($datas->explaination)->hindi->pic}}" type="hidden"/> --}}
                                   
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
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
       
    </div>
    
 @endsection