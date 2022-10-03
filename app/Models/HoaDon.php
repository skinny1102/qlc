<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class HoaDon extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'MaNhanVien',
        'MaKhachHang',
        'NgayBan',
        'inhoadon',
        'TongTien'
    ];
    protected $primaryKey = 'MaHoaDon';
    protected $table = 'hoadon';
}
