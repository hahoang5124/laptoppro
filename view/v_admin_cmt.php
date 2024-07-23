

<div class="container mt-3">
    <h3 class="text-center">Quản lý bình luận</h3>
    <table class="table table-hover me-5" style="border: 1px solid #F2B705">
        <thead>
            <th class="text-center">ID</th>
            <th class="text-center">Sản phẩm</th>
            <th class="text-center">Người gửi</th>
            <th class="text-center">Nội dung</th>
            <th class="text-center">Ngày gửi</th>
            <th class="text-center">Sao</th>
            <th class="text-center">Ghim</th>
            <th class="text-center">Sửa</th>
            <th class="text-center">xóa</th>
        </thead>
        <tbody>
            <?php foreach ($dscmt as $cmt) : ?>
                <tr>
                    <td><?= $cmt['MaBL'] ?></td>
                    <td><?= $cmt['TenSP'] ?></td>
                    <td><?= $cmt['HoTen'] ?></td>
                    <td><?= $cmt['NoiDung'] ?></td>
                    <td><?= $cmt['NgayGui'] ?></td>
                    <td><?= $cmt['SoSao'] ?></td>
                    <td><?php
                    switch ($cmt['GhimBinhLuan']) {
                        case '0':
                            echo "Không";
                            break;
                        case '1':
                            echo "Có";
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                    ?></td>
                    <td>
                    <a href="index.php?mod=admin&act=cmt-edit&id=<?= $cmt['MaBL'] ?>"><i class="fa-solid fa-pen-to-square fa-lg" style="color: #11e302;"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="index.php?mod=category&act=delete&id=<?= $cmt['MaBL'] ?>"><i class="fa-solid fa-delete-left fa-lg" style="color: #b71f1f;"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
