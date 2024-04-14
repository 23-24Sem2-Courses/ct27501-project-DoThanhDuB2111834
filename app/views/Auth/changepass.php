<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="container">
    <!-- SECTION HEADING -->
    <h2 class="text-center animate__animated animate__bounce">Tài khoản</h2>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <p class="animate__animated animate__fadeInLeft">Cập nhật mật khẩu.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <form action="/User/changepass" method="POST" class="col-md-6 offset-md-3">
                <div class="form-group">
                    <label for="matkhauht" class="col-md-4 col-form-label">Mật khẩu hiện tại</label>
                    <input type="password" Name="matkhauht" id="matkhauht"  class="form-control <?= isset($errors['matkhauht']) ? ' is-invalid' : '' ?>"   required>
                    
                    <?php if (isset($errors['matkhauht'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $this->e($errors['matkhauht']) ?></strong>
                                    </span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="matkhaumoi" class="col-md-4 col-form-label">Mật khẩu mới</label>
                    <input type="password" Name="matkhaumoi" id="matkhaumoi"  class="form-control <?= isset($errors['matkhaumoi']) ? 'is-invalid' : '' ?>"   required>
                    <?php if (isset($errors['matkhaumoi'])) : ?>
                                <span class="invalid-feedback">
                                    <strong><?= $this->e($errors['matkhaumoi']) ?></strong>
                                </span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="matkhaumoicheck" class="col-md-4 col-form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" Name="matkhaumoicheck" id="matkhaumoicheck"  class="form-control <?= isset($errors['matkhaumoicheck']) ? 'is-invalid' : '' ?>"   required>
                    <?php if (isset($errors['matkhaumoicheck'])) : ?>
                                <span class="invalid-feedback">
                                    <strong><?= $this->e($errors['matkhaumoicheck']) ?></strong>
                                </span>
                    <?php endif ?>
                </div>
                
               
                

                <!-- Submit -->
                <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Cập nhật mật khẩu</button>
            </form>

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



<?php if (!empty($messages)): ?>
    <?php
    echo "<script>";
    echo "alert('" . $messages . "');";
    echo "</script>";
    unset($messages);
?>
<?php endif; ?>

<?php $this->stop() ?>