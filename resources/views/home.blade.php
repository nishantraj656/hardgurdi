@extends('layouts.app')

@section('content')
  
<div class="container">
    
  
           
    <div class="row justify-content-center">
      <div class="col-sm-4 mt-5">
          <div class="card">
              <div class="card-header bg-dark text-white">Exam List</div>
              <div class="card-body">
                  <div class="row">
                   Active Exam : {{$exame}}
                       
                    
                  </div>
                </div> 
              <div class="card-footer">
              <a class="nav-link" href="{{url('/')}}/Exam">More</a>
              </div>
            </div>
      </div>
      <div class="col-sm-4 mt-5">
          <div class="card">
              <div class="card-header bg-dark text-white">Package</div>
              <div class="card-body">
                <div class="row">
                    Active Package : {{$package}}
                </div>    
            </div> 
               <div class="card-footer">
                  <a class="nav-link" href="{{url('/Package')}}">More</a>
              </div>
            </div>
      </div>



      <div class="col-sm-4 mt-5">
          <div class="card">
              <div class="card-header bg-dark text-white">Test Series</div>
              <div class="card-body">
                    <div class="row">
                            Active Package : {{$set}}
                        </div>  
                  </div> 
               <div class="card-footer">
                  <a class="nav-link" href="{{url('/QuestionS')}}">More</a>
              </div>
            </div>
      </div>

      <div class="col-sm-4 mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">Section </div>
            <div class="card-body">
                  <div class="row">
                          Active Package : {{$section}}
                      </div>  
                </div> 
             <div class="card-footer">
                <a class="nav-link" href="{{url('/SectionS')}}">More</a>
            </div>
          </div>
    </div>

      {{---<div class="col-sm-4 mt-5">
          <div class="card">
              <div class="card-header bg-dark text-white">Section</div>
              <div class="card-body">Content</div> 
               <div class="card-footer">
                  <a class="nav-link" href="{{url('/Section')}}">More</a>
              </div>
            </div>
      </div>--}}
      <div class="col-sm-4 mt-5">
          <div class="card">
              <div class="card-header bg-dark text-white">Question</div>
              <div class="card-body">Content</div> 
               <div class="card-footer">
               <a class="nav-link" href="{{url('/Question')}}">More</a>
              </div>
            </div>
      </div>
    </div>
</div>
@endsection
