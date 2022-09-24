<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LoaiCay extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'TenLoaiCay',
    ];
    protected $primaryKey = 'MaLoaiCay';
    protected $table = 'loaicay';
}
