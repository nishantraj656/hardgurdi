@extends('layouts.app')

 @section('content')
    
    <div class="container">
        <div class="row">
            <Button action = "{{action('ControllerName',['id'=>1])}}" > Show </Button>
        </div>
    </div>
 @endsection