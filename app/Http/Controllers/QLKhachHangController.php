<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QLKhachHangController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $khachhangAll =  DB::table('khachhang')->orderBy('created_at', 'desc')->get()->toArray();
        return view('quanlykhachhang/mh-home')->with(compact('khachhangAll'));
    }
    public function themKhachHang(Request $request)
    {
        $data = $request;
        $khachhang = new KhachHang();
        $khachhang->TenKhachHang =  $data->TenKhachHang;
        $khachhang->GioiTinh =  $data->GioiTinh;
        $khachhang->DiaChi =  $data->DiaChi;
        $khachhang->DienThoai =  $data->DienThoai;
        $khachhang->save();
        return $khachhang;
    }
    

    public function xoaKhachHang(Request $request)
    {
        DB::delete('delete from khachhang where MaKhachHang = :MaKhachHang', ['MaKhachHang' => $request['MaKhachHang']]);
        return redirect('/ql-khachhang');;
    }
    public  function updateKhachHang(Request $request, $id ){
        $khachhangarr = DB::table('khachhang')->where('MaKhachHang',  $id)->get();
        $khachhang = $khachhangarr[0];
        return view('quanlykhachhang/edit-khachhang')->with(compact('khachhang'));
    }
    public function suakhachang(Request $request, $id){
  
        $khachahng =  KhachHang::find($id);
        $data = $request->all();
        $khachahng->TenKhachHang = $data['TenKhachHang'];
        $khachahng->GioiTinh =  $data['GioiTinh'];
        $khachahng->DiaChi = $data['DiaChi'];
        $khachahng->DienThoai = $data['DienThoai'];
        $khachahng->save();
        return redirect('/ql-khachhang');
    }

    public function searchKhachHang(Request $request)
    {
        if (is_null($request['keyword'])) {
            return redirect('/ql-khachhang');
        }

         $khachhangAll =  DB::table('khachhang')
         ->where('MaKhachHang', 'like', '%' . $request['keyword'] . '%')
         ->orWhere('TenKhachHang', 'like', '%' . $request['keyword'] . '%')
         ->orderBy('created_at', 'desc')->get()->toArray();
        return view('quanlykhachhang/mh-home')->with(compact('khachhangAll'));
    }
}
