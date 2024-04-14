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
                        <option value="3" >Chọn giới tính</option>
                        <option value="0" <?= isset($old['gioitinh']) ? (($old['gioitinh'] == 0) ? 'selected' : '') : ($user->gioitinhnv==0 ? 'selected' : '') ?>>Nữ</option>
                        <option value="1" <?= isset($old['gioitinh']) ? (($old['gioitinh'] == 1) ? 'selected' : '') : ($user->gioitinhnv==1 ? 'selected' : '') ?>>Nam</option>
                        <option value="2" <?= isset($old['gioitinh']) ? (($old['gioitinh'] == 2) ? 'selected' : '') : ($user->gioitinhnv==2 ? 'selected' : '') ?>>Khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="vaitro">Vai trò:</label>
                    <select name="vaitro" id="vaitro" class="form-control" value="<?= isset($old['vaitro']) ? $this->e($old['vaitro']) : '' ?>" required>
                        <option value="2" >Chọn vai trò</option>
                        <option value="0" <?= isset($old['vaitro']) ?(($old['vaitro'] == 0) ? 'selected' : '') : ($user->role==0 ? 'selected' : '') ?>>Nhân viên</option>
                        <option value="1" <?= isset($old['vaitro']) ?(($old['vaitro'] == 1) ? 'selected' : '') : ($user->role==1 ? 'selected' : '') ?>>Chủ</option>
                    </select>
                </div>
                

                <!-- Submit -->
                <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Cập nhật tài khoản</button>
            </form>

        </div>
    </div>
</div>
<?php $this->stop() ?>