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
        // $HoaDon = TaiKhoan::where('id', 'like', '%'. $_POST['maNVInput'] . '%')->get();
        // if(!empty($_POST['tgInput']))
        //     $HoaDon = $HoaDon->HoaDon()->whereDate('ngaylap', $_POST['tgInput']);
        // else $HoaDon = $HoaDon->HoaDon;
        // redirect('/GiaoDich', ['searchResult' => $HoaDon->get()]);
        $result = [];
        $nhanvien = TaiKhoan::where('tennv', 'like', '%'. $_POST['maNVInput'] . '%')->get();
        if (!empty($_POST['tgInput'])){
            $hoaDon = HoaDon::whereDate('ngaylap', $_POST['tgInput'])->get();
            foreach ($hoaDon as $hd) {
                foreach ($nhanvien as $nv ){
                    if($hd->tai_khoan_id == $nv->id){
                        array_push($result, $hd);
                        continue;
                    }
                }
            }
        } else {
            $hoaDon = HoaDon::all();
            foreach ($hoaDon as $hd) {
                foreach ($nhanvien as $nv ){
                    if($hd->tai_khoan_id == $nv->id){
                        array_push($result, $hd);
                        continue;
                    }
                }
            }
        }
        redirect('/GiaoDich', ['searchResult' => $result]);
    }
}