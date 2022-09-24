<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QLNhanVienController extends Controller
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
        
        $nhanvienAll =  DB::table('nhanvien')->orderBy('created_at', 'desc')->get()->toArray();
        return view('quanlynhanvien/mh-nhanvien')->with(compact('nhanvienAll'));
    }
    public function themNhanVien(Request $request)
    {
        $data = $request;
        $nhanvien = new NhanVien();
        $nhanvien->TenNhanVien =  $data->TenNhanVien;
        $nhanvien->GioiTinh =  $data->GioiTinh;
        $nhanvien->DiaChi =  $data->DiaChi;
        $nhanvien->DienThoai =  $data->DienThoai;
        $nhanvien->NgaySinh =  $data->NgaySinh;
        $nhanvien->save();
        return $nhanvien;
    }
    

    public function xoaNhanVien(Request $request)
    {
        DB::delete('delete from nhanvien where MaNhanVien = :MaNhanVien', ['MaNhanVien' => $request['MaNhanVien']]);
        return redirect('/ql-nhanvien');;
    }
    public  function updateNhanVien(Request $request, $id ){
        $nhanvienarr = DB::table('nhanvien')->where('MaNhanVien',  $id)->get();
        $nhanvien = $nhanvienarr[0];
        return view('quanlynhanvien/edit-nhanvien')->with(compact('nhanvien'));
    }
    public function suanhanvien(Request $request, $id){
  
        $nhanvien =  NhanVien::find($id);
        $data = $request->all();
        $nhanvien->TenNhanVien = $data['TenNhanVien'];
        $nhanvien->GioiTinh =  $data['GioiTinh'];
        $nhanvien->DiaChi = $data['DiaChi'];
        $nhanvien->DienThoai = $data['DienThoai'];
        $nhanvien->NgaySinh = $data['NgaySinh'];
        $nhanvien->save();
        return redirect('/ql-nhanvien');
    }

    public function searchNhanVien(Request $request)
    {
        if (is_null($request['keyword'])) {
            return redirect('/ql-nhanvien');
        }

         $nhanvienAll =  DB::table('nhanvien')
         ->where('MaNhanVien', 'like', '%' . $request['keyword'] . '%')
         ->orWhere('TenNhanVien', 'like', '%' . $request['keyword'] . '%')
         ->orderBy('created_at', 'desc')->get()->toArray();
        return view('quanlynhanvien/mh-nhanvien')->with(compact('nhanvienAll'));
    }
}
