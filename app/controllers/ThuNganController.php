<?php 

namespace App\controllers;

use App\controllers\Controller;
use App\Models\HoaDon;
use App\SessionGuard as Guard;
use App\Models\SanPham;
use Illuminate\Support\Js;
use Response;

class ThuNganController extends Controller
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
        // Láy các món từ database
        $menu = SanPham::all(); 
        $this->sendPage('thuNganPage', ['menu' => $menu]);
    }

    public function store ()
    {
        $banDuocChon = $_POST['soBan'];
        $ghiChu = $_POST['ThuNgan-ghiChu'];

        // Xóa 2 phần tử này trong mảng để những phần tử 
        // sau chỉ còn là sản phẩm và số lượng của sản phẩm đó
        unset($_POST['soBan']);
        unset($_POST['ThuNgan-ghiChu']);  
        $hoaDon = new HoaDon(['ban' => $banDuocChon, 'ghichu' => $ghiChu]);  
        Guard::TaiKhoan()->HoaDon()->save($hoaDon);

        $idmonDuocChon = array_keys($_POST);
        $tongTien = 0;
        foreach($idmonDuocChon as $idmon) {
            $mon = SanPham::find($idmon);
            $soLuong = $_POST[$idmon];
            $tongTien += $mon->giasp * $soLuong;
            $hoaDon->SanPham()->save($mon, ['soluong' => $soLuong]);
        }
        $hoaDon->update(['tongtien' => $tongTien]);
        redirect('/thuNganPage', ['menu' => SanPham::all()]);
    }

    public function getList($keyword) 
    {   
        header("Content-Type: application/json");
        $data = json_encode(SanPham::where('tensp', 'like', "%$keyword%")->get()->toArray());
        echo "$data";
        exit();
    }

    public function getAllMon(){
        header("Content-Type: application/json");
        $data = json_encode(SanPham::all()->toArray());
        echo "$data";
        exit();
    }

}