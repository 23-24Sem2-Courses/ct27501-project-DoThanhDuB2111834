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
        $resultAll = SanPham::all();
        $resultSearch = session_get_once('sanPhamList');
        $data = [
            'sanPhamList' => (isset($resultSearch) ? $resultSearch : $resultAll),
            'errorImgUpload' => session_get_once('errorsImgUpLoad'),
            'errors' => session_get_once('errors'),
            'message' => session_get_once('message'),
            'olds' => $this->getSavedFormValues()
        ];
        $this->sendPage('SanPham/SanPham', $data);
    }

    public function getDSSanPham()
    {
        $thongTinTimKiem = $this->filterDataSanPham($_POST);
        // var_dump(($thongTinTimKiem['giasp']));
        if ($thongTinTimKiem['giasp'] == 'all') {
            $result = SanPham::where('tensp', 'like', "%" . $thongTinTimKiem['tensp'] . "%")->get();
            // $this->sendPage('SanPham/SanPham', ['sanPhamList' => $result, 'message' => (!isset($result) ? 'Không có sản phẩm phù hợp' : '')]);
            redirect('/SanPham', ['sanPhamList' => $result, 'message' => (!isset($result) ? 'Không có sản phẩm phù hợp' : '')]);
        } else {
            $result = SanPham::where('giasp', '<', $thongTinTimKiem['giasp'])
                ->where('tensp', 'like', "%" . $thongTinTimKiem['tensp'] . "%")->get();
            // $this->sendPage('SanPham/SanPham', ['sanPhamList' => $result, 'message' => (!isset($result) ? 'Không có sản phẩm phù hợp' : '')]);
            redirect('/SanPham', ['sanPhamList' => $result, 'message' => (!isset($result) ? 'Không có sản phẩm phù hợp' : '')]);
        }

    }

    public function store()
    {
        // Lấy dữ liệu
        $data = $this->filterDataSanPham($_POST);
        $model_errors = SanPham::Validate($data);


        if (!empty($model_errors)) {
            $this->saveFormValues($data);
            redirect('/SanPham', ['errors' => $model_errors]);
        }

        $stateSaveImg = SanPham::handleSaveImg();
        // Nếu lưu ảnh thất bại biến stateSaveImg sẽ được gán danh sách lỗi
        if (is_array($stateSaveImg)){
            $this->saveFormValues($data);
            redirect('/SanPham', ['errorsImgUpLoad' => $stateSaveImg]);
        }
        // Nếu lưu ảnh thành công thì biến stateSaveImg sẽ được gán đường dẫn của ảnh
        $imgPath = (!is_null($stateSaveImg) ? $stateSaveImg : null);
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

    public function edit($id)
    {
        // Tìm sản phẩm có id tương tự nếu không tồn tại thì báo lỗi
        $sanPham = SanPham::find($id);
        if (!$sanPham)
            redirect('/SanPham', ['message' => 'Sản phẩm không tồn tại']);

        $data = [
            'sanPham' => $sanPham,
            'errorImgUpload' => session_get_once('errorsImgUpLoad'),
            'errors' => session_get_once('errors'),
            'message' => session_get_once('message'),
            'olds' => $this->getSavedFormValues()
        ];
        $this->sendPage('/SanPham/edit', $data);
    }

    public function update($id)
    {
        // Tìm sản phẩm theo id
        $sanPham = SanPham::find($id);

        $data = $this->filterDataSanPham($_POST);
        $model_errors = SanPham::Validate($data);

        if (!empty($model_errors)) {
            $this->saveFormValues($data);
            redirect("/SanPham/edit/$id", ['errors' => $model_errors]);
        }
        // Nếu người dùng tải ảnh mới lên thì lưu ảnh mới và xóa ảnh cũ
        $stateSaveImg = SanPham::handleSaveImg();
        $imgPath = null;
        if (is_string($stateSaveImg)) {
            $imgPath = $stateSaveImg;
            $imgPath = str_replace('.jpg', '', $imgPath);
        } else if (is_array($stateSaveImg)){
            $this->saveFormValues($data);
            redirect("/SanPham/edit/$id", ['errorsImgUpLoad' => $stateSaveImg]);
        }
            // Nếu kết quả trả về là đường dẫn ảnh mới thì xóa bỏ ảnh cũ 
        if (!is_null($imgPath))
            SanPham::handleRemoveImg($sanPham->imgsp);

        $fillData = [
            'tensp' => $data['tensp'],
            'giasp' => $data['giasp'],
            'motasp' => $data['motasp'],
            'imgsp' => (!is_null($imgPath) ? $imgPath : $sanPham->imgsp)
        ];
        $sanPham->fill($fillData);

        $sanPham->save();

        redirect('/SanPham', ['message' => 'Chỉnh sửa sản phẩm thành công']);
    }

    public function delete($id)
    {
        $sanPham = SanPham::find($id);

        if (!$sanPham)
            redirect('/SanPham', ['message' => 'Sản phẩm không tồn tại']);

        // Xóa ảnh của sản phẩm trong folder lưu ảnh
        SanPham::handleRemoveImg($sanPham->imgsp);

        // Xóa sản phẩm trong CSDL
        $sanPham->delete();

        redirect('/SanPham', ['message' => 'Xóa sản phẩm thành công']);
    }

    public function filterDataSanPham($data): array
    {
        return [
            'id' => (isset($data['maSPIput']) ? $data['maSPInput'] : null),
            'tensp' => (isset($data['tenSPInput']) ? $data['tenSPInput'] : null),
            'giasp' => (isset($data['giaSPInput']) ? $data['giaSPInput'] : null),
            'motasp' => (isset($data['motaSPInput']) ? $data['motaSPInput'] : null)
        ];
    }
}