<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link rel="stylesheet" href="css/thuNganPage.css" />
<?php $this->stop() ?>

<?php $this->start("page") ?>
  <div class="container-fluid text-center px-0">
    <div class="App row row-cols-2">
      <div class="col thuNgan-thongTinHoaDon">
        Màn hình hiển thị các món đã chọn

        <form action="" id="thuNgan-Form-postValue" method="POST">
          <input type="hidden" name="soBan" id="banDuocChon" value="1">
          <table class="table" class="thuNgan-table" id="tableHienThiCacMon" border="1">
            <thead>
              <tr>
                <th scope="col">Tên hàng hóa</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Thành tiền</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody id="tableHienThiCacMon-body"></tbody>
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
      <div class="col">
        <div class="row text-white menu-Header my-2">
          <div class="col fs-4 bg-info mx-3 menu-Header-item" onclick="toggleBetweenBanAndthucDon('Ban');">
            <i class="fa-solid fa-table"></i> Bàn (0/20) <br />
            <span id="soBan">Bàn 1</span>
          </div>
          <div class="col fs-4 bg-info me-3 menu-Header-item" onclick="toggleBetweenBanAndthucDon('thucDon');">
            <i class="fa-solid fa-utensils"></i> Thực đơn <br>
            Tất cả
          </div>
        </div>

        <div class="row row-cols-5 g-3 text-white" id="ban-tab">

          <div class="col">
            <div class=" ban-item bg-info rounded" onclick="setChoseTable(1);" id="ban-1">
              Ban 1
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(2);" id="ban-2">
              Ban 2
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(3);" id="ban-3">
              Ban 3
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(4);" id="ban-4">
              Ban 4
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(5);" id="ban-5">
              Ban 5
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(6);" id="ban-6">
              Ban 6
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(7);" id="ban-7">
              Ban 7
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(8);" id="ban-8">
              Ban 8
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(9);" id="ban-9">
              Ban 9
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(10);" id="ban-10">
              Ban 10
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(11);" id="ban-11">
              Ban 11
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(12);" id="ban-12">
              Ban 12
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(13);" id="ban-13">
              Ban 13
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(14);" id="ban-14">
              Ban 14
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(15);" id="ban-15">
              Ban 15
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(16);" id="ban-16">
              Ban 16
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(17);" id="ban-17">
              Ban 17
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(18);" id="ban-18">
              Ban 18
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(19);" id="ban-19">
              Ban 19
            </div>
          </div>

          <div class="col">
            <div class=" ban-item bg-secondary rounded" onclick="setChoseTable(20);" id="ban-20">
              Ban 20
            </div>
          </div>
        </div>
        <div class="row text-white" style="display: none" id="thucDon-tab">
          <div class="input-group mt-2 mb-3">
            <!-- <label for="thuNgan-Search-input">Tìm món</label> -->
            <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i
                class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" id="thuNgan-Search-input" name="thuNgan-Search-input" class="form-control pe-0"
              aria-label="Example text with button addon" aria-describedby="button-addon1"
              placeholder="Nhập món cần tìm vào đây" onkeyup="searchAndFillDataThuNgan();">
          </div>
          <div class="row row-cols-4 ms-2 gx-3" id="thucDon-list">
            <?php foreach ($menu as $mon): ?>
              <div class="col">
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
            <div style="
                      background-image: url(img/Login/loginbackground);
                    " class="thucDon-img rounded" >
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $this->stop() ?>

  <?php $this->start("page_specific_js") ?>
  <!-- JS -->
  <script src="JS/thuNganPage.js"></script>

  <?php $this->stop() ?>
