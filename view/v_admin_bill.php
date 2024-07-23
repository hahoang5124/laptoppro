<h2 class="my-3">QUẢN LÝ ĐƠN HÀNG</h2>
<div class="dropdown mb-4">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Đã thanh toán
  </a>

  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="<?=$base_url?>index.php?mod=admin&act=successfully">Đã giao hàng</a></li>
  </ul>
</div>
<?php foreach ($ls as $item):
  $mhd = $item['MaHD'];
  $list = product_accept($mhd);
  ?>
  <div class="col-md-10 ms-5">
  <div class="card border-secondary mb-4">
  <div class="">
    <h5 class="card-title card-body text-center">Mã hóa đơn: <?=$item['MaHD']?></h5>
  </div>
    <ul class="list-group list-group-flush">
      <table class="table">
        <thead>
          <tr>
            <th class="w-20">Hình ảnh</th>
            <th class="">Tên sản phẩm</th>
            <th class="w-10 text-center">Số lượng</th>
            <th class="card-body text-center w-15">Giá</th>
          </tr>
        </thead>
        <?php $tongtien = 0; foreach ($list as $item): ?>
        <tbody>
          <tr>
            <td><img src="<?= $base_url ?>upload/product/<?=$item['HinhAnh']?>" alt=""style="width:60px"></td>
            <td class=""><?=$item['TenSP']?></td>
            <td class="text-center"><?=$item['SoSanPham']?></td>
            <td class="text-center"><?=$item['gia']?> đ</td>
          </tr>
        </tbody>
        <?php $tongtien += $item['SoSanPham']* $item['gia']; endforeach;?>
        <tfoot>
          <tr>
            <th colspan="">Hoàng Nhật Hà</th>
            <th class="text-end" colspan="2">TỔNG THÀNH TIỀN:</th>
            <th class=""><?=$tongtien?> đ</th>
          </tr>
        </tfoot>
      </table>
    </ul>
  <div class="card-body text-end">
    <a class="btn btn-success" href="<?=$base_url?>index.php?mod=admin&act=bill-accept&id=<?=$item['MaHD']?>">Chấp nhận</a>
    <a class="btn btn-danger"href="<?=$base_url?>index.php?mod=admin&act=bill-delete&id=<?=$item['MaHD']?>">Từ chối</a>
  </div>
</div>
</div>
<?php endforeach;?>