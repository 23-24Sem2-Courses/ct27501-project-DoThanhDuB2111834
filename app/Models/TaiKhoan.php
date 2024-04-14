<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\HoaDon;
use App\SessionGuard as Guard;
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
    public static function validatepass(array $data)
    {
        $errors = [];

        

        if ($data['matkhauht'] !==Guard::TaiKhoan()->matkhau ){
            $errors['matkhauht'] = 'Sai mật khẩu.';
        }elseif(strlen($data['matkhaumoi']) < 6) {
            $errors['matkhaumoi'] = 'Mật khẩu phải có ít nhất 6 ký tự.';
        }elseif ($data['matkhaumoi'] != $data['matkhaumoicheck']) {
            $errors['matkhaumoicheck'] = 'Xác nhận mật khẩu không chính xác.';
        }

        return $errors;
    }
}