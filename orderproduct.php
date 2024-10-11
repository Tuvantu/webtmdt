<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);

?>
<html>

<head>
	<title>Đặt hàng</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/grid.css">
	<link rel="stylesheet" type="text/css" href="./css/responsive.css">
	<link rel="stylesheet" type="text/css" href="./css/main.css">
	<link rel="stylesheet" href="./css/orderproduct.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
		integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../javascript.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- Fontawesome css -->
	<link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/all.min.css">
	<link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/brands.min.css">
	<link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/fontawesome.min.css">
	<!-- Fontawesome js -->
	<link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/all.min.js">
	<link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/brands.min.js">
	<link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/fontawesome.min.js">


</head>

<body>

	<?php include 'header.php' ?>


	<div class="container">

		<!-- THÔNG TIN ĐẶT HÀNG -->
		<div class="container_content">

			<!-- THÔNG TIN ĐỊA CHỈ -->
			<div class="ship_infomation">
				<div class="title">
					<span>Thông tin giao hàng</span>
				</div>
				<div class="info_detail">
					<div class="info_user">
						<div class="info_row">
							<label for="">Họ và tên</label>
							<input type="text" name="name" placeholder="Họ và tên" required>
						</div>

						<div class="info_row">
							<label for="">Số điện thoại</label>
							<input type="phone" name="phone_number" placeholder="Số điện thoại" required>
						</div>

					</div>

					<div class="info_address">
						<div class="info_row">
							<label for="">Địa chỉ nhận hàng</label>
							<input type="text" name="ship_recieve" placeholder="Vui lòng nhập địa chỉ của bạn" required>
						</div>

						<div class="info_row">
							<label for="">Tỉnh / Thành phố</label>
							<input type="text" name="ship_recieve" placeholder="Vui lòng nhập tỉnh / thành phố"
								required>
						</div>

						<div class="info_row">
							<label for="">Quận / huyện</label>
							<input type="text" name="ship_recieve" placeholder="Vui lòng nhập quận / huyện" required>
						</div>

						<div class="info_row">
							<label for="">Phường / xã</label>
							<input type="text" name="ship_recieve" placeholder="Vui lòng nhập phường / xã">
						</div>
					</div>
				</div>

				<div class="button">
					<button type="button">Lưu</button>
				</div>

				<div class="product">
					<div class="product_detail">
						<div class="product_photo">
							<img src="./img/sp1.webp" alt="">
						</div>

						<div class="product_name">
							<span>Điện thoại Oppo A73</span>
						</div>

						<div class="product_price">
							<span>3.000.000 đ</span>
						</div>

						<div class="product_quantity">
						<span>Số lượng: <span>1</span></span>
						</div>
					</div>
				</div>
			</div>
			<!-- CHỌN PHƯƠNG THỨC THANH TOÁN -->
			<div class="payment">
				<div class="title">
					<span>Chọn phương thức thanh toán</span>
				</div>

				<div class="payment_content">
					<div class="method_payment" style="padding-left: 5px">
						<input type="radio" id="cod" name="payment" value="cod" style="width: 20px">
						<div class="method_avt">
							<i class="fa-solid fa-money-bill-1-wave"></i>
						</div>
						<div class="method_name">
							<span>Thanh toán khi nhận hàng</span>
						</div>
					</div>

					<div class="method_payment" style="padding-left: 5px;">
						<input type="radio" id="card" name="payment" value="card" style="width: 20px">
						<div class="method_avt" style="color: blue">
							<i class="fa-solid fa-credit-card"></i>
						</div>
						<div class="method_name">
							<span>Thanh toán qua thẻ ngân hàng</span>
						</div>
					</div>

					<div class="method_payment" style="padding-left: 5px;">
						<input type="radio" id="zalopay" name="payment" value="zalopay" style="width: 20px">
						<div class="method_avt" style="color: orange">
							<i class="fa-solid fa-mobile-alt"></i>
						</div>
						<div class="method_name">
							<span>Thanh toán qua ví ZaloPay</span>
						</div>
					</div>

				</div>

				<div class="info_order">
					<div class="title">
						<span>Thông tin đơn hàng</span>
					</div>

					<div class="provisional">
						<div class="provisional_title">
							<span>Tạm tính (1 sản phẩm): </span>
						</div>

						<div class="provisional_price">
							<span>3.000.000 đ</span>
						</div>
					</div>

					<div class="ship">
						<div class="ship_title">
							<span>Phí vận chuyển: </span>
						</div>

						<div class="ship_price">
							<span>0 đ</span>
						</div>
					</div>

					<div class="total_order">
						<div class="total_title">
							<span>Tổng cộng: </span>
						</div>

						<div class="total_price">
							<span>3.000.000 đ</span>
						</div>
					</div>

					<div class="button_payment">
						<button type="button">Thanh toán</button>
					</div>


				</div>

			</div>


		</div>
	</div>



	<?php include 'footer.php' ?>

</body>

</html>