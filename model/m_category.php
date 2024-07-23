<?php
include_once("m_pdo.php");
function get_all_category(){
    return pdo_query("SELECT * FROM danhmuc WHERE trangthai ='Đang hoạt động'");
}
function get_all_dm(){
    return pdo_query("SELECT * FROM danhmuc");
}
function categoryAll(){
    $sql = "SELECT * FROM danhmuc WHERE trangthai ='Đang hoạt động'";
    return pdo_query($sql);
}
function category_id($id){
    return pdo_query_one("SELECT * FROM danhmuc WHERE MaDM = ? AND trangthai ='Đang hoạt động'",$id);
}
function category_product($id,$page){
    $start = ($page-1)*4;
    return pdo_query("SELECT * FROM sanpham sp INNER JOIN danhmuc dm ON sp.MaDM = dm.MaDM WHERE sp.MaDM = ? AND sp.TrangThai = 'con-hang' LIMIT $start,4",$id);
}
function turn_of_all_product_by_category($dm){
    pdo_execute ("UPDATE sanpham SET TrangThai = 'an-theo-danh-muc' WHERE MaDM =? and TrangThai = 'con-hang'",$dm);
}
function turn_on_all_product_by_category($dm){
    pdo_execute ("UPDATE sanpham SET TrangThai = 'con-hang' WHERE MaDM =? and TrangThai = 'an-theo-danh-muc'",$dm);
}
?>