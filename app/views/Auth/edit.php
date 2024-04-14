<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="container">
    <!-- SECTION HEADING -->
    <h2 class="text-center animate__animated animate__bounce">Tài khoản</h2>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <p class="animate__animated animate__fadeInLeft">Cập nhật tài khoản.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <form action="<?= '/User/' . $this->e($user['id']) ?>" method="POST" class="col-md-6 offset-md-3">

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" Name="hoten" id="hoten" class="form-control  <?= isset($errors['tennv']) ? 'is-invalid' : '' ?>" value="<?= isset($old['tennv']) ? $old['tennv'] :
                          (isset($user) ? $this->e($user->tennv) : '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="Địa chỉ">Địa chỉ</label>
                    <input type="text" Name="diachi" id="diachi" class="form-control <?= isset($errors['diachi']) ? 'is-invalid' : '' ?>" value="<?= isset($old['diachi']) ? $old['diachi'] :
                          (isset($user) ? $this->e($user->diachi) : '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="gioitinh">Giới tính:</label>
                    <select name="gioitinh" id="gioitinh" class="form-control" value="<?= isset($old['gioitinh']) ? $this->e($old['gioitinh']) : '' ?>" required>
                        <option value="3" selected>Chọn giới tính</option>
                        <option value="0">Nữ</option>
                        <option value="1">Nam</option>
                        <option value="2">Khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="vaitro">Vai trò:</label>
                    <select name="vaitro" id="vaitro" class="form-control" value="<?= isset($old['vaitro']) ? $this->e($old['vaitro']) : '' ?>" required>
                        <option value="2" selected>Chọn vai trò</option>
                        <option value="0">Nhân viên</option>
                        <option value="1">Chủ</option>
                    </select>
                </div>
                

                <!-- Submit -->
                <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Cập nhật tài khoản</button>
            </form>

        </div>
    </div>
</div>
<?php $this->stop() ?>