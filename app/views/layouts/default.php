<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!--  -->

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--  -->

    <link rel="stylesheet" href="../css/thanhDieuHuong.css" />
    <?= $this->section("page_specific_css") ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary-subtle">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/TongQuan">
                            <i class="fa-solid fa-chart-simple"></i>Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SanPham">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/GiaoDich">Giao dịch</a>
                    </li>
                </ul>
                <?php if (!\App\SessionGuard::isTaiKhoanLoggedIn()): ?>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                <?php else: ?>
                    <button type="button" class="btn navbar-text nav-link me-3" data-toggle="modal" data-target="#modal-LichSu"><i
                            class="fa-solid fa-clock-rotate-left"></i></button>
                    <a href="/thuNganPage" class="navbar-text nav-link"><i class="fa-solid fa-shop"></i></a>

                    <div class="nav-item dropdown nav-account">
                        <a class="nav-link nav-account-icon dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $this->e(\App\SessionGuard::TaiKhoan()->tennv) ?>
                        </a>
                        <ul class="dropdown-menu nav-account-list">
                            <li><a class="dropdown-item" href="/AddAccount">Thêm tài khoản</a></li>
                            <li><a class="dropdown-item" href="/User">Quản trị tài khoản</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                                    xuất</a></li>
                            <form id="logout-form" class="d-none" action="/logout" method="POST">
                            </form>
                        </ul>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </nav>

    <?= $this->section("page") ?>

    <!-- Js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc1 ban-items9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <?= $this->section("page_specific_js") ?>

</body>

</html>