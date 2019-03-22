<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Test\ExameTypeController;
use App\Http\Controllers\Test\packageController;
use App\Http\Controllers\Test\QuestionSetController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $exameTypeController = new ExameTypeController();       
        $exameTypeController = $exameTypeController->List();

       
        $packageController = new packageController();  
        $packageController = $packageController->list();

        
        $questionSetController = new QuestionSetController();
        $questionSetController =$questionSetController->list();

     
        return view('home',['exameTypeController'=> $exameTypeController,"exame"=>sizeof($exameTypeController),
        'packageController'=>$packageController,"package"=>sizeof($packageController),
        'questionSetController'=>$questionSetController,"set"=>sizeof($questionSetController)]);
    }
}
