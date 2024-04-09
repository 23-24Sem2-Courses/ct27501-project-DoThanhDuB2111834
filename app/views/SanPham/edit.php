<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>


<?php $this->start("page_specific_css") ?>

<?php $this->stop() ?>

<?php $this->start("page") ?>
<form class="row mt-3" id="form-themSP" method="POST" action="/SanPham/update/<?= $sanPham->id ?>"
    enctype="multipart/form-data">
    <fieldset class="col-6 offset-3 border border-secondary py-2 rounded">
        <legend>Chỉnh sửa sản phẩm</legend>
        <div class="mb-3">
            <label for="editForm-tenSP" class="form-label">Tên sản phẩm</label>
            <input type="text" id="editForm-tenSP" name="tenSPInput"
                class="form-control  <?= isset($errors['tensp']) ? 'is-invalid' : '' ?>" value="<?= isset($olds['tensp']) ? $olds['tensp'] :
                          (isset($sanPham) ? $this->e($sanPham->tensp) : '') ?>" placeholder="Nhập vào tên sản phẩm">
        </div>
        <div class="mb-3 row">
            <label for="editForm-giaSP" class="form-label col">Giá sản phẩm</label>
            <input type="number" id="editForm-giaSP" name="giaSPInput"
                class="form-control <?= isset($errors['giasp']) ? 'is-invalid' : '' ?>" required value="<?= isset($olds['giasp']) ? $olds['giasp'] :
                          (isset($sanPham) ? $this->e($sanPham->giasp) : '') ?>" aria-describedby="inputGroupPrepend"
                placeholder="Nhập vào giá sản phẩm">
            <?php if (isset($errors['giasp'])): ?>
                <span class="text-danger">
                    <?= $this->e($errors['giasp']) ?>
                </span>
            <?php endif ?>

        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Mô tả sản phẩm</span>
            <textarea class="form-control <?= isset($errors['motasp']) ? 'is-invalid' : '' ?>" name="motaSPInput"
                aria-label="With textarea">
                <?= isset($olds['motasp']) ? $olds['motasp'] :
                    (isset($sanPham) ? $this->e($sanPham->motasp) : '') ?>
            </textarea>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="editForm-imgSP">Upload</label>
            <input type="file" class="form-control <?= isset($errorImgUpload) ? 'is-invalid' : '' ?>" name="imgSPInput"
                id="editForm-imgSP" value=" <?= isset($sanPham) ? $this->e($sanPham->imgsp . 'jpg') : '' ?>">
        </div>
        <?php if (isset($errorImgUpload)): ?>
            <?php foreach ($errorImgUpload as $errorImg): ?>
                <p class="text-danger">
                    <strong>
                        <?= $this->e($errorImg) ?>
                    </strong>
                </p>
            <?php endforeach; ?>
        <?php endif ?>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger"
                onclick="document.getElementById('form-themSP').style.display='none';">Thoát</button>
        </div>
    </fieldset>
</form>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>

<?php $this->stop() ?>