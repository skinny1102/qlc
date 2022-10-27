<?php

namespace App\Http\Controllers;

use App\Models\CayCanh;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\NhanVien;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
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
        $data = Session::get('user');
        if (is_null($data)) {
            return redirect('login');
        } else {

            $counthoadon = HoaDon::count();
            $countnhanvien = NhanVien::count();
            $countkhachhang = KhachHang::count();
            $countcaycanh = CayCanh::count();



            return view('home/home')
            ->with(compact('counthoadon'))
            ->with(compact('countnhanvien'))
            ->with(compact('countkhachhang'))
            ->with(compact('countcaycanh'))
            ;
        }
    }
}
