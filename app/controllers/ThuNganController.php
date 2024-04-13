<?php

namespace App\controllers;

use App\controllers\Controller;
use App\Models\HoaDon;
use App\SessionGuard as Guard;
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Support\Js;
use Response;

class ThuNganController extends Controller
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
        // Láy các món từ database
        $menu = SanPham::all();
        $systemTimezone = date_default_timezone_get();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d');
        $lichSu_thanhToan = Guard::TaiKhoan()->HoaDon()->whereDate('ngaylap', $date)->get();
        // echo "$lichSu_thanhToan";
        $data = [
            'menu' => $menu,
            'hoaDonCanEdit' => session_get_once('hoaDonCanEdit'),
            'lichSu_thanhToan' => $lichSu_thanhToan,
            'message' => session_get_once('message')
        ];
        $this->sendPage('thuNganPage', $data);
    }

    public function edit($id)
    {
        $hoaDon = HoaDon::find($id);
        if (!$hoaDon)
            redirect('/thuNganPage', ['message' => 'Không tìm thấy hóa đơn cần chỉnh sửa']);

        redirect('/thuNganPage', ['hoaDonCanEdit' => $hoaDon]);
    }

    public function update()
    {
        $hoaDon = HoaDon::find($_POST['id']);
        if (!$hoaDon)
            redirect('/thuNganPage', ['message' => 'Không tìm thấy hóa đơn cần chỉnh sửa']);

        $banDuocChon = $_POST['soBan'];
        $ghiChu = $_POST['ThuNgan-ghiChu'];

        // Set múi giờ Việt Nam
        $systemTimezone = date_default_timezone_get();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s');
        $hoaDon->update(['ban' => $banDuocChon, 'ghichu' => $ghiChu, 'ngaysuahd' => $date]);

        // Xóa 2 phần tử này trong mảng để những phần tử 
        // sau chỉ còn là sản phẩm và số lượng của sản phẩm đó
        unset($_POST['id']);
        unset($_POST['soBan']);
        unset($_POST['ThuNgan-ghiChu']);

        $idmonDuocChon = array_keys($_POST);
        $tongTien = 0;
        $hoaDon->SanPham()->sync([]);
        foreach ($idmonDuocChon as $idmon) {
            $mon = SanPham::find($idmon);
            $soLuong = $_POST[$idmon];
            $tongTien += $mon->giasp * $soLuong;
            $hoaDon->SanPham()->attach($mon, ['soluong' => $soLuong]);
        }
        $hoaDon->update(['tongtien' => $tongTien]);
        redirect('/GiaoDich', ['message' => 'Chỉnh sửa hóa đơn thành công']);
    }

    public function store()
    {
        if (!empty($_POST['id']))
            $this->update();

        $banDuocChon = $_POST['soBan'];
        $ghiChu = $_POST['ThuNgan-ghiChu'];

        // Xóa 2 phần tử này trong mảng để những phần tử 
        // sau chỉ còn là sản phẩm và số lượng của sản phẩm đó
        unset($_POST['id']);
        unset($_POST['soBan']);
        unset($_POST['ThuNgan-ghiChu']);
        $hoaDon = new HoaDon(['ban' => $banDuocChon, 'ghichu' => $ghiChu]);
        Guard::TaiKhoan()->HoaDon()->save($hoaDon);

        $idmonDuocChon = array_keys($_POST);
        $tongTien = 0;
        foreach ($idmonDuocChon as $idmon) {
            $mon = SanPham::find($idmon);
            $soLuong = $_POST[$idmon];
            $tongTien += $mon->giasp * $soLuong;
            $hoaDon->SanPham()->save($mon, ['soluong' => $soLuong]);
        }
        $hoaDon->update(['tongtien' => $tongTien]);
        redirect('/thuNganPage', ['message' => 'Thanh toán thành công']);
    }

    public function getList($keyword)
    {
        header("Content-Type: application/json");
        $data = json_encode(SanPham::where('tensp', 'like', "%$keyword%")->get()->toArray());
        echo "$data";
        exit();
    }

    public function getAllMon()
    {
        header("Content-Type: application/json");
        $data = json_encode(SanPham::all()->toArray());
        echo "$data";
        exit();
    }

}