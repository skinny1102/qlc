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
        'MaHoaDon',
        'MaCay',
        'SoLuong',
        'DonGia'
    ];
    protected $primaryKey = 'MaChiTietHoaDon';
    protected $table = 'chitiethoadon';
}
