<?php
include_once 'm_pdo.php';
function get_product_by_category($category){
    return pdo_query("SELECT * FROM sanpham WHERE MaDM = ? AND TrangThai = 'con-hang'",$category);
}
function get_product_by_purchases(){
    return pdo_query("SELECT * FROM sanpham WHERE TrangThai = 'con-hang' ORDER BY LuotMua DESC LIMIT 10");
}
function get_product_all(){
    return pdo_query("SELECT * FROM sanpham WHERE TrangThai = 'con-hang'");
}
function page_product($page){
    $start = ($page-1)* 8;
    return pdo_query("SELECT * FROM sanpham WHERE TrangThai = 'con-hang' LIMIT $start,8");
}
function page_product_all_by_purchases($page){
    $start = ($page-1)* 8;
    return pdo_query("SELECT * FROM sanpham WHERE TrangThai = 'con-hang' ORDER BY LuotMua DESC LIMIT $start,8 ");
}
function get_product_filter_min_max($min, $max){
    return pdo_query("SELECT * FROM sanpham WHERE gia BETWEEN ? AND ? AND TrangThai = 'con-hang'",$min, $max);
}
function get_product_filter_min($min){
    return pdo_query("SELECT * FROM sanpham WHERE gia >= $min  AND TrangThai = 'con-hang'");
}
function get_product_filter_max($max){
    return pdo_query("SELECT * FROM sanpham WHERE gia <= ?  AND TrangThai = 'con-hang'", $max);
}
function page_product_filter_min_max($min, $max, $page){
    $start = ($page-1)* 8;
    return pdo_query("SELECT * FROM sanpham WHERE gia BETWEEN ? AND ?  AND TrangThai = 'con-hang' LIMIT $start,8",$min, $max);
}
function page_product_filter_min($min, $page){
    $start = ($page-1)* 8;
    return pdo_query("SELECT * FROM sanpham WHERE gia >= $min AND TrangThai = 'con-hang' LIMIT $start,8");
}
function page_product_filter_max($max, $page){
    $start = ($page-1)* 8;
    return pdo_query("SELECT * FROM sanpham WHERE gia <= ?  AND TrangThai = 'con-hang' LIMIT $start,8", $max);
}
function get_product_by_id($id){
    return pdo_query_one("SELECT * FROM sanpham WHERE MaSP = ? ", $id);
}
function Get_product_images($id){
    return pdo_query("SELECT * FROM anhbosung WHERE MaSP = ?", $id);
}
function product_search($keyword,$page=1){
    $start = ($page-1)*8;
    $sql = "SELECT * FROM sanpham WHERE TenSP LIKE '%$keyword%' AND TrangThai = 'con-hang' LIMIT $start,8";
    return pdo_query($sql);        
}
function productS($keyword){
    $sql = "SELECT COUNT(*) FROM sanpham WHERE TenSP LIKE '%$keyword%' AND TrangThai = 'con-hang'";
    return pdo_query_value($sql);  
}
function count_product_in_category($MaDM){
    $sql = "SELECT COUNT(*) FROM SanPham WHERE MaDM = $MaDM AND TrangThai = 'con-hang'";
    return pdo_query_value($sql);  
}
?>