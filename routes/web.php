<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QLKhachHangController;
use App\Http\Controllers\QLMatHangController;
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