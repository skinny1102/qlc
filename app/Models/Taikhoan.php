<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Taikhoan extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'MaNhanVien',
    ];
    protected $primaryKey = 'id';
    protected $table = 'taikhoan';
}
