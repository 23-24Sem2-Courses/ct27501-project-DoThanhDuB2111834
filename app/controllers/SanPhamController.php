<?php

namespace App\controllers;

use App\Models\HoaDon;
use App\SessionGuard as Guard;
use App\Models\SanPham;
use App\controllers\imgController;

class SanPhamController extends Controller
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
        $result = SanPham::all();
        $data = [
            'sanPhamList' => $result,
            'errorImgUpload' => session_get_once('errorsImgUpLoad'),
            'errors' => session_get_once('errors'),
            'message' => session_get_once('message'),
        ];
        $this->sendPage('SanPham/SanPham', $data);
    }

    public function getDSSanPham()
    {
        $thongTinTimKiem = $this->filterDataSanPham($_GET);
        $result = SanPham::where('id', 'like', "%" . $thongTinTimKiem['id'] . "%")
            ->where('tensp', 'like', "%" . $thongTinTimKiem['tensp'] . "%")->get();
        $this->sendPage('SanPham/SanPham', ['sanPhamList' => $result]);

    }

    public function store()
    {
        // Lấy dữ liệu
        $data = $this->filterDataSanPham($_POST);

        $errors = [];
        if ($data['giasp'] < 0) {
            $errors['giasp'] = 'Giá của sản phẩm phải lớn hơn 0';
            redirect('/SanPham', ['errors' => $errors]);
        }

        $stateSaveImg = $this->handleSaveImg();
        // Nếu biến stateSaveImg là mảng thì ảnh upload lỗi
        if (is_array($stateSaveImg))
            redirect('/SanPham', ['errorsImgUpLoad' => $stateSaveImg]);

        $imgPath = $stateSaveImg;
        $imgPath = str_replace('.jpg', '', $imgPath);

        // Khởi tạo sản phẩm mới và lưu
        $newSanPham = new SanPham([
            'tensp' => $data['tensp'],
            'giasp' => $data['giasp'],
            'motasp' => $data['motasp'],
            'imgsp' => $imgPath
        ]);

        $newSanPham->save();

        redirect('/SanPham', ['message' => 'Thêm sản phẩm thành công']);
    }

    // Hàm kiểm tra file ảnh được upload. Nếu có bất cứ lỗi gì sẽ trả về 1 mảng các lỗi.
    // Nếu không có lỗi sẽ trả về đường dẫn ảnh
    public function handleSaveImg(): string|array
    {
        $errorsImgUpLoad = [];
        if (!isset($_FILES['imgSPInput']['name'])) {
            $errorsImgUpLoad['upLoadState'] = 'Không có hình ảnh nào được tải lên';
            return $errorsImgUpLoad;
        }

        $targetDir = 'img/thucDon/';
        $extension = 'jpg';
        $targetFile = $targetDir . uniqid() . basename($_FILES["imgSPInput"]["name"]);
        $targetDestination = __DIR__ . '/../views/' . $targetFile;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Kiểm tra hình ảnh ddwocj upload

        $check = getimagesize($_FILES["imgSPInput"]["tmp_name"]);
        if ($check === false) {
            $errorsImgUpLoad['type'] = "$imageFileType: is not an image.";
        }

        if ($_FILES["imgSPInput"]["size"] > 500000000) {
            $errorsImgUpLoad['size'] = 'Sorry, your file is too large';
        }

        if ($imageFileType !== $extension) {
            $errorsImgUpLoad['extension'] = 'Sorry, only JPG files are allowed.';
        }

        if (file_exists($targetFile)) {
            $errorsImgUpLoad['exist'] = "Sorry, file already exists.";
        }

        // Kiểm tra xong nếu có lỗi thì trả về mảng các lỗi
        if (!empty($errorsImgUpLoad)) {
            return $errorsImgUpLoad;
        } else {
            if (move_uploaded_file($_FILES["imgSPInput"]["tmp_name"], $targetDestination))
                return $targetFile;
            else {
                $errorsImgUpLoad['fileSystem'] = 'Không thể lưu ảnh vào thư mục';
                return $errorsImgUpLoad;
            }
        }
    }

    public function edit()
    {
        // Lấy dữ liệu và tìm sản phẩm vừa rồi, nếu không có thì kết thúc

        // Nếu người dùng có upload hình ảnh thì sử dụng class imgCotroller để lưu hình ảnh

        // Xóa hình ảnh cũ

        // Update thông tin mới 
    }

    public function filterDataSanPham($data): array
    {
        return [
            'tensp' => $data['tenSPInput'],
            'giasp' => $data['giaSPInput'],
            'motasp' => $data['motaSPInput']
        ];
    }
}