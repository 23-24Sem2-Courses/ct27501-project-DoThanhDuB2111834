<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link rel="stylesheet" href="/css/SanPham/home.css">
<?php $this->stop() ?>

<?php $this->start("page") ?>

<div class="container my-2">
    <div class="SanPham-header row bg-body-tertiary rounded">
        <div class="SanPham-header-title col-2 text-primary 
            font-weight-bold d-flex align-items-center">
            <span class="SanPham-filter-icon bg-primary text-white p-1 me-2 rounded"><i
                    class="fa-solid fa-filter"></i></span>
            Danh sách hàng hóa
        </div>
        <button type="button" class="col-2 offset-6 btn btn-primary bg-success text-white"
            onclick="document.getElementById('form-themSP').style.display='block';">
            <span class="SanPham-add-icon rounded-circle text-primary bg-white text-success text-center ps-1 me-2">
                <i class="fa-solid fa-plus"></i>
            </span>
            Thêm mới hàng hóa
        </button>

        <div class="input-group col">
            <select class="form-select" id="inputGroupSelect02">
                <option selected>A -> Z</option>
                <option value="1">Z -> A</option>
            </select>
            <label class="input-group-text" for="inputGroupSelect02">Options</label>
        </div>
    </div>
    <form class="row mt-3" id="form-themSP">
        <fieldset class="col-6 offset-3 border border-secondary py-2 rounded">
            <legend>Thêm sản phẩm</legend>
            <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Tên sản phẩm</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="Nhập vào tên sản phẩm">
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Giá sản phẩm</label>
                <input type="number" id="disabledTextInput" class="form-control" placeholder="Nhập vào giá sản phẩm">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Mô tả sản phẩm</span>
                <textarea class="form-control" aria-label="With textarea"></textarea>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                <input type="file" class="form-control" id="inputGroupFile01">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger"
                    onclick="document.getElementById('form-themSP').style.display='none';">Thoát</button>
            </div>
        </fieldset>
    </form>
    <div class="row my-5">
        <a href="#" class="btn btn-info btn-lg col-2 offset-10" data-toggle="modal" data-target="#modal-TimKiem">
            Tìm kiếm
        </a>
    </div>
    <div class="SanPham-body mt-3 row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col">Hình ảnh sản phẩm</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col" colspan="4">Mô tả sản phẩm</th>
                    <th scope="col">giá sản phẩm</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sanPhamList as $sanPham): ?>
                    <tr>
                        <td>
                            <?= $this->e($sanPham->id) ?>
                        </td>
                        <td>
                            <div class="thucDon-img" style="background-image: url(<?= $this->e($sanPham->imgsp) ?>);"></div>
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
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    </div>
</div>
<div id="modal-TimKiem" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center d-block position-relative">
                <button type="button"
                    class="close border border-0 bg-transparent position-absolute top-0 end-0 pe-3 pt-2"
                    data-dismiss="modal">
                    &times;
                </button>
                <h2 class="modal-title">
                    Tìm kiếm sản phẩm
                </h2>
            </div>
            <div class="modal-body">
                <form action="/SanPham/TimKiem" method="GET">
                    <div class="form-group">
                        <label for="maSPInput">
                            Mã sản phẩm:
                        </label>
                        <input type="text" class="form-control my-2" placeholder="Nhập mã sản phẩm" id="maSPInput"
                            name="maSPInput" />
                    </div>
                    <div class="form-group">
                        <label for="tenSPInput">
                            Tên sản phẩm:
                        </label>
                        <input type="text" class="form-control my-2" placeholder="Nhập tên sản phẩm" id="tenSPInput"
                            name="tenSPInput" />
                    </div>
                    <button class="btn btn-success btn-block mt-3" style="width: 100%;" type="submit">
                        Tìm kiếm
                    </button>
                </form>
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

<?php $this->stop() ?>