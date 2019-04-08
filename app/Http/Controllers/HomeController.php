<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Test\ExameTypeController;
use App\Http\Controllers\Test\packageController;
use App\Http\Controllers\Test\QuestionSetController;
use App\Http\Controllers\SectionalPackageController;

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
        $questionSetControllerCount = $questionSetController->count();

        
        $sectionCount = (new SectionalPackageController())->count();

     
        return view('home',[
            'exameTypeController'=> $exameTypeController,
            "exame"=>sizeof($exameTypeController),
            'packageController'=>$packageController,
            "package"=>sizeof($packageController),
            'questionSetController'=>$questionSetController,
            "set"=>($questionSetControllerCount),
            "section"=>($sectionCount),
        ]);
    }
}
