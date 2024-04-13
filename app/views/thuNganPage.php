<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link rel="stylesheet" href="css/thuNganPage.css" />
<?php $this->stop() ?>

<?php $this->start("page") ?>
<div class="container-fluid text-center px-0">
  <div class="App row row-cols-2">
    <div class="col thuNgan-thongTinHoaDon overflow-auto">
      <form action="" id="thuNgan-Form-postValue" class="thuNgan-form overflow-auto" method="POST">
        <input type="hidden" name="id" value="<?= isset($hoaDonCanEdit) ? $this->e($hoaDonCanEdit->id) : '' ?>">
        <input type="hidden" name="soBan" id="banDuocChon"
          value="<?= isset($hoaDonCanEdit) ? $this->e($hoaDonCanEdit->ban) : 1 ?>">
        <table class="table thuNgan-table " id="tableHienThiCacMon">
          <thead class="thuNgan-table-head">
            <tr>
              <th scope="col">Tên hàng hóa</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Đơn giá</th>
              <th scope="col">Thành tiền</th>
            </tr>
          </thead>
          <tbody id="tableHienThiCacMon-body" class="tableHienThiCacMon-body ">
            <?php if (isset($hoaDonCanEdit)): ?>
              <?php foreach ($hoaDonCanEdit->SanPham as $sanPham): ?>
                <tr>
                  <td><?= $this->e($sanPham->tensp) ?></td>
                  <td>
                    <input type="number" name="" id="" onchange="thayDoiTongTienCuaMon('<?= $this->e($sanPham->tensp) ?>')"
                      value="<?= $this->e($sanPham->pivot->soluong) ?>">
                  </td>
                  <td><?= $this->e($sanPham->giasp) ?></td>
                  <td><?= $this->e($sanPham->pivot->soluong * $sanPham->giasp) ?></td>
                  <td><i class="fa-solid fa-trash" onclick="xoaMon('<?= $this->e($sanPham->tensp) ?>')"></i></td>
                  <td><input type="hidden" name="<?= $this->e($sanPham->id) ?>"
                      value="<?= $this->e($sanPham->pivot->soluong) ?>"></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="4"></td>
                <td class="border border-0"><a href="/thuNganPage" class="btn btn-danger">Hủy edit</a></td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="thuNgan-table-footer">
          <div class="input-group">
            <label for="ThuNgan-ghiChu" class="input-group-text" id="basic-addon1">Ghi chú</label>
            <input type="text" id="ThuNgan-ghiChu" name="ThuNgan-ghiChu" class="form-control" aria-label="Username"
              aria-describedby="basic-addon1" placeholder="Hãy nhập ghi chú vào đây">
          </div>
          <div class="row row-cols-2 thuNgan-table-footer-infor">
            <div id="thuNganPage-tongTien">Tổng tiền:</div>
            <button type="submit" id="thuNganPage-submit-btn" class="btn btn-primary block"
              onclick="ktraHoaDonRong(event);">
              Thanh toán
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="col thuNgan-thongTinBanVaMon">
      <div class="row text-white menu-Header my-2">
        <div class="col fs-4 bg-info mx-3 menu-Header-item" onclick="toggleBetweenBanAndthucDon('Ban');">
          <i class="fa-solid fa-table"></i> Bàn (0/20) <br />
          <span id="soBan">Bàn <?= isset($hoaDonCanEdit) ? $this->e($hoaDonCanEdit->ban) : 1 ?></span>
        </div>
        <div class="col fs-4 bg-info me-3 menu-Header-item" onclick="toggleBetweenBanAndthucDon('thucDon');">
          <i class="fa-solid fa-utensils"></i> Thực đơn <br>
          Tất cả
        </div>
      </div>

      <div class="row row-cols-5 g-3 text-white" id="ban-tab">

        <?php $banDuocChon = isset($hoaDonCanEdit) ? $this->e($hoaDonCanEdit->ban) : 1 ?>
        <?php for ($i = 1; $i <= 20; $i++): ?>
          <?php if ($i == $banDuocChon): ?>
            <div class="col">
              <div class=" ban-item bg-info rounded" onclick="setChoseTable(<?= $i ?>);" id="ban-<?= $i ?>">
                Ban <?= $i ?>
              </div>
            </div>
          <?php else: ?>
            <div class="col">
              <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(<?= $i ?>);" id="ban-<?= $i ?>">
                Ban <?= $i ?>
              </div>
            </div>
          <?php endif; ?>
        <?php endfor; ?>


      </div>
      <div class="row text-white thucDon-hienThiMon" style="display: none" id="thucDon-tab">
        <div class="input-group mt-2 mb-3 thucDon-hienThiMon-search">
          <!-- <label for="thuNgan-Search-input">Tìm món</label> -->
          <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i
              class="fa-solid fa-magnifying-glass"></i></button>
          <input type="text" id="thuNgan-Search-input" name="thuNgan-Search-input" class="form-control pe-0"
            aria-label="Example text with button addon" aria-describedby="button-addon1"
            placeholder="Nhập món cần tìm vào đây" onkeyup="searchAndFillDataThuNgan();">
        </div>
        <div class="row row-cols-4 ms-2 gx-5 px-1 overflow-auto thucDon-list" id="thucDon-list">
          <?php foreach ($menu as $mon): ?>
            <div class="col my-2">
              <div style="
                      background-image: url(<?= $this->e($mon->imgsp) ?>);
                    " class="thucDon-img rounded" onclick="setGiaTriChoBangVaForm(<?= $this->e($mon->id) ?>)"
                id="<?= $this->e($mon->id) ?>">

                <span class="thucDon-tenMon bg-info ">
                  <?= $this->e($mon->tensp) ?>
                </span>
                <span class="thucDon-giaMon bg-info ">
                  <?= $this->e($mon->giasp) ?>
                </span>
              </div>
            </div>

          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="modal-LichSu" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center d-block position-relative">
        <button type="button" class="close border border-0 bg-transparent position-absolute top-0 end-0 pe-3 pt-2"
          data-dismiss="modal">
          &times;
        </button>
        <h2 class="modal-title">
          Danh sách hóa đơn
        </h2>
      </div>
      <div class="modal-body">
        <table class="table" id="">
          <thead class="">
            <tr>
              <th scope="col">Mã hóa đơn</th>
              <th scope="col">Tên nhân viên</th>
              <th scope="col">Ngày lập</th>
              <th scope="col">Ngày chỉnh sửa</th>
              <th scope="col">Tổng tiền</th>
            </tr>
          </thead>
          <tbody class="tableHienThiCacMon-body ">
            <?php foreach ($lichSu_thanhToan as $hoaDon): ?>
              <tr>
                <td><strong><?= $this->e($hoaDon->id) ?></strong><br>
                  Bàn: <?= $this->e($hoaDon->ban) ?></td>
                <td><?= $this->e($hoaDon->TaiKhoan->tennv) ?></td>
                <td><?= $this->e($hoaDon->ngaylap) ?></td>
                <td><?= $this->e($hoaDon->ngaysuahd) ?></td>
                <td><?= $this->e($hoaDon->tongtien) ?></td>
                <td><a href="<?= '/thuNganPage/edit/' . $this->e($hoaDon->id) ?>" class="btn btn-xs btn-warning">
                    <i alt="Edit" class="fa fa-pencil"> </i> Edit
                  </a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="modal-footer row d-flex justify-content-between border-0">

      </div>
    </div>
  </div>
</div>
</div>

<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<!-- JS -->
<script src="JS/thuNganPage.js"></script>
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