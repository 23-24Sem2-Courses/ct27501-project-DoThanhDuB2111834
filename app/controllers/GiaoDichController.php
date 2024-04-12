<?php

namespace App\controllers;

use App\Models\TaiKhoan;
use App\SessionGuard as Guard;
use App\Models\HoaDon;

Class GiaoDichController extends Controller 
{
    public function __construct()
    {
        if (!Guard::isTaiKhoanLoggedIn()) {
            redirect('/login');
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
        $result = TaiKhoan::where('tennv', 'like','%'. $_POST['tenNVInput'] .'%')->with('HoaDon')->get();

        // $selectedTime = $_POST['tgInput'];
        // if (isset($selectedTime)){
        //     $result = HoaDon::whereDate('ngaysuahd', $selectedTime);
        // }
        // var_dump($result);
        echo "$result";
        // redirect('/GiaoDich', ['searchResult' => $result->get()]);
    }
}