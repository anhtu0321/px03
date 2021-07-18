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
