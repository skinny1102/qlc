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

class QLBaoCaoController extends Controller
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
            ->get();
        $nhanvienAll =  DB::table('nhanvien')->get();
        return view('quanlybaocaothongke/mh-home')->with(compact('hoadonAll'))->with(compact('nhanvienAll'));
    }

    public function doanhthuthang(Request $request)
    {
        $data = $request->all();
        $dateTo = $data['dateTo'];
        $dateFrom = $data['dateFrom'];
        $data = DB::table('hoadon')
            ->selectRaw('
        hoadon.Ngayban as NgayBan,
        hoadon.MaHoaDon as  MaHoaDon,
        hoadon.TongTien  as TongTien,
        nhanvien.TenNhanVien as TenNhanVien,
        SUM(chitiethoadon.SoLuong) as SoLuong 
         ')
         ->leftJoin('nhanvien', 'nhanvien.MaNhanVien', '=', 'hoadon.MaNhanVien')
            ->leftJoin('chitiethoadon', 'chitiethoadon.MaHoaDon', '=', 'hoadon.MaHoaDon')
            ->whereBetween('hoadon.Ngayban', [$dateTo, $dateFrom])
            ->where('hoadon.inhoadon',1)
            ->groupBy('hoadon.Ngayban', 'hoadon.MaHoaDon', 'hoadon.TongTien','nhanvien.TenNhanVien')
            ->get();
            $user= Session::get('user');
        view()->share('hoadon',$data);
        view()->share('dateTo', $dateTo);
        view()->share('dateFrom',$dateFrom);
        $pdf = Pdf::loadView('file-baocaodoanhthu');
        return $pdf->download('pdf_file.pdf');;
    }

    public function baocaotheongay(Request $request)
    {
        $data = $request->all();
        $dateChoose = $data['dateChoose'];
        $data = DB::table('hoadon')
            ->selectRaw('
        hoadon.Ngayban as NgayBan,
        hoadon.MaHoaDon as  MaHoaDon,
        hoadon.TongTien  as TongTien,
        nhanvien.TenNhanVien as TenNhanVien,
        SUM(chitiethoadon.SoLuong) as SoLuong 
         ')
         ->leftJoin('nhanvien', 'nhanvien.MaNhanVien', '=', 'hoadon.MaNhanVien')
            ->leftJoin('chitiethoadon', 'chitiethoadon.MaHoaDon', '=', 'hoadon.MaHoaDon')
            // ->where( `date_format(hoadon.Ngayban, '%Y-%m-%d')`, $dateChoose)
            ->whereRaw(DB::raw("DATE_FORMAT(`hoadon`.`Ngayban`, '%Y-%m-%d') = '$dateChoose'"))
            // 
            ->where('hoadon.inhoadon',1)
            ->groupBy('hoadon.Ngayban', 'hoadon.MaHoaDon', 'hoadon.TongTien','nhanvien.TenNhanVien')
            ->get();
            $user= Session::get('user');
        view()->share('hoadon',$data);
        view()->share('dateChoose', $dateChoose);
        $pdf = Pdf::loadView('file-baocaotheongay');
        return $pdf->download('pdf_file.pdf');;
    }
}
