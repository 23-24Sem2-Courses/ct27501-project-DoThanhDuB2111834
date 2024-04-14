<?php

namespace App\controllers\Auth;

use App\controllers\Controller;
use App\SessionGuard as Guard;
use App\Models\TaiKhoan;

class AddNewAccountController extends Controller 
{
    public function __construct()
    {
        if (!Guard::isTaiKhoanLoggedIn()) {
            redirect('/login');
        }
        if(!Guard::TaiKhoan()->isAdmin()){
            redirect('/TongQuan', ['message' => 'Xin lỗi bạn cần có quyền admin để sử dụng chức năng này']);
        }

        parent::__construct();
    }

    public function index()
    {
        $this->sendPage('Auth/registration');
    }
    // public function store()
    // {
    //     $ten=$_POST['hoten'];
    //     $diachi=$_POST['diachi'];
    //     $tendangnhap=$_POST['tendangnhap'];
    //     $matkhau=$_POST['matkhau'];
    //     $gioitinh=$_POST['gioitinh'];
    //     $vaitro=$_POST['vaitro'];
        
    //     $taikhoan=TaiKhoan::all();

    //     foreach($taikhoan as $tk){
    //         if($tk->tendangnhap===$tendangnhap)
    //             echo 'abc';
            
    //     }
    //     $tknew= new TaiKhoan(['tendangnhap'=>$tendangnhap,'tennv'=>$ten,'diachi'=>$diachi,'gioitinhnv'=>$gioitinh,'role'=>$vaitro,'matkhau'=>$matkhau]);
    //     $tknew->save();
    //         redirect('/AddAccount');
        

        
        
        
        
    // }
    public function create()
    {
        $data = [
            'old' => $this->getSavedFormValues(),
            'errors' => session_get_once('errors'),
            'message' => session_get_once('message')
        ];

        $this->sendPage('Auth/registration', $data);
    }
    protected function filterUserData(array $data)
    {
        return [
            'tennv' => $data['hoten'] ?? null,
            'tendangnhap' => $data['tendangnhap'] ?? null,
            'matkhau' => $data['matkhau'] ?? null,
            'diachi' => $data['diachi'] ?? null,
            'gioitinhnv' => $data['gioitinh'] ?? null,
            'role' => $data['vaitro'] ?? null,
            'checkmatkhau' => $data['checkmatkhau'] ?? null
        ];
    }

    protected function createUser($data)
    {
        return TaiKhoan::create([
            'tendangnhap' => $data['tendangnhap'],
            'matkhau' => $data['matkhau'],
            'tennv' => $data['tennv'],
            'diachi' => $data['diachi'],
            'gioitinhnv' => $data['gioitinhnv'],
            'role' => $data['role'] 
            
        ]);
    }
    public function store()
    {
        $this->saveFormValues($_POST, ['matkhau', 'checkmatkhau']);

        $data = $this->filterUserData($_POST);
        $model_errors = TaiKhoan::validate($data);
        var_dump($model_errors);
        if (empty($model_errors)) {
            // Dữ liệu hợp lệ...
            $this->createUser($data);

            $messages = ['success' => 'Tạo tài khoản thành công.'];
            redirect('/User', ['messages' => $messages]);
        }

        // Dữ liệu không hợp lệ...
        redirect('/AddAccount', ['errors' => $model_errors]);
    }
}