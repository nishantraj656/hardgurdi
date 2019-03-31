<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

// // for overriding register root
Route::get('/register', function () {	
    return view('welcome');
});

Route::get('/weareadmin', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('Website/index');
});


Route::post('Question/filter', 'Test\\QuestionController@filter');

Route::post('SectionS/filter', 'Test\\SectionController@filter');


Route::post('SectionS/{Test}/a', 'SectionalPackageController@Activate');

Route::post('QuestionS/{Test}/a', 'Test\\QuestionSetController@Activate');

Route::post('Package/{Test}/a', 'Test\\packageController@Activate');


Route::get('/home', 'HomeController@index')->name('home');

//Route::get('Question/Test','TestAPI\\QuestionController@getTestQuestion');

Route::resource('/Test','Test\\TestController')->middleware('auth');;
Route::resource('/Exam','Test\\ExameTypeController')->middleware('auth');;
Route::resource('/Package','Test\\packageController')->middleware('auth');;
Route::resource('/Question','Test\\QuestionController')->middleware('auth');;
Route::resource('/Section','Test\\SectionController')->middleware('auth');;
Route::resource('/QuestionS','Test\\QuestionSetController')->middleware('auth');
Route::resource('/SectionS','SectionalPackageController')->middleware('auth');
Route::resource('/submitFeedback','SubmitFeedback_C');



#for payment 
// payment
Route::post('/payment_failed','TestAPI\payuPayment@payment_success_fail');
Route::post('/payment_success','TestAPI\payuPayment@payment_success_fail');
Route::get('/payment_getway/{purchaseType_HD1}/{productID_HD2}/{userID_HD3}/','TestAPI\payuPayment@openPaymentGateway');