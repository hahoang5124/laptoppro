
<h2 class="my-3">Sửa tài khoản</h2>
                    <?php if (isset($_SESSION['thongbao'])) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_SESSION['thongbao'] ?>
                        </div>
                    <?php endif;
                    unset($_SESSION['thongbao']); ?>
                    <?php if (isset($_SESSION['loi'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_SESSION['loi'] ?>
                        </div>
                    <?php endif;
                    unset($_SESSION['loi']); ?>
                    <form action="<?=$base_url?>index.php?mod=admin&act=account-edit" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?=$base_url?>/upload/avatar/<?=$account['HinhAnh']?>" alt="" class="mb-3 w-100">
                                <input type="file" name="image">
                            </div>
                            <div class="col-sm-9">
                            <div class="mb-3">
                                
                        <div class="mb-3">
                            <input type="hidden" name="id" value="<?=$_GET['id']?>">
                            <label for="hoten" class="form-label">họ tên</label>
                            <input type="text" class="form-control" id="hoten" name="hoten" value="<?=$account['HoTen']?>">
                        </div>
                            <label for="sodienthoai" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="sodienthoai" name="sodienthoai" value="<?=$account['SoDienThoai']?>">
                        </div>
                        <div class="mb-3">
                            <label for="sodienthoai" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?=$account['email']?>">
                        </div>

                        <div class="mb-3">
                            <label for="matkhau" class="form-label">Mật khẩu</label>
                            <input type="text" class="form-control" id="matkhau" name="matkhau" value="<?=$account['MatKhau']?>">
                        </div>
                        <div class="mb-3">
                            <label for="diachi" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="diachi" name="diachi" value="<?=$account['DiaChi']?>">
                        </div>

                        <div class="mb-3">
                            <label for="quyen" class="form-label">quyền</label>
                            <select class="form-select" id="quyen" name="quyen" >
                                <option value="0" <?=($account['Quyen'] == 0)?'selected':''?>>Người dùng</option>
                                <option value="1" <?=($account['Quyen'] == 1)?'selected':''?>>quản lý</option>
                            </select>
                        </div>
                        <button type="submit" name="submit-update" id="submit" class="btn btn-primary">xác nhận</button>
                            </div>
                        </div>
                    </form>