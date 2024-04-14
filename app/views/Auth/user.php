<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link href="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.css" rel="stylesheet">
<?php $this->stop() ?>

<?php $this->start("page") ?>

<div class="container">

    <!-- SECTION HEADING -->
    <h2 class="text-center animate__animated animate__bounce">Quản lý tài khoản</h2>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <p class="animate__animated animate__fadeInLeft">Xem tất cả tài khoản.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <!-- FLASH MESSAGES -->

            <a href="/AddAccount" class="btn btn-primary mb-3">
                <i class="fa fa-plus"></i>Đăng ký tài khoản mới</a>

            <!-- Table Starts Here -->
            <table id="users" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Tên</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Vai trò</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $users) : ?>
                        <tr>
                            <td><?= $this->e($users->tennv) ?></td>
                            <td><?= $this->e($users->diachi) ?></td>
                            <td><?= $this->e($users->gioitinhnv) == 1 ? 'Nam' : ($this->e($users->gioitinhnv) == 0 ? 'Nữ' : 'Khác'); ?></td>

                            <td><?= $this->e($users->role) == 1 ? 'Chủ' : ($this->e($users->role) == 0 ? 'Nhân viên' : 'Khác'); ?></td>

                            <td class="d-flex justify-content-center">
                                <a href="<?= '/User/edit/' . $this->e($users->id) ?>" class="btn btn-warning">
                                    <i alt="Edit" class="fa fa-pencil"> </i> Sửa</a>
                                <form class="form-inline ml-1" action="<?= '/User/delete/' . $this->e($users->id) ?>" method="POST">
                                    <button type="submit" class="btn btn-danger" name="delete-contact" id="delete-user">
                                        <i alt="Delete" class="fa fa-trash"></i> Xoá
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- Table Ends Here -->
        </div>
    </div>
</div>
<!-- <div id="delete-confirm" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">Bạn có chắc xoá tài khoản này ?</div>
            <div class="modal-footer">
                <button type="button"
                data-dismiss="modal"
                class="btn btn-danger" id="delete">Xoá</button>
                <button type="button"
                data-dismiss="modal"
                class="btn btn-default">Huỷ</button>
            </div>
        </div>
    </div>
</div> -->
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        var table=$('#users').DataTable({
            "language": {
                "lengthMenu": "Số tài khoản hiển thị: _MENU_",
                "search": "Tìm kiếm",
                "info":"Hiển thị _START_ - _END_ trên _TOTAL_ tài khoản",
                "emptyTable":"Không có tài khoản nào được tìm thấy",
                "paginate": {
                    "previous": "Trước",
                    "next": "Tiếp"
                }
            },
            "lengthMenu":[
                [5,10,20,50],
                ["5","10","15","20"]
            ],
        });
        // new DataTable('#user');

        // $('#delete-user').on('click', function(e){
        //     e.preventDefault();
        //     const form = $(this).closest('form');
        //     const nameTd = $(this).closest('tr').find('td:first');
        //     if (nameTd.length > 0) {
        //         $('.modal-body').html(
        //         `Bạn có muốn xoá "${nameTd.text()}"?`
        //         );
        //     }
        //     $('#delete-confirm')
        //     .modal({
        //         backdrop: 'static',
        //         keyboard: false
        //     })
        //     .one('click', '#delete', function() {
        //         form.trigger('submit');
        //     });

        // });
    });
</script>

<?php if (!empty($message)): ?>
    <?php
    echo "<script>";
    echo "alert('" . $message . "');";
    echo "</script>";
    unset($message);
?>
<?php endif; ?>

<?php if (!empty($messages)): ?>
    <?php
    echo "<script>";
    echo "alert('" . $messages . "');";
    echo "</script>";
    unset($messages);
?>
<?php endif; ?>

<?php $this->stop() ?>
