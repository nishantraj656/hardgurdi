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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

#for category and sub categroy
Route::post('cat_sub_cat_get', 'TestAPI\CatSubCat_C@index');
Route::post('render_TestList_HD', 'TestAPI\TestList_C@TestList');
Route::post('render_TestDetails_HD', 'TestAPI\TestDetails_C@TestDetails');
