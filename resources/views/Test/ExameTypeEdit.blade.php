@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
                <h1>Edit Exme</h1>
        </div>
        <div class="row"> 
                 <form action="{{url('Exam',$data->test_cat_id)}}" method="POST">
                 <input type="hidden" name="_method" value="PUT">
                 {{ csrf_field() }}
                  <div class="form-group">
                    <label for="title">Task Title</label>
                    <input type="text" value="{{$data->cat_name}}" class="form-control" id="taskTitle"  name="title" >
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