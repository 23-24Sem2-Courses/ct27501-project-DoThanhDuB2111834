<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>
<?php $this->start("page_specific_css") ?>
<link rel="stylesheet" href="/css/Login/popuo-box.css">
<link rel="stylesheet" href="/css/Login/style.css">
<?php $this->stop() ?>
<?php $this->start("page") ?>
<div class="loginbackground">
<h1>CLASSIC CAFE</h1>

	<div class="w3layoutscontaineragileits">
	<h2>Đăng nhậP</h2>
		<form action="" method="POST">
		<div class="">
                <input type="text" Name="tendangnhap" id="tendangnhap" required="" placeholder="Tên đăng nhập" class="<?= isset($errors['tendangnhap']) ? 'is-invalid' : '' ?>"  value="<?= isset($old['tendangnhap']) ? $this->e($old['tendangnhap']) : '' ?>" required autofocus>
                <?php if (isset($errors['tendangnhap'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $this->e($errors['tendangnhap']) ?></strong>
                            </span>
                <?php endif ?>
            </div>
			<div class="">
                <input type="password" Name="matkhau" id="matkhau" placeholder="Mật khẩu" class="<?= isset($errors['matkhau']) ? 'is-invalid' : '' ?>"   required>
                <?php if (isset($errors['matkhau'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $this->e($errors['matkhau']) ?></strong>
                            </span>
                <?php endif ?>
            </div>
			
			<div class="aitssendbuttonw3ls">
				<input type="submit" value="LOGIN">
				
			</div>
		</form>
	</div>
    </div>
<?php $this->stop() ?>

