<?php
include_once "model/m_admin.php";
if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'category':
            // lấy dữ liệu
            $dsdm = category_list();
            // hiển thị dư liệu
            $view_name = 'admin_category';
            break;
        case 'category_add':
            $dsdm = category_list();
            if(isset($_POST['name'])){
                category_add($_POST['name'],$_POST['status']);
                header('location: ?mod=admin&act=category');
            }
            $view_name = "category_add";
            break;
        case 'category_edit':
            $dsdm = category_list();
            $id = $_GET['id'];
            if(isset($_POST['submit_edit'])){
                $name = $_POST['name'];
                $status = $_POST['status'];
                category_edit($name,$status,$id);
                header('location: ?mod=admin&act=category');
            }
            $dm = category_edit_one($id);
            $view_name ="category_edit";
            break;
        case 'dashboard':
            // lấy dữ liệu
            $dsdm = category_list();
            $tongsp = count_product();
            $tongdm = count_category();
            $tongtk = count_account();
            $tongbill = count_bill();
            $tongthongke = statistical();       
            // hiển thị dư liệu
            $view_name = 'admin_dashboard';
            break;
        case 'product':
            // lấy dữ liệu
            include_once "model/m_admin.php";
            if(isset($_POST['submit'])){
                $TenSP = $_POST['TenSP'];
                $gia = $_POST['gia'];
                $SoLuong = $_POST['SoLuong'];
                $danhmuc = $_POST['danhmuc'];
                $motangan = $_POST['motangan'];
                $motachitiet = $_POST['motachitiet'];
                $HinhAnh = $_FILES['HinhAnh']['name'];
                if($HinhAnh == ""){
                    $HinhAnh = "";
                }else{
                    $targetDirectory = $directoryProduct;
                    $targetFile = $targetDirectory . $_FILES["HinhAnh"]["name"];
                    move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $targetFile);
                }
                product_add($TenSP, $gia, $SoLuong, $danhmuc, $motangan, $motachitiet, $HinhAnh);
                if(isset($_FILES['anhbosung'])){
                    $product_last = get_product_id_last();
                    $anhbosung = $_FILES['anhbosung'];
                        foreach ($anhbosung['name'] as $item => $filename) {
                            $targetDirectory = $directoryProduct;
                            $targetFile = $targetDirectory . $filename;
                            $tempFile = $anhbosung['tmp_name'][$item];
                            move_uploaded_file($tempFile, $targetFile);
                            add_images($filename,$product_last['MaSP']);
                        }
                }
            }
            $list = show_full_product_with_category();
            $category_list = category_list();
            // hiển thị dư liệu
            $view_name = 'admin_product';
        break;
        case 'product-add':
            // lấy dữ liệu
            include_once "model/m_admin.php";
            include_once "model/m_product.php";
            if(isset($_GET['id'])){
                $product = get_product_by_id($_GET['id']);
                $category_list = category_list();
            }
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $ten = $_POST['name'];
                $motangan = $_POST['mtngan'];
                $motachitiet = $_POST['mtchitiet'];
                $gia = $_POST['price'];
                $soluong = $_POST['mount'];
                $image = "";
                if(isset($_FILES['image'])){
                    if($_FILES['image']['name'] == ''){
                        $product = get_product_by_id($id);
                        $image = $product['HinhAnh'];
                    }else{
                        $image =$_FILES['image']['name'];
                        
                    }
                }
                $danhmuc = $_POST['category'];
                $trangthai = $_POST['trangthai'];
                product_update($ten, $image, $gia, $motangan, $motachitiet, $danhmuc, $soluong, $trangthai,$id);
                header('Location: '.$base_url.'index.php?mod=admin&act=product');
            }
            // hiển thị dư liệu
            $view_name = 'admin_product_add';
        break;
        case 'account':
            // lấy dữ liệu
            include_once "model/m_admin.php";
            if(isset($_POST['themsp'])){
                $SoDienThoai = $_POST['SoDienThoai'];
                $MatKhau = $_POST['MatKhau'];
                $HoTen = $_POST['HoTen'];
                $email = $_POST['email'];
                $DiaChi = $_POST['diachi'];
                $Quyen = $_POST['quyen'];
                $HinhAnh = $_FILES['HinhAnh']['name'];
                if($HinhAnh == ""){
                    $HinhAnh = "default.png";
                }else{
                    $targetDirectory = $directoryAvatar;
                    $targetFile = $targetDirectory . $_FILES["HinhAnh"]["name"];
                    move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $targetFile);
                }
                account_add($SoDienThoai,$MatKhau,$HoTen,$email,$DiaChi,$Quyen,$HinhAnh);
                header('Location: '.$base_url.'index.php?mod=admin&act=account');
            }
            // hiển thị dư liệu
            $view_name = 'admin_account';
        break;
        case 'account-edit':
            // lấy dữ liệu
            include_once "model/m_admin.php";
            include_once "model/m_user.php";
            if(isset($_POST["id"])){
                $account = $_POST["id"];
            }else {
                $account = get_all_account($_GET["id"]);
            }
            if(isset($_POST["submit-update"])){
                $hoten = $_POST['hoten'];
                $sodienthoai = $_POST['sodienthoai'];
                $email = $_POST['email'];
                $matkhau = $_POST['matkhau'];
                $quyen = $_POST['quyen'];
                $image = "";
                if(isset($_FILES['image'])){
                    if($_FILES['image']['name'] == ''){
                        $product = get_account_by_id($_POST["id"]);
                        $image = $product['HinhAnh'];
                    }else{
                        $image =$_FILES['image']['name'];
                    }
                }
                $diachi = "";
                if(isset($_POST["diachi"])){
                    $diachi = $_POST["diachi"];
                }
                account_update($hoten,$sodienthoai,$email,$matkhau,$quyen,$image,$diachi,$_POST["id"]);
                header('Location: '.$base_url.'index.php?mod=admin&act=account');
            }
            // hiển thị dư liệu
            $view_name = 'admin_account_edit';
        break;
        case 'account-delete':
            delete_account($_GET['id']);
            header('Location: '.$base_url.'index.php?mod=admin&act=account');

        break;
        case 'cmt':
            include_once "model/m_admin.php";
            $GhimCMT = ghim_category_cmT();
            $dscmt = category_cmT();
            $view_name = "admin_cmt";
            break;
        case 'cmt-edit':
            include_once "model/m_admin.php";
            $review = review_get_all($_GET['id']);
            $view_name = "admin_cmt_edit";
            if(isset($_POST['submit_edit'])){
                review_ghim_update($_POST['status'], $_POST['id']);
                header('Location: '.$base_url.'index.php?mod=admin&act=cmt');
            }
            break;
        case 'bill':
            include_once "model/m_admin.php";
            $ls = bill_getAll();
            $view_name = "admin_bill";
            break;
        case 'bill-accept':
            include_once "model/m_admin.php";
            bill_accept($_GET['id']);
            header('Location: '.$base_url.'index.php?mod=admin&act=bill');
            break;
        case 'bill-delete':
            include_once "model/m_admin.php";
            bill_detailDelete($_GET['id']);
            bill_delete($_GET['id']);
            header('Location: '.$base_url.'index.php?mod=admin&act=bill');
            break;
        case 'successfully':
            include_once "model/m_admin.php";
            $ls = bill_succesfully();
            $view_name = "admin_succesfully";
            break;
    }
    include_once 'view/v_admin_layout.php';
} else {
    header('Location: '.$base_url.'index.php?mod=admin&act=dashboard');
}
?>