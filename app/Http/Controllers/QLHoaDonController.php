<?php

namespace App\Http\Controllers;

use App\Models\CayCanh;
use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class QLHoaDonController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function xuatpdf(Request $request, $id)
    {
        $hoadonAll =  DB::table('hoadon')
            ->selectRaw('nhanvien.TenNhanVien as TenNhanVien ,
    khachhang.TenKhachHang as TenKhachHang ,
    khachhang.DiaChi as DiaChi ,
    khachhang.DienThoai as DienThoai ,
    khachhang.MaKhachHang as MaKhachHang ,
    hoadon.NgayBan as NgayBan ,
    hoadon.TongTien as TongTien,
    hoadon.MaHoaDon as MaHoaDon, 
    hoadon.inhoadon as inhoadon ,
    nhanvien.MaNhanVien as MaNhanVien,
    nhanvien.TenNhanVien as TenNhanVien
      ')
            ->leftJoin('nhanvien', 'hoadon.MaNhanVien', '=', 'nhanvien.MaNhanVien')
            ->leftJoin('khachhang', 'hoadon.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->where('MaHoaDon',  $id)->get();
        $hoadon = $hoadonAll[0];

        $chitietAll =  DB::table('chitiethoadon')
            ->selectRaw('
        chitiethoadon.MaChiTietHoaDon as MaChiTietHoaDon ,
        chitiethoadon.MaHoaDon as MaHoaDon ,
     caycanh.TenCay as TenCay ,
     caycanh.MaCay as MaCay ,
     caycanh.DonGiaBan as DonGiaBan,
     chitiethoadon.SoLuong as SoLuong, 
     chitiethoadon.DonGia as DonGia 
       ')
            ->leftJoin('caycanh', 'caycanh.MaCay', '=', 'chitiethoadon.MaCay')
            ->leftJoin('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
            ->where('chitiethoadon.MaHoaDon',  $id)->get();

            $hoadonUpdate =  HoaDon::find($id);
            $hoadonUpdate->inhoadon = 1;
            $hoadonUpdate->save();
        view()->share('hoadon', $hoadon);
        view()->share('chitietAll', $chitietAll);
        $pdf = Pdf::loadView('file');
        return   $pdf->download('pdf_file.pdf');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $hoadonAll =  DB::table('hoadon')
            ->selectRaw('nhanvien.TenNhanVien as TenNhanVien ,
        khachhang.TenKhachHang as TenKhachHang ,
        hoadon.NgayBan as NgayBan ,
        hoadon.TongTien as TongTien,
         hoadon.MaHoaDon as MaHoaDon, 
         hoadon.inhoadon as inhoadon 
         ')
            ->leftJoin('nhanvien', 'hoadon.MaNhanVien', '=', 'nhanvien.MaNhanVien')
            ->leftJoin('khachhang', 'hoadon.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->orderBy('hoadon.created_at', 'desc')
            ->get();
            $user= Session::get('user');
            $userCurrent =  $user[0];
            $khachhangAll =  DB::table('khachhang')->orderBy('created_at', 'desc')->get()->toArray();
        return view('quanlyhoadon/mh-home')->with(compact('hoadonAll'))->with(compact('userCurrent'))->with(compact('khachhangAll'));
    }

    public function themhoandon(Request $request)
    {
        $hoadon = new HoaDon();
        $hoadon->MaNhanVien =  $request->MaNhanVien;
        $hoadon->MaKhachHang =  $request->MaKhachHang;
        $hoadon->TongTien =  $request->TongTien;
        $hoadon->inhoadon = false;
        $hoadon->NgayBan = $request->NgayLap;
        $hoadon->save();
        $hoadon->MaHoaDon;
        $chitiet =  $request->chitiet;

        // {MaCay: '6', SoLuong: '123', DonGia: '1230000'}
        for ($x = 0; $x < count($chitiet); $x++) {
            $chitiethoadon = new ChiTietHoaDon();

            $chitiethoadon->MaHoaDon =  $hoadon->MaHoaDon;
            $chitiethoadon->MaCay = $chitiet[$x]['MaCay'];
            $chitiethoadon->SoLuong = $chitiet[$x]['SoLuong'];
            $chitiethoadon->DonGia = $chitiet[$x]['DonGia'];
            $chitiethoadon->save();
        }
        // $cthd = $chitiet[0];
        return $hoadon;
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


    public function xoahoadon(Request $request)
    {
        DB::delete('delete from hoadon where MaHoaDon = :MaHoaDon', ['MaHoaDon' => $request['MaHoaDon']]);
        return redirect('/ql-hoadon');;
    }
    public  function edithoadon(Request $request, $id)
    {

        $hoadonAll =  DB::table('hoadon')
            ->selectRaw('nhanvien.TenNhanVien as TenNhanVien ,
        khachhang.TenKhachHang as TenKhachHang ,
        khachhang.MaKhachHang as MaKhachHang ,
        hoadon.NgayBan as NgayBan ,
        hoadon.TongTien as TongTien,
        hoadon.MaHoaDon as MaHoaDon, 
        hoadon.inhoadon as inhoadon ,
        nhanvien.MaNhanVien as MaNhanVien
          ')
            ->leftJoin('nhanvien', 'hoadon.MaNhanVien', '=', 'nhanvien.MaNhanVien')
            ->leftJoin('khachhang', 'hoadon.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->where('MaHoaDon',  $id)->get();
        $hoadon = $hoadonAll[0];

        $chitietAll =  DB::table('chitiethoadon')
            ->selectRaw('
            chitiethoadon.MaChiTietHoaDon as MaChiTietHoaDon ,
            chitiethoadon.MaHoaDon as MaHoaDon ,
         caycanh.TenCay as TenCay ,
         caycanh.MaCay as MaCay ,
         caycanh.DonGiaBan as DonGiaBan,
         chitiethoadon.SoLuong as SoLuong, 
         chitiethoadon.DonGia as DonGia 
           ')
            ->leftJoin('caycanh', 'caycanh.MaCay', '=', 'chitiethoadon.MaCay')
            ->leftJoin('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
            ->where('chitiethoadon.MaHoaDon',  $id)->get();

        $nhanvienAll =  DB::table('nhanvien')->orderBy('created_at', 'desc')->get()->toArray();
        // dd( $nhanvienAll);
        $khachhangAll =  DB::table('khachhang')->orderBy('created_at', 'desc')->get()->toArray();


        $caycanhAll = DB::table('caycanh')->get();

        return view('quanlyhoadon/edit-hoadon')->with(compact('hoadon'))
            ->with(compact('chitietAll'))
            ->with(compact('nhanvienAll'))
            ->with(compact('khachhangAll'))
            ->with(compact('caycanhAll'));
    }
    public function suanhanvien(Request $request, $id)
    {

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
    public  function suahoadon(Request $request, $id)
    {

        $hoadon =  HoaDon::find($id);
        $data = $request->all();
        $hoadon->MaNhanVien = $data['MaNhanVien'];
        $hoadon->MaKhachHang =  $data['MaKhachHang'];
        $hoadon->save();
        return redirect('edithoadon/' . $hoadon->MaHoaDon);
    }
    public function themchitiet(Request $request)
    {

        $data = $request->all();
        $MaCay = $data['MaCay'];
        $CayCanh =  CayCanh::find($MaCay);
        $DonGia =  $CayCanh->DonGiaBan * $data['SoLuong'];
        $chitiet = new ChiTietHoaDon();
        $chitiet->MaHoaDon = $data['MaHoaDon'];
        $chitiet->MaCay = $data['MaCay'];
        $chitiet->DonGia =  $DonGia;
        $chitiet->SoLuong = $data['SoLuong'];
        $chitiet->save();
        // update tong tin hoa don
        $hoadon =  HoaDon::find($data['MaHoaDon']);
        $Tongtien = $hoadon->TongTien;
        $TongtienUpdate =  $Tongtien + $DonGia;
        $hoadon->TongTien =  $TongtienUpdate;
        $hoadon->save();
        return redirect('edithoadon/' . $data['MaHoaDon']);
    }
    public function xoachitiethoadon(Request $request)
    {
        $chitiethoadon = ChiTietHoaDon::find($request['MaChiTietHoaDon']);
        $mahoadon = $chitiethoadon->MaHoaDon;
        $hoadon = HoaDon::find($mahoadon);
        $tienupdate  = $hoadon->TongTien - $chitiethoadon->DonGia;
        $hoadon->TongTien = $tienupdate;
        $hoadon->save();
        DB::delete('delete from chitiethoadon where MaChiTietHoaDon = :MaChiTietHoaDon', ['MaChiTietHoaDon' => $request['MaChiTietHoaDon']]);
        return redirect('edithoadon/' . $mahoadon);
    }
    public function chitiethoadon(Request $request, $id)
    {
        $chitiethoadon = ChiTietHoaDon::find($id);
        return  $chitiethoadon;
    }
    public function suachitiethoadon(Request $request)
    {
        $data = $request->all();

        $chitiet = ChiTietHoaDon::find($data['MaChiTietHoaDon']);
        $CayCanh = CayCanh::find($data['MaCay']);
        $hoadon = HoaDon::find($chitiet->MaHoaDon);
        $hoadon->TongTien =  $hoadon->TongTien -  $chitiet->DonGia;
        $DonGia = $CayCanh->DonGiaBan * $data['SoLuong'];

        $chitiet->DonGia = $DonGia;
        $chitiet->MaCay = $data['MaCay'];
        $chitiet->SoLuong = $data['SoLuong'];
        $hoadon->TongTien =  $hoadon->TongTien + $DonGia;
        $hoadon->save();
        $chitiet->save();
        return redirect('edithoadon/' . $hoadon->MaHoaDon);
    }
    public  function inhoadon(Request $request, $id)
    {
        $hoadonAll =  DB::table('hoadon')
            ->selectRaw('nhanvien.TenNhanVien as TenNhanVien ,
        khachhang.TenKhachHang as TenKhachHang ,
        khachhang.DiaChi as DiaChi ,
        khachhang.DienThoai as DienThoai ,
        khachhang.MaKhachHang as MaKhachHang ,
        hoadon.NgayBan as NgayBan ,
        hoadon.TongTien as TongTien,
        hoadon.MaHoaDon as MaHoaDon, 
        hoadon.inhoadon as inhoadon ,
        nhanvien.MaNhanVien as MaNhanVien,
        nhanvien.TenNhanVien as TenNhanVien
          ')
            ->leftJoin('nhanvien', 'hoadon.MaNhanVien', '=', 'nhanvien.MaNhanVien')
            ->leftJoin('khachhang', 'hoadon.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->where('MaHoaDon',  $id)->get();
        $hoadon = $hoadonAll[0];

        $chitietAll =  DB::table('chitiethoadon')
            ->selectRaw('
            chitiethoadon.MaChiTietHoaDon as MaChiTietHoaDon ,
            chitiethoadon.MaHoaDon as MaHoaDon ,
         caycanh.TenCay as TenCay ,
         caycanh.MaCay as MaCay ,
         caycanh.DonGiaBan as DonGiaBan,
         chitiethoadon.SoLuong as SoLuong, 
         chitiethoadon.DonGia as DonGia 
           ')
            ->leftJoin('caycanh', 'caycanh.MaCay', '=', 'chitiethoadon.MaCay')
            ->leftJoin('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
            ->where('chitiethoadon.MaHoaDon',  $id)->get();

        $nhanvienAll =  DB::table('nhanvien')->orderBy('created_at', 'desc')->get()->toArray();
        // dd( $nhanvienAll);
        $khachhangAll =  DB::table('khachhang')->orderBy('created_at', 'desc')->get()->toArray();


        $caycanhAll = DB::table('caycanh')->get();

        return view('quanlyhoadon/in-hoadon')
            ->with(compact('hoadon'))
            ->with(compact('chitietAll'))
            ->with(compact('nhanvienAll'))
            ->with(compact('khachhangAll'))
            ->with(compact('caycanhAll'));
    }
    public function searchhoadon(Request $request)
    {
        if (is_null($request['keyword'])) {
            return redirect('/ql-hoadon');
        }
        $hoadonAll =  DB::table('hoadon')
            ->selectRaw('nhanvien.TenNhanVien as TenNhanVien ,
                khachhang.TenKhachHang as TenKhachHang ,
                hoadon.NgayBan as NgayBan ,
                hoadon.TongTien as TongTien,
                hoadon.MaHoaDon as MaHoaDon, 
                hoadon.inhoadon as inhoadon 
                ')
            ->leftJoin('nhanvien', 'hoadon.MaNhanVien', '=', 'nhanvien.MaNhanVien')
            ->leftJoin('khachhang', 'hoadon.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->where('MaHoaDon', 'like', '%' . $request['keyword'] . '%')
            ->get();
        return view('quanlyhoadon/mh-home')->with(compact('hoadonAll'));
    }
}
