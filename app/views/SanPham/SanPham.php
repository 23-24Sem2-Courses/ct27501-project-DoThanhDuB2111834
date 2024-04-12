<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link rel="stylesheet" href="/css/SanPham/home.css">
<?php $this->stop() ?>

<?php $this->start("page") ?>

<div class="container-fluid px-5 py-4">
    <div class="row my-2 d-flex justify-content-evenly">
        <div class="col-3">
            <form action="/SanPham/TimKiem" method="POST">
                <div class="border-bottom border-4 border-primary text-primary fs-4"><i class="fa-solid fa-bars"></i>
                    Tìm kiếm</div>
                <div class="form-group">
                    <input type="text" class="form-control my-2" placeholder="Nhập tên sản phẩm" id="tenSPInput"
                        name="tenSPInput" />
                </div>
                <div class="d-flex">
                    <select class="form-select" id="giaSPInput" name="giaSPInput">
                        <option value="all" selected>all</option>
                        <option value="20000">
                            < 20000</option>
                        <option value="30000">
                            < 30000</option>
                        <option value="100000">
                            < 100000</option>
                    </select>
                    <label class="input-group-text" for="giaSPInput">Các mức giá</label>
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
                    Danh sách hàng hóa
                </div>
                <button type="button" class="col-3 offset-4 btn btn-primary bg-success text-white"
                    onclick="toogleDisplayFormInsert();">
                    <span
                        class="SanPham-add-icon rounded-circle text-primary bg-white text-success text-center ps-1 me-2">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    Thêm mới hàng hóa
                </button>

                <div class="input-group col">
                    <select class="form-select" name="sanPhamInsertForm-order" onchange="sortTableSanPham();"
                        id="inputOrderSanPham">
                        <option value="asc" selected>A -> Z</option>
                        <option value="desc">Z -> A</option>
                    </select>
                    <label class="input-group-text" for="inputOrderSanPham">Options</label>
                </div>
            </div>
            <form class="mt-3 form-themSP <?= (isset($errors) || isset($errorImgUpload)) ? 'd-block' : 'd-none' ?>"
                id="form-themSP" method="POST" style="animation: formSlideDown 2s;" enctype="multipart/form-data">
                <fieldset class="px-4 border border-secondary py-2 rounded">
                    <legend>Thêm sản phẩm</legend>
                    <div class="mb-3">
                        <label for="insertForm-tenSP" class="form-label">Tên sản phẩm</label>
                        <input type="text" id="insertForm-tenSP" name="tenSPInput" class="form-control"
                            value="<?= isset($olds['tensp']) ? $this->e($olds['tensp']) : '' ?>"
                            placeholder="Nhập vào tên sản phẩm">
                    </div>
                    <div class="mb-3 row">
                        <label for="insertForm-giaSP" class="form-label col">Giá sản phẩm</label>
                        <input type="number" id="insertForm-giaSP" name="giaSPInput"
                            class="form-control <?= isset($errors['giasp']) ? 'is-invalid' : '' ?>" required
                            value="<?= isset($olds['giasp']) ? $this->e($olds['giasp']) : '' ?>"
                            aria-describedby="inputGroupPrepend" placeholder="Nhập vào giá sản phẩm">
                        <?php if (isset($errors['giasp'])): ?>
                            <span class="text-danger">
                                <?= $this->e($errors['giasp']) ?>
                            </span>
                        <?php endif ?>

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Mô tả sản phẩm</span>
                        <textarea class="form-control" name="motaSPInput"
                            aria-label="With textarea"><?= isset($olds['motasp']) ? $this->e($olds['motasp']) : '' ?></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="insertForm-imgSP">Upload</label>
                        <input type="file" class="form-control <?= isset($errorImgUpload) ? 'is-invalid' : '' ?>"
                            name="imgSPInput" id="insertForm-imgSP">
                    </div>
                    <?php if (isset($errorImgUpload)): ?>
                        <?php foreach ($errorImgUpload as $errorImg): ?>
                            <p class="text-danger">
                                <strong>
                                    <?= $this->e($errorImg) ?>
                                </strong>
                            </p>
                        <?php endforeach; ?>
                    <?php endif ?>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <button type="reset" class="btn btn-warning">Xóa form</button>
                        <button type="button" class="btn btn-danger" onclick="toogleDisplayFormInsert()">Thoát</button>
                    </div>
                </fieldset>
            </form>
            <div class="SanPham-body mt-3 row">
                <table class="table table-striped" id="sanPhamTable">
                    <thead>
                        <tr>
                            <th scope="col">Mã sản phẩm</th>
                            <th scope="col">Hình ảnh sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col" colspan="4">Mô tả sản phẩm</th>
                            <th scope="col">giá sản phẩm</th>
                        </tr>
                    </thead>
                    <tbody id="body-sanPhamTable">
                        <?php foreach ($sanPhamList as $sanPham): ?>
                            <tr>
                                <td>
                                    <?= $this->e($sanPham->id) ?>
                                </td>
                                <td>
                                    <div class="thucDon-img"
                                        style="background-image: url(<?= $this->e($sanPham->imgsp) ?>);">
                                    </div>
                                </td>
                                <td>
                                    <?= $this->e($sanPham->tensp) ?>
                                </td>
                                <td colspan="4">
                                    <?= $this->e($sanPham->motasp) ?>
                                </td>
                                <td>
                                    <?= $this->e($sanPham->giasp) ?>
                                </td>
                                <td class="d-flex justify-content-evenly align-items-center" style="height: 100%;">
                                    <a href="<?= '/SanPham/edit/' . $this->e($sanPham->id) ?>"
                                        class="btn btn-xs btn-warning">
                                        <i alt="Edit" class="fa fa-pencil"> </i> Edit
                                    </a>
                                    <form class="form-inline ml-1"
                                        action="<?= '/SanPham/delete/' . $this->e($sanPham->id) ?>" method="POST">
                                        <button type="submit" class="btn btn-xs btn-danger" name="delete-contact">
                                            <i alt="Delete" class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                       
                    </tbody>

                </table>
                
                <!-- <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="SanPham/url?page2">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav> -->

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
<script src="../JS/SanPham.js"></script>

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