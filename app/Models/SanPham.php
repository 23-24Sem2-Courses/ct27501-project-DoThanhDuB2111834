<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'sanpham';
    protected $fillable = ['tensp', 'giasp', 'motasp', 'imgsp'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function HoaDon()
    {
        return $this->belongsToMany(HoaDon::class, 'chitiethoadon')->withPivot('hoa_don_id');
    }

}