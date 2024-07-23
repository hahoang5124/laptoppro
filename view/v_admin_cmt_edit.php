
<h2 class="my-3">Sửa bình luận</h2>
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
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="">
                    <input type="hidden" value=" <?=$_GET['id']?>" name="id">
                    <label for="">Trạng thái</label>
                    <select name="status" id="" class="form-select">
                        <option value="0"<?php if($review['GhimBinhLuan']== 0) echo 'selected';?>>Không ghim</option>
                        <option value="1" <?php if($review['GhimBinhLuan']== 1) echo 'selected';?>>Ghim</option>
                    </select>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-danger m-5" name="submit_edit" value="Sửa">
                </div>
            </div>
        </div>
    </form>