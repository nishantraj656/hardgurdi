<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::resource('/Test','Test\\TestController')->middleware('auth');;
Route::resource('/Exam','Test\\ExameTypeController')->middleware('auth');;
Route::resource('/Package','Test\\packageController')->middleware('auth');;
Route::resource('/Question','Test\\QuestionController')->middleware('auth');;
Route::resource('/Section','Test\\SectionController')->middleware('auth');;
Route::resource('/QuestionS','Test\\QuestionSetController')->middleware('auth');;

