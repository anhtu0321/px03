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

Route::get('/listNguonDen','NguonDenController@index');
//Lấy thông tin Loại Văn bản
Route::get('/listLoai','LoaiVanBanController@listLoai');
Route::get('/listNguonDi','NguonDiController@index');
Route::get('/listLanhDao','LanhDaoController@index');
Route::get('/listDonViNoPaginate','DonViController@listNoPaginate');

