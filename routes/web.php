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
// Loại văn bản
Route::post('/addLoaiVanBan','LoaiVanBanController@store')->middleware('can:loaivanban_them');
Route::get('/listLoaiVanBan','LoaiVanBanController@index')->middleware('can:loaivanban_xem');
Route::get('/editLoaiVanBan/{id}','LoaiVanBanController@edit')->middleware('can:loaivanban_sua');
Route::post('/updateLoaiVanBan/{id}','LoaiVanBanController@update')->middleware('can:loaivanban_sua');
Route::get('/deleteLoaiVanBan/{id}','LoaiVanBanController@destroy')->middleware('can:loaivanban_xoa');
// Nguồn đến
Route::post('/addNguonDen','NguonDenController@store')->middleware('can:nguonden_them');
Route::get('/listNguonDen','NguonDenController@index')->middleware('can:nguonden_xem');
Route::get('/editNguonDen/{id}','NguonDenController@edit')->middleware('can:nguonden_sua');
Route::post('/updateNguonDen/{id}','NguonDenController@update')->middleware('can:nguonden_sua');
Route::get('/deleteNguonDen/{id}','NguonDenController@destroy')->middleware('can:nguonden_xoa');
// Nguồn đi
Route::post('/addNguonDi','NguonDiController@store')->middleware('can:nguondi_them');
Route::get('/listNguonDi','NguonDiController@index')->middleware('can:nguondi_xem');
Route::get('/editNguonDi/{id}','NguonDiController@edit')->middleware('can:nguondi_sua');
Route::post('/updateNguonDi/{id}','NguonDiController@update')->middleware('can:nguondi_sua');
Route::get('/deleteNguonDi/{id}','NguonDiController@destroy')->middleware('can:nguondi_xoa');
// Lãnh đạo
Route::post('/addLanhDao','LanhDaoController@store')->middleware('can:lanhdao_them');
Route::get('/listLanhDao','LanhDaoController@index')->middleware('can:lanhdao_xem');
Route::get('/editLanhDao/{id}','LanhDaoController@edit')->middleware('can:lanhdao_sua');
Route::post('/updateLanhDao/{id}','LanhDaoController@update')->middleware('can:lanhdao_sua');
Route::get('/deleteLanhDao/{id}','LanhDaoController@destroy')->middleware('can:lanhdao_xoa');
// Đơn vị
Route::post('/addDonVi','DonViController@store')->middleware('can:donvi_them');
Route::get('/listDonVi','DonViController@index')->middleware('can:donvi_xem');
Route::get('/editDonVi/{id}','DonViController@edit')->middleware('can:donvi_sua');
Route::post('/updateDonVi/{id}','DonViController@update')->middleware('can:donvi_sua');
Route::get('/deleteDonVi/{id}','DonViController@destroy')->middleware('can:donvi_xoa');
// Chức năng
Route::post('/addChucNang','PermissionController@store')->middleware('can:chucnang_them');
Route::get('/listChucNang','PermissionController@index')->middleware('can:chucnang_xem');
Route::get('/editChucNang/{id}','PermissionController@edit')->middleware('can:chucnang_sua');
Route::post('/updateChucNang/{id}','PermissionController@update')->middleware('can:chucnang_sua');
Route::get('/deleteChucNang/{id}','PermissionController@destroy')->middleware('can:chucnang_xoa');
Route::get('/listChucNangCha','PermissionController@listCha');
// phân quyền
Route::post('/addPhanQuyen','RoleController@store')->middleware('can:phanquyen_them');
Route::get('/listPhanQuyen','RoleController@index')->middleware('can:phanquyen_xem');
Route::get('/editPhanQuyen/{id}','RoleController@edit')->middleware('can:phanquyen_sua');
Route::post('/updatePhanQuyen/{id}','RoleController@update')->middleware('can:phanquyen_sua');
Route::get('/deletePhanQuyen/{id}','RoleController@destroy')->middleware('can:phanquyen_xoa');
// Tài khoản
Route::post('/addTaiKhoan','UserController@store')->middleware('can:taikhoan_them');
Route::get('/listTaiKhoan','UserController@index')->middleware('can:taikhoan_xem');
Route::get('/editTaiKhoan/{id}','UserController@edit')->middleware('can:taikhoan_sua');
Route::post('/updateTaiKhoan/{id}','UserController@update')->middleware('can:taikhoan_sua');
Route::get('/deleteTaiKhoan/{id}','UserController@destroy')->middleware('can:taikhoan_xoa');
// Lấy danh sách quyền của User login
Route::get('/listPermissionOfUser','UserController@getPermissons');

// ********************* DÀNH CHO FRONT END ********************//
// Lấy thông tin user
Route::get('/getUser', 'loginController@getUser');

// Thêm mới văn bản đến
Route::post('/addvanbanden','VanBanDenController@store')->middleware('can:vanbanden_them');
Route::get('/listvanbanden','VanBanDenController@index')->middleware('can:vanbanden_xem');
Route::get('/editvanbanden/{id}','VanBanDenController@edit')->middleware('can:vanbanden_sua');
Route::get('/viewvanbanden/{id}','VanBanDenController@view')->middleware('can:vanbanden_xem');
Route::post('/updatevanbanden/{id}','VanBanDenController@update')->middleware('can:vanbanden_sua');
Route::get('/deletevanbanden/{id}','VanBanDenController@destroy')->middleware('can:vanbanden_xoa');
// Tìm kiếm văn bản đến
Route::post('/search','VanBanDenController@search')->middleware('can:vanbanden_xem');

// Thêm mới văn bản đi
Route::post('/addvanbandi','VanBanDiController@store')->middleware('can:vanbandi_them');
Route::get('/listvanbandi','VanBanDiController@index')->middleware('can:vanbandi_xem');
Route::get('/editvanbandi/{id}','VanBanDiController@edit')->middleware('can:vanbandi_sua');
Route::get('/viewvanbandi/{id}','VanBanDiController@view')->middleware('can:vanbandi_xem');
Route::post('/updatevanbandi/{id}','VanBanDiController@update')->middleware('can:vanbandi_sua');
Route::get('/deletevanbandi/{id}','VanBanDiController@destroy')->middleware('can:vanbandi_xoa');
// Tìm kiếm văn bản đến
Route::post('/searchdi','VanBanDiController@search')->middleware('can:vanbandi_xem');

// Đổi mật khẩu
Route::post('/doimatkhau','UserController@doiMatKhau');
// Danh sach van ban xu ly
Route::get('/vanbanxuly','VanBanDenController@vanbanxuly');
// Danh sach van ban chua xu ly
Route::get('/chuaxuly','VanBanDenController@chuaxuly');
// Cập nhật trạng thái xử lý
Route::post('/capnhattrangthai','VanBanDenController@capnhattrangthai');

