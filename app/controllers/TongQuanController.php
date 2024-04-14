<?php

namespace App\controllers;

use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\TaiKhoan;
use App\SessionGuard as Guard;
use Illuminate\Support\Carbon;

class TongQuanController extends Controller
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
        $sanPham = SanPham::count();
        $systemTimezone = date_default_timezone_get();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('m');
        $tongDoanhThu = HoaDon::whereMonth('ngaylap',$date)->sum('tongtien');
        $tongHoaDon = HoaDon::whereMonth('ngaylap',$date)->count();
        $tongNhanVien = TaiKhoan::count();
        $sanPhamList = [];
        $result = SanPham::with('hoadon')->get();
        foreach ($result as $item) {
            $sanPhamList[($item->tensp)] = (int) ($item->HoaDon()->sum('soluong'));
        }
        arsort($sanPhamList);
        $sanPhamList = array_slice($sanPhamList, 0, 4);
        $doanhThuTheoCacThang = HoaDon::select(HoaDon::raw("MONTH(ngaylap) as thanglap"), HoaDon::raw("SUM(tongtien) as tongtien"))->groupBy('thanglap')->orderBy('thanglap', 'asc')->get();
        $nhanVienTichCuc = HoaDon::select(HoaDon::raw('tai_khoan_id'),HoaDon::raw("COUNT('id') as tongsobuoilam"))->whereMonth('ngaylap', $date)->groupBy('tai_khoan_id',)->distinct()->limit(5)->orderBy('tongsobuoilam','desc')->get();
        // echo "$nhanVienTichCuc";
        $data = [
            'message' => session_get_once('message'),
            'tongSanPham' => $sanPham,
            'tongDoanhThu' => $tongDoanhThu,
            'tongHoaDon' => $tongHoaDon,
            'tongSoNhanVien' => $tongNhanVien,
            'sanPhamList' => $sanPhamList,
            'nhanVienTichCuc' => $nhanVienTichCuc,
            'doanhThuTheoCacThang' => $doanhThuTheoCacThang
        ];
        $this->sendPage('TongQuan', $data);
    }
}