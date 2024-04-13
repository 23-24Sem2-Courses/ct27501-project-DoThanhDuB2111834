<?php

namespace App\controllers\Auth;

use App\controllers\Controller;
use App\SessionGuard as Guard;
use App\Models\TaiKhoan;

class UserController extends Controller 
{
    public function __construct()
    {
        if (!Guard::isTaiKhoanLoggedIn()) {
            redirect('/login');
        }

        parent::__construct();
    }

    public function index()
    {
        
        $this->sendPage('Auth/user' ,[
            'user' => TaiKhoan::get()
        ]);
    }
    public function edit($userId)
    {
        $user = TaiKhoan::find($userId);
        if (!$user)
            redirect('/User', ['message' => 'Tài khoản không tồn tại']);

            $data = [
                'user' => $user,
                
                'errors' => session_get_once('errors'),
                'message' => session_get_once('message'),
                'old' => $this->getSavedFormValues()
            ];
        $this->sendPage('/Auth/edit', $data);
    }
    protected function filterUserData(array $data)
    {
        return [
            'tennv' => $data['hoten'] ?? null,
            
            'diachi' => $data['diachi'] ?? null,
            'gioitinhnv' => $data['gioitinh'] ?? null,
            'role' => $data['vaitro'] ?? null
            
        ];
    }
    public function update($id)
    {
        // Tìm sản phẩm theo id
        $user = TaiKhoan::find($id);

        $data = $this->filterUserData($_POST);
        $model_errors = TaiKhoan::validate_edit($data);

        if (!empty($model_errors)) {
            $this->saveFormValues($data);
            redirect("/User/edit/$id", ['errors' => $model_errors]);
        }
        

        $fillData = [
            'tennv' => $data['tennv'],
            'diachi' => $data['diachi'],
            'role' => $data['role'],
            'gioitinhnv' => $data['gioitinhnv']
        ];
        $user->fill($fillData);

        $user->save();

        redirect('/User', ['message' => 'Cập nhật tài khoản thành công']);
    }
    public function destroy($id)
    {
        $user = TaiKhoan::find($id);

        if (!$user)
            redirect('/User', ['message' => 'Tài khoản không tồn tại']);

        

        
        $user->delete();

        redirect('/User', ['message' => 'Xóa tài khoản thành công']);
    }
}