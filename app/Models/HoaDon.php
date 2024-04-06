<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaiKhoan;

class HoaDon extends Model
{
    protected $table = 'hoadon';
    protected $fillable = ['ghichu', 'tongtien', 'ban', 'tai_khoan_id'];
    // protected $primaryKey = 'id';
    public $timestamps = false;
    public function TaiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class);
    }
    public function SanPham()
    {
        return $this->belongsToMany(SanPham::class, 'chitiethoadon')->withPivot('san_pham_id')->onDelete('cascade');
    }
}