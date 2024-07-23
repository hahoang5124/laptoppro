<?php 
	session_start();
    include_once("model/m_pdo.php");
	include_once "model/m_cart.php";
  $product_in_bill_successful = get_all_bill_sucessful($_SESSION['MaHD_success']);
	$list = get_all_cart($_SESSION['user']['MaTK']);
	$hoaDon = get_bill($_SESSION['user']['MaTK']);
	$payment_id = $statusMsg = ''; 
	$ordStatus = 'error';
	$id = '';

	// Check whether stripe token is not empty

	if(!empty($_POST['stripeToken'])){

		// Get Token, Card and User Info from Form
		$token = $_POST['stripeToken'];
		$name = $_POST['name'];
		$email = $_SESSION['email'];
		$card_no = $_POST['card_number'];
		$card_cvc = $_POST['card_cvc'];
		$card_exp_month = $_POST['card_exp_month'];
		$card_exp_year = $_POST['card_exp_year'];
		$price = $hoaDon['TongTien'] ;
		// Include STRIPE PHP Library
		require_once('stripe-php/init.php');

		// set API Key
		$stripe = array(
		"SecretKey"=>"sk_test_51ODiIaIgCYKblydjbHUZ9s2DGTQFVrxtGMWy5b5AVs3N7PI6aetmjEgzcNJDmnq2oekvpkUqrDvmz3ZxGEsD9iGj003OsKXQq0",
		"PublishableKey"=>"pk_test_51ODiIaIgCYKblydjGVSsE430jL6AETNnd0QZOxC0OcmS3UFLfU91fZQrTuIajTq2Hc6t0rvTnavSNTq1fmDKl3oP00aKccaKre"
		);

		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey($stripe['SecretKey']);
		// Add customer to stripe 
	    $customer = \Stripe\Customer::create(array( 
	        'email' => $email, 
	        'source'  => $token,
	        'name' => $name,
	        'description'=>"thanh toán đơn hàng"
	    ));
	    // Generate Unique order ID 
	    $orderID = strtoupper(str_replace('.','',uniqid('', true)));
	     
	    // Convert price to cents 
	    $itemPrice = $price;
	    $currency = "vnd";

	    // Charge a credit or a debit card 
	    $charge = \Stripe\Charge::create(array( 
	        'customer' => $customer->id, 
	        'amount'   => $itemPrice, 
	        'currency' => $currency, 
	        'description' => "Thanh toán đơn hàng", 
	        'metadata' => array( 
	            'order_id' => $orderID 
	        )
	    ));
	    // Retrieve charge details 
    	$chargeJson = $charge->jsonSerialize();

    	// Check whether the charge is successful 
    	if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 

	        // Order details 
	        $transactionID = $chargeJson['balance_transaction']; 
	        $paidAmount = $chargeJson['amount']; 
	        $paidCurrency = $chargeJson['currency']; 
	        $payment_status = $chargeJson['status'];
	        $payment_date = date("Y-m-d H:i:s");
	        $dt_tm = date('Y-m-d H:i:s');

	        // Insert tansaction data into the database

	        success_cart($hoaDon['MaHD']);
			unset($_SESSION['cart']);
	    } else{ 
	        //print '<pre>';print_r($chargeJson); 
	        $statusMsg = "Transaction has been failed!"; 
	    } 
	} else{ 
		echo "Thanh toán không thành công";
	} 
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Pro</title>
    <link rel="stylesheet" href="http://localhost/laptoppro/template/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" type="text/css" href="css/stripe.css">
    <script src="https://kit.fontawesome.com/cc03047fef.js" crossorigin="anonymous"></script>
</head>
<body class="container">
<div class="card">
  <div class="card-body">
    <div class="container mb-5 mt-3">
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
          <p style="color: #7e8d9f;font-size: 20px;">Hóa đơn <strong>ID: <?=$hoaDon['MaHD']?></strong></p>
        </div>
        <div class="col-xl-3 float-end">
          <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
              class="fas fa-print text-primary"></i> Print</a>
          <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
              class="far fa-file-pdf text-danger"></i> Export</a>
        </div>
        <hr>
      </div>

      <div class="container">
        <div class="col-md-12">
          <div class="text-center">
            <h2>LAPTOPPRO</h2>
            <p class="pt-0">Cảm ơn quý khách đã mua hàng</p>
          </div>

        </div>


        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">Người nhận: <span style="color:#5d9fc5 ;"><strong><?=$_SESSION['name']?></span></li>
              <li class="text-muted">Địa chỉ: <span style="color:#5d9fc5 ;"><strong><?=$_SESSION['diachi']?></span></li>
              <li class="text-muted">Số điện thoại: <span style="color:#5d9fc5 ;"><strong><?= $_SESSION['phone']?></span></li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Hóa đơn</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">ID:</span><?=$hoaDon['MaHD']?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">Ngày lập hóa đơn: </span><?=$hoaDon['NgayLapHoaDon']?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="me-1 fw-bold">Trạng thái:</span><span class="badge bg-success text-black fw-bold">
                  Đã thanh toán</span></li>
            </ul>
          </div>
        </div>

        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA ;" class="text-white">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Giá</th>
                <th scope="col">Thành tiền</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 1; $tongtien = 0; foreach ($product_in_bill_successful as $item): 
              ?>
              <tr>
                <th scope="row"><?=$i?></th>
                <td><?=$item['TenSP']?></td>
                <td><?=$item['TongSanPham']?></td>
                <td><?=$item['gia']?></td>
                <td><?=$item['TongSanPham'] * $item['gia']?></td>
              </tr>
              <?php $i++; $tongtien += $item['TongSanPham'] * $item['gia']; endforeach;?>
            </tbody>

          </table>
        </div>
        <div class="row">
          <div class="col-xl-7">
          </div>
          <div class="col-xl-5 text-end">
            <ul class="list-unstyled">
              <li class="text-muted ms-3"><span class="text-black me-4">Tổng tiền</span><?=$tongtien?> Đ</li>
              <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Phí vận chuyển</span>10.000 Đ</li>
            </ul>
            <p class="text-black"><span class="text-black me-3">Thanh Toán</span><span
                ><?=$tongtien +10000?> Đ</span></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-10">
            <p>Cảm ơn bạn đã thanh toán</p>
          </div>
          <div class="col-xl-2">
            <a href="index.php?mod=page&act=home" class="btn btn-primary text-capitalize"
              style="background-color:#60bdf3 ;">trở về trang chủ</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
    <script src="http://localhost/laptoppro/template/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>