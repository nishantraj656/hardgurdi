@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row">
           
            <a href="{{ URL::to('Package/create') }}">
              <button type="button" class="btn btn-success ml-4">New</button>
          </a>&nbsp;
        </div>

        <div class="row mt-4">
                <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th>#</th>
                            <th>Package Name</th>
                            <th>Exame Name</th>
                            <th>Fee </th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $value)
                              <tr>
                                <td></td>
                               
                                <td>{{$value->sname}}</td>
                                <td>{{$value->cname}}</td>
                                <td>@if($value->price == 0)<p style="color:green"> Free</p>                                   @else
                                        {{$value->price}}
                                    @endif
                                <td>
                                  <div class="row">
                                    <div class="ml-5">
                                      <form class="form-inline" action="{{url('Package',[$value->pid])}}" method="POST">
                                          <input type="hidden" name="_method" value="DELETE">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          
                                        
                                          <button type="submit" class="btn btn-danger ml-4">Delete</button>
                                      </form> 
                                    </div>
                                    <div class="ml-5">

                                    {{-- <form class="form-inline" action="{{url('Exame/'.$value->examID.'/edit')}}" method="GET">
                                      <button type="submit" class="btn btn-success ml-4">Edit</button>
                                    </form>  --}}
                                    <a href="{{ URL::to('Package/' .$value->pid. '/edit') }}">
                                        <button type="button" class="btn btn-success ml-4">Edit</button>
                                    </a>&nbsp;
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