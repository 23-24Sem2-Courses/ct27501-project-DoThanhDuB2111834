<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'sanpham';
    protected $fillable = ['tensp', 'giasp', 'motasp', 'imgsp'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function HoaDon()
    {
        return $this->belongsToMany(HoaDon::class, 'chitiethoadon')->withPivot('hoa_don_id');
    }

    public static function Validate($data): array
    {
        $errors = [];
        if ($data['giasp'] < 0) {
            $errors['giasp'] = 'Giá của sản phẩm phải lớn hơn 0';
        }

        return $errors;
    }

    // Nếu không có ảnh upload thì trả về null
    // Hàm kiểm tra file ảnh được upload. Nếu có bất cứ lỗi gì sẽ trả về 1 mảng các lỗi.
    // Nếu không có lỗi sẽ trả về đường dẫn ảnh(string)
    public static function handleSaveImg(): array | string | null
    {
        $errorsImgUpLoad = [];
        if (!isset($_FILES['imgSPInput']['name']) || empty($_FILES["imgSPInput"]["tmp_name"])) {
            // $errorsImgUpLoad['upLoadState'] = 'Không có hình ảnh nào được tải lên';
            return null;
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

    public static function handleRemoveImg(string $imgPath)
    {
        $old_imgPath = __DIR__. '/../views/' . $imgPath .'.jpg';
        // echo "$old_imgPath";
        if(file_exists($old_imgPath))
            return unlink($old_imgPath);

        return false;
    }
}