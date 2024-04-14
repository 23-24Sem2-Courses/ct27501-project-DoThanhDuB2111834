<?php

namespace App\controllers;

use App\Models\TaiKhoan;
use App\SessionGuard as Guard;
use App\Models\HoaDon;
use Illuminate\Support\Facades\DB;

Class GiaoDichController extends Controller 
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

    public function index ()
    {
        $result = HoaDon::all();
        $searchResult = session_get_once('searchResult');
        $data = [
            'hoaDonList' => isset($searchResult) ? $searchResult : $result,
            'message' => session_get_once('message'),
        ];
        $this->sendPage('GiaoDich', $data);
    }

    public function delete ($id)
    {
        $HoaDon = HoaDon::find($id);
        if(!$HoaDon)
            redirect('/GiaoDich', ['message' => 'Không tìm thấy hóa đơn']);

        $HoaDon->delete();
        redirect('/GiaoDich', ['message' => 'Xóa hóa đơn thành công']);
    }

    public function search ()
    {
        $HoaDon = TaiKhoan::find($_POST['maNVInput']);
        if(!empty($_POST['tgInput']))
            $HoaDon = $HoaDon->HoaDon()->whereDate('ngaylap', $_POST['tgInput'])->get();
        else $HoaDon = $HoaDon->HoaDon;
        redirect('/GiaoDich', ['searchResult' => $HoaDon]);
    }
}