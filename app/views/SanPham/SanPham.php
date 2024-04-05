<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>

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
        <a href="" class="col-2 offset-6 btn btn-primary bg-success text-white">
            <span class="SanPham-add-icon rounded-circle text-primary bg-white text-success text-center ps-1 me-2">
                <i class="fa-solid fa-plus"></i>
            </span>
            Thêm mới hàng hóa
        </a>
        <div class="input-group col">
            <select class="form-select" id="inputGroupSelect02">
                <option selected>A -> Z</option>
                <option value="1">Z -> A</option>
            </select>
            <label class="input-group-text" for="inputGroupSelect02">Options</label>
        </div>
    </div>
    <div class="row my-5">
        <a href="#" class="btn btn-info btn-lg col-2 offset-10" data-toggle="modal" data-target="#modal1">
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
                <?php foreach ($sanPhamList as $sanPham) : ?>
                    <tr>
                        <td><?= $this->e($sanPham->id) ?></td>
                        <td>Ảnh</td>
                        <td><?= $this->e($sanPham->tensp) ?></td>
                        <td colspan="4"><?= $this->e($sanPham->motasp) ?></td>
                        <td><?= $this->e($sanPham->giasp) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    </div>
</div>
<div id="modal1" class="modal fade" tabindex="-1">
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

<?php $this->stop() ?>