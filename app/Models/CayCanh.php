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
        'TenCay',
        'SoLuong',
        'DonGiaBan',
        'XuatXu',
        'Mota',
        'MaLoaiCay',
        'HuongDan'
    ];
    protected $primaryKey = 'MaCay';
    protected $table = 'caycanh';
}
