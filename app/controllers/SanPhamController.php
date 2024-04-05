<?php

namespace App\controllers;

use App\Models\HoaDon;
use App\SessionGuard as Guard;
use App\Models\SanPham;

class SanPhamController extends Controller
{
    public function __construct()
    {
        if(!Guard::isTaiKhoanLoggedIn())
        {
            redirect('/login');
        }

        parent::__construct();
    }

    public function index ()
    {
        $result = SanPham::all();
        $this->sendPage('SanPham/SanPham', ['sanPhamList' => $result]);
    }

    public function getDSSanPham()
    {
        $thongTinTimKiem = $this->filterDataSanPham($_GET);
        $result = SanPham::where('id', 'like', "%".$thongTinTimKiem['id']."%")
                        ->where('tensp', 'like', "%".$thongTinTimKiem['tensp']."%")->get();
        // $result = $result->get();
        // echo "$result";
        $this->sendPage('SanPham/SanPham', ['sanPhamList' => $result]);
        
    }

    public function filterDataSanPham($data) : array
    {
        return [
            'id' => $data['maSPInput'],
            'tensp' => $data['tenSPInput']
        ];
    }
}