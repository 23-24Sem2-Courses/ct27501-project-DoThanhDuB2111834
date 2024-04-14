<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link rel="stylesheet" href="/css/SanPham/home.css">
<?php $this->stop() ?>

<?php $this->start("page") ?>

<div class="container-fluid px-5 py-4">
    <div class="row my-2 d-flex justify-content-evenly">
        <div class="col-3">
            <form action="/GiaoDich/TimKiem" method="POST">
                <div class="border-bottom border-4 border-primary text-primary fs-4 mb-4"><i class="fa-solid fa-bars"></i>
                    Tìm kiếm</div>
                <div class="form-group">
                    <label for="maNVInput">Tên nhân viên:</label>
                    <input type="text" class="form-control my-2" placeholder="Nhập tên nhân viên" id="maNVInput"
                        name="maNVInput" />
                </div>
                <div class="form-group">
                    <label for="tgInput">Ngày lập:</label>
                    <input type="date" class="form-control my-2" name="tgInput" id="tgInput">
                </div>
                <button class="btn btn-success btn-block mt-3" style="width: 100%;" type="submit">
                    Tìm kiếm
                </button>
            </form>
        </div>
        <div class="col-9">
            <div class="SanPham-header row bg-body-tertiary rounded">
                <div class="SanPham-header-title col-2 text-primary 
            font-weight-bold d-flex align-items-center">
                    <span class="SanPham-filter-icon bg-primary text-white p-1 me-2 rounded"><i
                            class="fa-solid fa-filter"></i></span>
                    Danh sách hóa đơn
                </div>
            </div>
            <div class="SanPham-body mt-3 row">
                <table class="table " id="sanPhamTable">
                    <thead>
                        <tr>
                            <th scope="col">Mã Hóa đơn</th>
                            <th scope="col">Tên nhân viên</th>
                            <th scope="col">Ngày lập</th>
                            <th scope="col" colspan="4">Ngày sửa đổi</th>
                            <th scope="col">tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody id="body-sanPhamTable">

                        <?php foreach ($hoaDonList as $hoaDon): ?>
                            <tr>
                                <td>
                                    <?= $this->e($hoaDon->id) ?>
                                </td>
                                <td>
                                    <?= $this->e($hoaDon->TaiKhoan->tennv) ?>
                                </td>
                                <td colspan="4">
                                    <?= $this->e($hoaDon->ngaylap) ?>
                                </td>

                                <td>
                                    <?= $this->e($hoaDon->ngaysuahd) ?>
                                </td>
                                <td>
                                    <?= $this->e($hoaDon->tongtien) ?>
                                </td>
                                <td class="d-flex justify-content-evenly align-items-center" style="height: 100%;">
                                    <button class="btn btn-info"  onclick="toogleDisplayTableCTHD('table-ChiTietHD<?= $this->e($hoaDon->id) ?>');">Chi tiết</button>
                                    <a href="<?= '/thuNganPage/edit/' . $this->e($hoaDon->id) ?>"
                                        class="btn btn-xs btn-warning">
                                        <i alt="Edit" class="fa fa-pencil"> </i> Edit
                                    </a>
                                    <form class="form-inline ml-1"
                                        action="<?= '/HoaDon/delete/' . $this->e($hoaDon->id) ?>" method="POST">
                                        <button type="submit" class="btn btn-xs btn-danger" name="delete-contact">
                                            <i alt="Delete" class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>


                            <tr class="visually-hidden" id="table-ChiTietHD<?= $this->e($hoaDon->id) ?>">
                                <td colspan="12" class="ps-5">
                                    <table class="table ps-4">
                                        <thead class="table-primary">
                                            <tr>
                                                <td class="" colspan="2">Số bàn:
                                                    <?= $this->e($hoaDon->ban) ?>
                                                </td>
                                                <td class="" colspan="3">Ghi chú:
                                                    <?= $this->e($hoaDon->ghichu) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Mã sản phẩm</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($hoaDon->SanPham as $sanPham): ?>
                                                <tr>
                                                    <td><?= $this->e($sanPham->id) ?></td>
                                                    <td><?= $this->e($sanPham->tensp) ?></td>
                                                    <td><?= $this->e($sanPham->pivot->soluong) ?></td>
                                                    <td><?= $this->e($sanPham->giasp) ?></td>
                                                    <td><?= $this->e($sanPham->pivot->soluong * $sanPham->giasp) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-borderless">
                                                <td class="border border-0"
                                                     colspan="">
                                                    <button class="btn btn-info" onclick="toogleDisplayTableCTHD('table-ChiTietHD<?= $this->e($hoaDon->id) ?>');">Thoát</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>



                        <?php endforeach ?>

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>


<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
<script src="../JS/GiaoDich.js"></script>

<!-- Nếu thêm thành công thì hiển thị thông báo -->
<?php if (!empty($message)): ?>
    <?php
    echo "<script>";
    echo "alert('" . $message . "');";
    echo "</script>";
    unset($message);
?>
<?php endif; ?>

<?php $this->stop() ?>