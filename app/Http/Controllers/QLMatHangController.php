<?php

namespace App\Http\Controllers;

use App\Models\CayCanh;
use App\Models\LoaiCay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Message;
use Throwable;

class QLMatHangController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dieuhuong()
    {
        return redirect('ql-mathang/loaicay');
    }

    public function index()
    {
        $loaicayAll =  DB::table('loaicay')->orderBy('created_at', 'desc')->get()->toArray();
        return view('quanlymathang/mh-home')->with(compact('loaicayAll'));
    }

    public function themLoaiCay(Request $request)
    { /// Dang dung jquery ajax
        $data = $request;
        $loaicay = new LoaiCay();
        $loaicay->TenLoaiCay =  $data->TenLoaiCay;
        $loaicayFind = DB::table('loaicay')->where('TenLoaiCay', $data->TenLoaiCay)->get()->toArray();
        if (count($loaicayFind)) {
            $message = '{code:400 , message:"Đã tồn tại loại cây"}';
            return  $message;
        } else {
            $loaicay->save();
            return $loaicay;
        }
    }

    public function xoaLoaiCay(Request $request)
    {
        DB::delete('delete from loaicay where MaLoaiCay = :MaLoaiCay', ['MaLoaiCay' => $request['MaLoaiCay']]);
        return redirect('/ql-mathang');;
    }


    public function suaLoaiCay(Request $request)
    {
        $data = $request;
        $loaicayFind = DB::table('loaicay')->where('TenLoaiCay', $data->TenLoaiCay)->get()->toArray();
        if (count($loaicayFind)) {
            $message = '{code:400 , message:"Đã tồn tại loại cây"}';
            return  $message;
        } else {
            $loaicay =  DB::table('loaicay')->where('MaLoaiCay', $data->MaLoaiCay)->update(array(
                'username' => $data->TenLoaiCay,
            ));
            return $loaicay;
        }
    }

    public function CayCanh(Request $request)
    {
        $loaicayAll =  DB::table('loaicay')->orderBy('created_at', 'desc')->get()->toArray();
        $caycanhAll =  DB::table('caycanh')
            ->select([
                'MaCay', 'TenCay', 'SoLuong',
                'DonGiaBan', 'XuatXu', 'MoTa', 'loaicay.TenLoaiCay'
            ])
            ->leftJoin('loaicay', 'loaicay.MaLoaiCay', 'caycanh.MaLoaiCay')
            ->get()->toArray();
        return view('quanlymathang/mh-caycanh')->with(compact('loaicayAll'))->with(compact('caycanhAll'));
    }

    public function xoaCayCanh(Request $request)
    {
        DB::delete('delete from caycanh where MaCay = :MaCay', ['MaCay' => $request['MaCay']]);
        return redirect('/ql-mathang/caycanh');;
    }


    public function themCayCanh(Request $request)
    {
        $data = $request;
        $caycanh = new CayCanh();
        $caycanh->TenCay =  $data->TenCay;
        $caycanh->SoLuong =  $data->SoLuong;
        $caycanh->DonGiaBan =  $data->DonGiaBan;
        $caycanh->XuatXu =  $data->XuatXu;
        $caycanh->MoTa =  $data->MoTa;
        $caycanh->HuongDan =  $data->HuongDan;
        $caycanh->MaLoaiCay =  $data->MaLoaiCay;


        $cayFind = DB::table('caycanh')->where('TenCay', $data->TenCay)->get()->toArray();
        if (count($cayFind)) {
            $message = '{code:400 , message:"Đã tồn tại  cây"}';
            return  $message;
        } else {
            $caycanh->save();
            return $caycanh;
        }
    }
    public function detailCayCanh(Request $request, $id)
    {
        $caycanharr = DB::table('caycanh')->where('MaCay',  $id)->get();
        $caycanh = $caycanharr[0];
        $loaicayAll =  DB::table('loaicay')->orderBy('created_at', 'desc')->get()->toArray();
        return view('quanlymathang/edit-caycanh')->with(compact('caycanh'))->with(compact('loaicayAll'));
    }

    public function updateCayCanh(Request $request, $id)
    {
        $caycanh =  CayCanh::find($id);
        $data = $request->all();
        $caycanh->TenCay = $data['TenCay'];
        $caycanh->SoLuong =  $data['SoLuong'];
        $caycanh->DonGiaBan = $data['DonGiaBan'];
        $caycanh->XuatXu =  $data['XuatXu'];
        $caycanh->MoTa = $data['MoTa'];
        $caycanh->HuongDan = $data['HuongDan'];
        $caycanh->MaLoaiCay = $data['MaLoaiCay'];
        $caycanh->save();
        return redirect('/ql-mathang/caycanh');
    }
    public function searchLoaiCay(Request $request)
    {
        if (is_null($request['keyword'])) {
            return redirect('ql-mathang/loaicay');
        }
        $loaicayAll =  DB::table('loaicay')
        ->where('MaLoaicay', 'like', '%' . $request['keyword'] . '%')
        ->orWhere('TenLoaicay', 'like', '%' . $request['keyword'] . '%')
        ->orderBy('created_at', 'desc')->get()->toArray();

        return view('quanlymathang/mh-home')->with(compact('loaicayAll'));
    }

    public function searchCayCanh(Request $request)
    {
        if (is_null($request['keyword'])) {
            return redirect('ql-mathang/caycanh');
        }
        $loaicayAll =  DB::table('loaicay')->orderBy('created_at', 'desc')->get()->toArray();
        $caycanhAll =  DB::table('caycanh')
            ->select([
                'MaCay', 'TenCay', 'SoLuong',
                'DonGiaBan', 'XuatXu', 'MoTa', 'loaicay.TenLoaiCay'
            ])
            ->leftJoin('loaicay', 'loaicay.MaLoaiCay', 'caycanh.MaLoaiCay')
            ->where('MaCay', 'like', '%' . $request['keyword'] . '%')->orWhere('TenCay', 'like', '%' . $request['keyword'] . '%')
            ->get()->toArray();
        return  view('quanlymathang/mh-caycanh')->with(compact('loaicayAll'))->with(compact('caycanhAll'));
    }
}
