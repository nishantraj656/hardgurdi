<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::group(['middleware' => 'auth:api'], function(){


// });


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('SaveResult','TestAPI\\ResultController@saveResult');//save result


Route::group(['middleware' => 'auth:api'], function(){



	Route::post('details', 'APITest\UserController@details');


Route::post('Question/Test','TestAPI\\QuestionController@getTestQuestion');





	
	
	Route::post('getResult','TestAPI\\ResultController@getResult'); //get Result







	// for category and sub categroy
	Route::post('cat_sub_cat_get', 'TestAPI\CatSubCat_C@index');
	Route::post('render_TestList_HD', 'TestAPI\TestList_C@TestList');
	Route::post('render_TestDetails_HD', 'TestAPI\TestDetails_C@TestDetails');
	Route::post('render_renderNotiList_US', 'TestAPI\NotiList_C@NotiList');
	Route::post('render_userTestHist_HD', 'TestAPI\HistoryList_C@HistList');
	Route::post('render_paymentHist_HD', 'TestAPI\HistoryList_C@HistList');




	Route::post('test', 'TestAPI\HistoryList_C@HistList');
	Route::post('render_paymentHist_HD', 'TestAPI\PaymentHist@getPayHist');
	Route::post('render_purchasedTestList', 'TestAPI\TestList_C@purchasedTestList');


});



// ?LoginSignUP

Route::post('login', 'APITest\UserController@login');
Route::post('register', 'APITest\UserController@register');



Route::post('login_HD', 'TestAPI\LoginSignUP@login'); 
Route::post('register_HD', 'TestAPI\LoginSignUP@register');
Route::post('AvilEmail_HD', 'TestAPI\LoginSignUP@avilEmail');
Route::post('AvilPhone_HD', 'TestAPI\LoginSignUP@avilPhone');

Route::post('send_OTP_HD', 'TestAPI\LoginSignUP@send_OTP_fun');
Route::post('change_password_HD', 'TestAPI\LoginSignUP@change_password_fun');



Route::get('render_upcomingTestList_HD', 'TestAPI\upcomingTest_C@upcomingTestList');




Route::get('test', 'TestAPI\HistoryList_C@HistList');
Route::get('test1', 'TestAPI\\QuestionController@getTestQuestion');
Route::get('test3', 'TestAPI\ResultController@getAIR');



