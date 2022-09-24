<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class KhachHang extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'TenKhachHang',
        'GioiTinh',
        'DiaChi',
        'DienThoai'
    ];
    protected $primaryKey = 'MaKhachHang';
    protected $table = 'khachhang';
}
