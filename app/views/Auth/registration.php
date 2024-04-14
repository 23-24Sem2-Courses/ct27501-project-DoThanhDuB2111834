<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>
<?php $this->start("page_specific_css") ?>
<link rel="stylesheet" href="/css/Login/popuo-box.css">
<link rel="stylesheet" href="/css/Login/style.css">
<?php $this->stop() ?>
<?php $this->start("page") ?>
<div class="loginbackground">
<h1>CLASSIC CAFE</h1>

	<div class="w3layoutscontaineragileits">
	<h2>Đăng ký</h2>
		<form action="/AddAccount" method="POST">
			<input type="text" Name="hoten" id="hoten"  placeholder="Họ và tên" value="<?= isset($old['hoten']) ? $this->e($old['hoten']) : '' ?>" required>
            <input type="text" Name="diachi" id="diachi"  placeholder="Địa chỉ" value="<?= isset($old['diachi']) ? $this->e($old['diachi']) : '' ?>" required>
            <div class="">
                <input type="text" Name="tendangnhap" id="tendangnhap" required="" placeholder="Tên đăng nhập" class="<?= isset($errors['tendangnhap']) ? 'is-invalid' : '' ?>"  value="<?= isset($old['tendangnhap']) ? $this->e($old['tendangnhap']) : '' ?>" required autofocus>
                <?php if (isset($errors['tendangnhap'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $this->e($errors['tendangnhap']) ?></strong>
                            </span>
                <?php endif ?>
            </div>
            
            <select name="gioitinh" id="gioitinh" value="<?= isset($old['gioitinh']) ? $this->e($old['gioitinh']) : '' ?>" required>
                <option value="3" >Chọn giới tính</option>
                <option value="0" <?= isset($old['gioitinh']) ? (($old['gioitinh'] == 0) ? 'selected' : '') : '' ?>>Nữ</option>
                <option value="1" <?= isset($old['gioitinh']) ? (($old['gioitinh'] == 1) ? 'selected' : '') : '' ?>>Nam</option>
                <option value="2" <?= isset($old['gioitinh']) ? (($old['gioitinh'] == 2) ? 'selected' : '') : '' ?>>Khác</option>
            </select>
            <select name="vaitro" id="vaitro" value="<?= isset($old['vaitro']) ? $this->e($old['vaitro']) : '' ?>" required>
                <option value="2">Chọn vai trò</option>
                <option value="0" <?= isset($old['vaitro']) ?(($old['vaitro'] == 0) ? 'selected' : '') : '' ?>>Nhân viên</option>
                <option value="1" <?= isset($old['vaitro']) ?(($old['vaitro'] == 1) ? 'selected' : '') : '' ?>>Chủ</option>
                
            </select>
            <div class="">
                <input type="password" Name="matkhau" id="matkhau" placeholder="Mật khẩu" class="<?= isset($errors['matkhau']) ? 'is-invalid' : '' ?>"   required>
                <?php if (isset($errors['matkhau'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $this->e($errors['matkhau']) ?></strong>
                            </span>
                <?php endif ?>
            </div>
			
            <div class="">
                <input type="password" Name="checkmatkhau" id="checkmatkhau" placeholder="Nhập lại mật khẩu" class="<?= isset($errors['checkmatkhau']) ? 'is-invalid' : '' ?>"   required>
                <?php if (isset($errors['checkmatkhau'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $this->e($errors['checkmatkhau']) ?></strong>
                            </span>
                <?php endif ?>
            </div>
            
			
			<div class="aitssendbuttonw3ls">
				<input type="submit" value="ĐĂNG KÝ">
				
			</div>
		</form>
	</div>
    </div>
<?php $this->stop() ?>