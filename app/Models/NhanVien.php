<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class NhanVien extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'TenNhanVien',
        'GioiTinh',
        'DiaChi',
        'DienThoai',
        'NgaySinh',
    ];
    protected $primaryKey = 'MaNhanVien';
    protected $table = 'nhanvien';
}
