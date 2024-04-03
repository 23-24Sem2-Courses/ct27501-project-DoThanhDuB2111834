<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\HoaDon;
Class TaiKhoan extends Model 
{
    protected $table = 'taikhoan';
    protected $fillable = ['tendangnhap', 'matkhau', 'tennv', 'diachi', 'gioitinhnv', 'role'];
    protected $primaryKey = 'id';

    public function HoaDon()
    {
        return $this->hasMany(HoaDon::class);
    }

}