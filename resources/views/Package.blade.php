@extends('layouts.app')

@section('content')
 <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="#home">Package List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#menu1">+ New </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#menu2">Income</a>
        </li>
    </ul>

      <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <h3>HOME</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div id="menu1" class="container tab-pane fade"><br>
                <form action="/action_page.php">
                    <div class="form-group">
                    <label for="packageName">Package Name:</label>
                    <input type="text" class="form-control" id="pname">
                    </div>
                    <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd">
                    </div>
                    <div class="form-group form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox"> Remember me
                    </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>

        <div id="menu2" class="container tab-pane fade"><br>
            <h3>Menu2</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
      <script>
            $(document).ready(function(){
              $(".nav-tabs a").click(function(){
                $(this).tab('show');
              });
            });
            </script>
@endsection