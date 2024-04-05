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
			<input type="text" Name="tendangnhap" id="tendangnhap" required="" placeholder="Email">
			<input type="password" Name="matkhau" id="matkhau" placeholder="Mật khẩu" required="">
			
			<div class="aitssendbuttonw3ls">
				<input type="submit" value="LOGIN">
				
			</div>
		</form>
	</div>
    </div>
<?php $this->stop() ?>

