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
// Nguồn đi
Route::post('/addNguonDi','NguonDiController@store');
Route::get('/listNguonDi','NguonDiController@index');
Route::get('/editNguonDi/{id}','NguonDiController@edit');
Route::post('/updateNguonDi/{id}','NguonDiController@update');
Route::get('/deleteNguonDi/{id}','NguonDiController@destroy');
// Nguồn đi
Route::post('/addLanhDao','LanhDaoController@store');
Route::get('/listLanhDao','LanhDaoController@index');
Route::get('/editLanhDao/{id}','LanhDaoController@edit');
Route::post('/updateLanhDao/{id}','LanhDaoController@update');
Route::get('/deleteLanhDao/{id}','LanhDaoController@destroy');
// Đơn vị
Route::post('/addDonVi','DonViController@store');
Route::get('/listDonVi','DonViController@index');
Route::get('/editDonVi/{id}','DonViController@edit');
Route::post('/updateDonVi/{id}','DonViController@update');
Route::get('/deleteDonVi/{id}','DonViController@destroy');
// Chức năng
Route::post('/addChucNang','PermissionController@store');
Route::get('/listChucNang','PermissionController@index');
Route::get('/editChucNang/{id}','PermissionController@edit');
Route::post('/updateChucNang/{id}','PermissionController@update');
Route::get('/deleteChucNang/{id}','PermissionController@destroy');
Route::get('/listChucNangCha','PermissionController@listCha');
// phân quyền
Route::post('/addPhanQuyen','RoleController@store');
Route::get('/listPhanQuyen','RoleController@index');
Route::get('/editPhanQuyen/{id}','RoleController@edit');
Route::post('/updatePhanQuyen/{id}','RoleController@update');
Route::get('/deletePhanQuyen/{id}','RoleController@destroy');
// Route::get('/listPhanQuyenCha','RoleController@listCha');

