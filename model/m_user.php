<?php
include_once("m_pdo.php");
function user_login($phone, $pass){
    return pdo_query_one("SELECT * FROM taikhoan WHERE SoDienThoai = ? AND MatKhau = ?", $phone, $pass);
}
function user_signup($phone,$pass,$name,$email){
    pdo_execute("INSERT INTO taikhoan(`SoDienThoai`,`MatKhau`,`HoTen`,`email`) VALUES (?,?,?,?)",$phone, $pass,$name,$email);
}
function check_phone_account($phone){
    return pdo_query_one("SELECT * FROM taikhoan WHERE SoDienThoai = ?", $phone);
}
function check_email_account($email){
    return pdo_query_one("SELECT * FROM taikhoan WHERE email = ?", $email);
}

function info_update($ten, $sdt, $email, $anh, $diachi ,$id){
    pdo_execute("UPDATE taikhoan SET HoTen = ?, SoDienThoai =?, email = ?, HinhAnh = ?, DiaChi = ? WHERE MaTK = ?", $ten, $sdt, $email, $anh, $diachi, $id);
}
function get_all_user_by_id($id){
    return pdo_query_one("SELECT * FROM taikhoan WHERE MaTK = ?", $id);
}
?>