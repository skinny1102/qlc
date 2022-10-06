<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QLBaoCaoController;
use App\Http\Controllers\QLHoaDonController;
use App\Http\Controllers\QLKhachHangController;
use App\Http\Controllers\QLMatHangController;
use App\Http\Controllers\QLNhanVienController;
use Illuminate\Http\Request;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home',  [HomeController::class, 'index']);
// Route::get('/home', function () {;
//     return view('home/home');
// });


Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/doimatkhau', [AuthController::class, 'doimatkhau']);
Route::post('/doimatkhau', [AuthController::class, 'submitdoimatkhau']);
Route::get('/ql-mathang', [QLMatHangController::class, 'dieuhuong']);
/// QL Mathang
Route::get('/ql-mathang/loaicay', [QLMatHangController::class, 'index']);

/// Them loai cay
Route::post('/themloaicay', [QLMatHangController::class, 'themLoaiCay']);
Route::get('/xoaloaicay', [QLMatHangController::class, 'xoaLoaiCay']);
Route::post('/searchloaicay', [QLMatHangController::class, 'searchLoaiCay']);
// cay canh 
Route::get('/ql-mathang/caycanh', [QLMatHangController::class, 'CayCanh']);
Route::post('/themcaycanh', [QLMatHangController::class, 'themCayCanh']);
Route::get('/xoacaycanh', [QLMatHangController::class, 'xoaCayCanh']);
Route::get('/ql-mathang/caycanh/{id}', [QLMatHangController::class, 'detailCayCanh']);
Route::post('/editcaycanh/{id}', [QLMatHangController::class, 'updateCayCanh']);
Route::post('/searchcaycanh', [QLMatHangController::class, 'searchCayCanh']);



//Khachhang 
Route::get('/ql-khachhang', [QLKhachHangController::class, 'index']);
Route::post('/themkhachhang', [QLKhachHangController::class, 'themKhachHang']);
Route::get('/xoakhachhang', [QLKhachHangController::class, 'xoaKhachHang']);
Route::get('/editkhachhang/{id}', [QLKhachHangController::class, 'updateKhachHang']);
Route::post('/suakhachhang/{id}', [QLKhachHangController::class, 'suakhachang']);
Route::post('/searchkhachhang', [QLKhachHangController::class, 'searchKhachHang']);
// Nhan Vien
Route::get('/ql-nhanvien', [QLNhanVienController::class, 'index']);
Route::post('/themnhanvien', [QLNhanVienController::class, 'themNhanVien']);
Route::get('/xoanhanvien', [QLNhanVienController::class, 'xoaNhanVien']);
Route::get('/editnhanvien/{id}', [QLNhanVienController::class, 'updateNhanVien']);
Route::post('/suanhanvien/{id}', [QLNhanVienController::class, 'suanhanvien']);
Route::post('/searchnhanvien', [QLNhanVienController::class, 'searchNhanVien']);

// HoaDon 
Route::get('/ql-hoadon', [QLHoaDonController::class, 'index']);
Route::Post('/themhoadon', [QLHoaDonController::class, 'themhoandon']);
Route::get('/xoahoadon', [QLHoaDonController::class, 'xoahoadon']);
Route::get('/edithoadon/{id}', [QLHoaDonController::class, 'edithoadon']);
Route::post('/suahoadon/{id}', [QLHoaDonController::class, 'suahoadon']);
// search hoa don
Route::post('/searchhoadon', [QLHoaDonController::class, 'searchhoadon']);
    /// them chi tiet
Route::post('/themchitiet', [QLHoaDonController::class, 'themchitiet']);
    // xoa chi tiet xoachitiethoadon
Route::get('/xoachitiethoadon', [QLHoaDonController::class, 'xoachitiethoadon']);
    /// btn-suachitiethoadon
Route::get('/chitiethoadon/{id}', [QLHoaDonController::class, 'chitiethoadon']);
Route::post('/suachitiethoadon', [QLHoaDonController::class, 'suachitiethoadon']);
    //inhoadon 
    Route::get('/inhoadon/{id}', [QLHoaDonController::class, 'inhoadon']); 
// api 
Route::get('/listcaycanh', [QLMatHangController::class, 'listCayCanh']);
Route::get('/detailcaycanh/{id}', [QLMatHangController::class, 'detailsCayCanh']);
    //get khachhang all
Route::get('/listkhachhang', [QLKhachHangController::class, 'listKhachHang']);   
    /// get nhanvien all
Route::get('/listnhanvien', [QLNhanVienController::class, 'listNhanVien']);   
Route::get('/xuatpdf/{id}', [QLHoaDonController::class, 'xuatpdf']);  
// báo cáo thống kế
Route::get('/ql-baocaothongke', [QLBaoCaoController::class, 'index']);  
Route::get('/doanhthuthang', [QLBaoCaoController::class, 'doanhthuthang']);  