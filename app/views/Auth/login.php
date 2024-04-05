<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <!-- FLASH MESSAGES -->

            <div class="card mt-3">
                <div class="card-header font-weight-bold text-uppercase">Login</div>
                <div class="card-body">

                    <form method="POST" action="/login">

                        <div class="form-group row">
                            <label for="tendangnhap" class="col-md-4 col-form-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="tendangnhap" type="text" class="form-control <?= isset($errors['tendangnhap']) ? 'is-invalid' : '' ?>" name="tendangnhap" value="<?= isset($old['tendangnhap']) ? $this->e($old['tendangnhap']) : '' ?>" required autofocus>

                                <?php if (isset($errors['tendangnhap'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $this->e($errors['tendangnhap']) ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="matkhau" class="col-md-4 col-form-label">matkhau</label>
                            <div class="col-md-6">
                                <input id="matkhau" type="password" class="form-control <?= isset($errors['matkhau']) ? 'is-invalid' : '' ?>" name="matkhau" required>

                                <?php if (isset($errors['matkhau'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $this->e($errors['matkhau']) ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <!-- <a class="btn btn-link" href="/register">
                                    You are a new user?
                                </a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>