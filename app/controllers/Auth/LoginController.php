<?php

namespace App\controllers\Auth;

use App\controllers\Controller;
use App\Models\TaiKhoan;
use App\SessionGuard as Guard;

class LoginController extends Controller 
{
    public function create()
    {
        if (Guard::isTaiKhoanLoggedIn()) {
            redirect('/home');
        }

        $data = [
            'messages' => session_get_once('messages'),
            'old' => $this->getSavedFormValues(),
            'errors' => session_get_once('errors')
        ];

        $this->sendPage('auth/login', $data);
    }

    public function store()
    {
        $user_credentials = $this->filterUserCredentials($_POST);

        $errors = [];
        $user = TaiKhoan::where('tendangnhap', $user_credentials['tendangnhap'])->first();
        if (!$user) {
            // Người dùng không tồn tại...
            $errors['tendangnhap'] = 'Sai tên đăng nhập';
        } else if (Guard::login($user, $user_credentials)) {
            // Đăng nhập thành công...
            redirect('/TongQuan');
        } else {
            // Sai mật khẩu...
            $errors['matkhau'] = 'Sai mật khẩu.';
        }

        // Đăng nhập không thành công: lưu giá trị trong form, trừ password
        $this->saveFormValues($_POST, ['matkhau']);
        redirect('/login', ['errors' => $errors]);
    }

    protected function filterUserCredentials(array $data)
    {
        return [
            // 'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
            'tendangnhap' => $data['tendangnhap'],
            'matkhau' => $data['matkhau'] ?? null
        ];
    }

    public function destroy()
    {
        Guard::logout();
        redirect('/login');
    }

}