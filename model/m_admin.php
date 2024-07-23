<?php
    include_once 'm_pdo.php';
    include_once 'database.php';
 /*    start hà */
 function bill_getAll(){
    return pdo_query("SELECT * FROM hoadon WHERE TrangThai = 'hoan-thanh'");
}
function bill_succesfully(){
    return pdo_query("SELECT * FROM hoadon WHERE TrangThai = 'da-giao'");
}
function product_accept($mhd){
    return pdo_query("SELECT hd.MaHD, sp.HinhAnh, sp.TenSP, sp.gia, tk.HoTen, cthd.SoSanPham FROM hoadon hd INNER JOIN chitiethoadon cthd on hd.MaHD = cthd.MaHD INNER JOIN sanpham sp on sp.MaSP = cthd.MaSP INNER JOIN taikhoan tk on tk.MaTK = HD.MaTK WHERE hd.MaHD = ?", $mhd);
}
function bill_accept($MaLS){
    pdo_execute("UPDATE hoadon set TrangThai = ? WHERE MaHD = ?", "da-giao", $MaLS);
}
function bill_detailDelete($MaLS){
    pdo_execute("DELETE FROM chitiethoadon WHERE MaHD = ?",$MaLS);
}
function bill_delete($MaLS){
    pdo_execute("DELETE FROM hoadon WHERE MaHD = ?",$MaLS);
}

/*     end hà */
    //start category
    function category_list(){
        $sql =" SELECT * FROM danhmuc";
        return pdo_query($sql);
    }
    function category_add($name,$status){
        $sql ="INSERT INTO danhmuc(TenDM,trangthai) VALUES (?,?)";
        return pdo_execute($sql,$name,$status);
    }
    function category_edit_one($id){
        $sql ="SELECT * FROM danhmuc WHERE MaDM=?";
        return pdo_query_one($sql,$id);
    }
    function category_edit($name,$status,$id){
        $sql="UPDATE danhmuc SET TenDM=?, trangthai=? WHERE MaDM=?";
        return pdo_execute($sql,$name,$status,$id);
    }
    function count_products_in_category($dm){
        return pdo_query_value ("SELECT COUNT(*) FROM sanpham WHERE MaDM = ?", $dm);
    }
    //end category
    function count_product(){
        $sql = "SELECT COUNT(*) FROM sanpham";
        return pdo_query_value($sql);
    }
    function count_category(){
        $sql = "SELECT COUNT(*) FROM danhmuc";
        return pdo_query_value($sql);
    }
    function count_account(){
        $sql = "SELECT COUNT(*) FROM taikhoan";
        return pdo_query_value($sql);
    }
    function count_bill(){
        $sql = "SELECT COUNT(*) FROM hoadon WHERE TrangThai='hoan-thanh'";
        return pdo_query_value($sql);
    }
/* start minh */
    function add_images($anh,$masp){
        pdo_execute("INSERT INTO anhbosung (`anh`, `MaSP`) VALUES (?,?)",$anh, $masp);
    }
    function get_product_id_last(){
        return pdo_query_one("SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT 1");
    }
    function show_full_product_with_category(){
        return pdo_query ("SELECT * FROM sanpham sp INNER JOIN danhmuc dm ON sp.MaDM = dm.MaDM");
    }
    function product_add($name, $gia, $soluong, $danhmuc, $motangan, $motadai, $hinhanh){
        pdo_execute("INSERT INTO sanpham (`TenSP`, `gia`, `SoLuong`, `MaDM`, `MoTaNgan`, `MoTaChiTiet`,`HinhAnh`) VALUES (?,?,?,?,?,?,?)",$name, $gia, $soluong, $danhmuc, $motangan, $motadai, $hinhanh);
    }
    function product_update($ten, $anh, $gia, $motangan, $motachitiet, $madm, $soluong,$trangthai,$id){
        pdo_execute("UPDATE sanpham SET TenSP = ?, HinhAnh =?, gia = ?, MoTaNgan = ?, MoTaChiTiet = ?, MaDM = ?, SoLuong =?, TrangThai = ? WHERE MaSP = ?", $ten, $anh, $gia, $motangan, $motachitiet, $madm, $soluong,$trangthai,$id);
    }
    function get_all_account($id){
        return pdo_query_one ("SELECT * FROM taikhoan WHERE MaTK = ?", $id);
    }
    function account_update($ten, $sdt, $email, $matkhau, $quyen, $anh, $diachi ,$id){
        pdo_execute("UPDATE taikhoan SET HoTen = ?, SoDienThoai =?, email = ?, MatKhau = ?, Quyen = ?, HinhAnh = ?, DiaChi = ? WHERE MaTK = ?", $ten, $sdt, $email, $matkhau, $quyen, $anh, $diachi, $id);
    }
    function get_account_by_id($id){
        return pdo_query_one("SELECT * FROM taikhoan WHERE MaTK = ?", $id);
    }
    function delete_account($id){
        pdo_execute ('DELETE FROM taikhoan WHERE MaTK=?', $id);
    }
    function account_add($sdt,$mk,$name,$email,$diachi,$quyen,$anh){
        pdo_execute("INSERT INTO taikhoan (`SoDienThoai`, `MatKhau`, `HoTen`, `email`, `DiaChi`, `Quyen`,`HinhAnh`) VALUES (?,?,?,?,?,?,?)",$sdt,$mk,$name,$email,$diachi,$quyen,$anh);
    }
/* end minh */
/* start toàn */
function statistical() {
    $sql = " SELECT dm.MaDM, dm.TenDM, COUNT(sp.MaSP) AS SoLuong
     FROM danhmuc dm LEFT JOIN sanpham sp ON dm.MaDM = sp.MaDM GROUP BY dm.MaDM";
     return pdo_query($sql);
 }
 function category_cmT(){
     $sql =" SELECT * FROM binhluan bl INNER JOIN taikhoan tk ON bl.MaTK = tk.MaTK INNER JOIN sanpham sp ON bl.MaSP = sp.MaSP";
     return pdo_query($sql);
 }
 function ghim_category_cmT(){
     $sql =" SELECT * FROM binhluan bl INNER JOIN taikhoan tk ON bl.MaTK = tk.MaTK INNER JOIN sanpham sp ON bl.MaSP = sp.MaSP WHERE GhimBinhLuan = 1 ORDER BY MaBL DESC";
     return pdo_query($sql);
 }
 function category_delete($id){
     $sql ="DELETE FROM binhluan WHERE MaBL=?";
     return pdo_execute($sql,$id);
 } function review_get_all($id){
    return pdo_query_one ("SELECT * FROM binhluan WHERE MaBL = ?", $id);
}
function review_ghim_update($status,$id){
    pdo_execute ("UPDATE binhluan SET GhimBinhLuan = ? WHERE MaBL =?", $status, $id);
}
/* end toàn */
?>