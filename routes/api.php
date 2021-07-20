<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Loại Văn bản
Route::post('/addLoaiVanBan','LoaiVanBanController@store');
Route::get('/listLoaiVanBan','LoaiVanBanController@index');
Route::get('/editLoaiVanBan/{id}','LoaiVanBanController@edit');
Route::post('/updateLoaiVanBan/{id}','LoaiVanBanController@update');
Route::get('/deleteLoaiVanBan/{id}','LoaiVanBanController@destroy');
// Nguồn đến
Route::post('/addNguonDen','NguonDenController@store');
Route::get('/listNguonDen','NguonDenController@index');
Route::get('/editNguonDen/{id}','NguonDenController@edit');
Route::post('/updateNguonDen/{id}','NguonDenController@update');
Route::get('/deleteNguonDen/{id}','NguonDenController@destroy');

