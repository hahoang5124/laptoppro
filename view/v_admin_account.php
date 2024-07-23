
<div class="container mt-3">
    <h3 class="text-center">Quản lý tài khoản </h3>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
Thêm tài khoản
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nhap thong tin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<div class="themsp">
      <form action="" method="POST" enctype="multipart/form-data" >
        <div class="row">
        <div class="col">
     <label for="">Họ tên:</label>
    <input type="text" name="HoTen" class="form-control">
      </div>
     <div class="col">
     <label for="">Số Điện Thoại:</label>
    <input type="text" name="SoDienThoai" class="form-control">
      </div>
     </div>
     <div class="row">
     <div class="col">       
         <label for="">email:</label>
       <input type="text"  name="email" class="form-control">
      </div>
       <div class="col">       
         <label for="">Mật khẩu :</label>
       <input type="text" name="MatKhau" class="form-control">
      </div>
     </div>
     <div class="col">
     <label for="">Địa chỉ:</label>
    <input type="text" name="diachi" class="form-control">
      </div>
      
          <div class="mb-3">
              <label for="quyen" class="form-label">quyền</label>
              <select class="form-select" id="quyen" name="quyen" >
                  <option value="0">Người dùng</option>
                  <option value="1">quản lý</option>
              </select>
          </div>
        <div class="mb-3">
  <label for="formFile" class="form-label">Hình ảnh:</label>
  <input class="form-control" name="HinhAnh" type="file" id="formFile" accept=".jpg, .jpeg, .png" value="">
        </div>

        <button type="submit" name="themsp"  class="btn btn-primary" style="margin-left: 200px;">Upload</button>

        </form>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>



    <table class="table table-hover me-5" style="border: 1px solid #F2B705">
        <thead>
        <th class="text-center" style="border-right:1px solid #F2B705">STT</th>
            <th class="text-center" style="border-right:1px solid #F2B705">Số Điện Thoại</th>
            <th class="text-center" style="border-right:1px solid #F2B705">Mật khẩu</th>
            <th class="text-center" style="border-right:1px solid #F2B705">Họ tên</th>
            <th class="text-center" style="border-right:1px solid #F2B705">Email</th>
            <th class="text-center" style="border-right:1px solid #F2B705">Quyền</th>
            <th class="text-center" style="border-right:1px solid #F2B705">Hình ảnh</th>
            <th class="text-center" style=" border-right:1px solid #F2B705">Xóa</th>
            <th class="text-center" style=" border-right:1px solid #F2B705">Sửa</th>
           
        </thead>
        <tbody>




        <?php
        $sql = "SELECT * FROM taikhoan";

        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["MaTK"] ?></td>
            <td><?php echo $row["SoDienThoai"] ?></td>
            <td><?php echo $row["MatKhau"] ?></td>
            <td><?php echo $row["HoTen"] ?></td>
            <td><?php echo $row["email"] ?></td>
            <td><?php echo $row["Quyen"] ?></td>
            <td class="text-center"><img src="<?=$base_url?>upload/avatar/<?=$row["HinhAnh"]?>"  width = '80px'></td> 
            <td><a href="index.php?mod=admin&act=account-delete&id=<?=$row["MaTK"] ?>" class = 'text-danger'><i class="fa-solid fa-delete-left fa-lg"></i></a></td>
            <td><a href="index.php?mod=admin&act=account-edit&id=<?=$row["MaTK"]?>" class = 'text-success'><i class="fa-solid fa-pen-to-square fa-lg"></i></i></a></td>







          </tr>
        <?php
        }
        ?>


        </tbody>

 
    </table>


</div>