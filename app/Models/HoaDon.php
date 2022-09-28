<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CayCanh extends Model
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
        'inhoadon'
    ];
    protected $primaryKey = 'MaHoaDon';
    protected $table = 'hoadon';
}
