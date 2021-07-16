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

Route::get('/', 'loginController@getLogin')->name('login');
Route::post('/', 'loginController@postLogin');
Route::get('/logout','loginController@getLogout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
route::group(['prefix'=>'admin'],function(){
    route::get('/','adminController@getHome')->name('admin.home');
});