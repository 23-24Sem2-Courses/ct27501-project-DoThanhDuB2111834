<?php

namespace App;

use App\Models\TaiKhoan;

class SessionGuard
{
    protected static $TaiKhoan;

    public static function login(TaiKhoan $taiKhoan, array $credentials)
    {
        // $verified = password_verify($credentials['matkhau'], $taiKhoan->matkhau);
        $verified = ($credentials['matkhau'] == $taiKhoan->matkhau);
        if ($verified) {
            $_SESSION['taiKhoan_id'] = $taiKhoan->id;
        }
        return $verified;
    }

    public static function TaiKhoan()
    {
        if (!static::$TaiKhoan && static::isTaiKhoanLoggedIn()) {
            static::$TaiKhoan = TaiKhoan::find($_SESSION['taiKhoan_id']);
        }
        return static::$TaiKhoan;
    }

    public static function logout()
    {
        static::$TaiKhoan = null;
        session_unset();
        session_destroy();
    }

    public static function isTaiKhoanLoggedIn()
    {
        return isset($_SESSION['taiKhoan_id']);
    }
}