<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\HoaDon;
Class TaiKhoan extends Model 
{
    protected $table = 'taikhoan';
    protected $fillable = ['tendangnhap', 'matkhau', 'tennv', 'diachi', 'gioitinhnv', 'role'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function HoaDon()
    {
        return $this->hasMany(HoaDon::class);
    }
    public static function validate(array $data)
    {
        $errors = [];

        if (!$data['tendangnhap']) {
            $errors['tendangnhap'] = 'Lỗi tên đăng nhập.';
        } elseif (static::where('tendangnhap', $data['tendangnhap'])->count() > 0) {
            $errors['tendangnhap'] = 'Tên đăng nhập đã tồn tại.';
        }

        if (strlen($data['matkhau']) < 6) {
            $errors['matkhau'] = 'Mật khẩu phải có ít nhất 6 ký tự.';
        } elseif ($data['matkhau'] != $data['checkmatkhau']) {
            $errors['matkhau'] = 'Xác nhận mật khẩu không chính xác.';
        }

        return $errors;
    }
    public static function validate_edit(array $data)
    {
        $errors = [];

        

        if (strlen($data['tennv']) =="") {
            $errors['tennv'] = 'Không được bỏ trống tên.';
        }

        if (strlen($data['diachi']) =="") {
            $errors['diachi'] = 'Không được bỏ trống địa chỉ.';
        }

        return $errors;
    }

}