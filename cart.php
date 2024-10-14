<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);
?>

<html>

<head>
	<title>Giỏ hàng </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/grid.css">
	<link rel="stylesheet" type="text/css" href="./css/responsive.css">
	<link rel="stylesheet" type="text/css" href="./css/main.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
		integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script type="text/javascript" src="../javascript.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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


	<ul class="header__sort-bar">
		<li class="header__sort-item">
			<a href="" class="header__sort-link" style="font-size: large;">Giỏ hàng</a>
		</li>
	</ul>
	<!-- BÊN DƯỚI LÀ sản phẩm -->

	<div class="footer">
		<div class="grid wide">
			<?php
			$total = 0;
			$user_id = $_SESSION['user_id']; // Giả sử bạn đã lưu user_id trong session
			
			// Kiểm tra xem người dùng đã đăng nhập và có giỏ hàng không
			if (isset($user_id)) {
				// Lấy sản phẩm trong giỏ hàng từ cơ sở dữ liệu
				$sql = "SELECT cart.product_id, cart.quantity, products.product_name, products.price 
						FROM cart 
						JOIN products ON cart.product_id = products.product_id 
						WHERE cart.user_id = '$user_id'";
				$query = mysqli_query($conn, $sql);

				// Kiểm tra xem có sản phẩm nào trong giỏ hàng không
				if (mysqli_num_rows($query) > 0) {
					echo "<form action='../pages/giohang.php' method='post'>";

					// Hiển thị sản phẩm trong giỏ hàng
					while ($row = mysqli_fetch_array($query)) {
						echo "<div>";
						echo "<h5>{$row['product_name']}</h5>";
						echo "Giá sản phẩm: " . number_format($row['price']) . "đ<br />";
						echo "<p align='right'>Số lượng: <input type='number' name='qty[{$row['product_id']}]' size='5' value='{$row['quantity']}'> - ";
						echo "<a href='../pages/delcart.php?productid={$row['product_id']}'>Xóa</a></p>";
						echo "<p align='right'> Giá tiền cho món hàng: " . number_format($row['quantity'] * $row['price']) . " đ</p>";
						echo "<hr></div>";
						$total += $row['quantity'] * $row['price'];
					}

					echo "<div class='pro' align='right'>";
					echo "<b>Tổng tiền cho các món hàng: <font color='red'>" . number_format($total) . " đ</font></b><hr>";
					$_SESSION['total'] = $total; // Bạn có thể cần tổng tiền trong session
			
					echo "<a href='../pages/thanhtoan.php'> <p> <input type='button' value='Thanh toán'></p></a>";
					echo "<input type='submit' align='left' name='submit' value='Cập nhật giỏ hàng'>";
					echo "<div class='pro' align='center'>";
					echo "<b><a href='../index.php'>Mua sắm tiếp</a> - <a href='../pages/delcart.php?productid=0'>Xóa bỏ giỏ hàng</a></b>";
					echo "</div>";
				} else {
					// Nếu không có sản phẩm trong giỏ hàng
					echo "<div class='pro'>";
					echo "<p align='center'>Bạn không có món hàng nào trong giỏ hàng <br/><a href='../index.php'>Mua giày mới nào!</a></p>";
					echo "</div>";
				}
			} else {
				// Nếu người dùng chưa đăng nhập
				echo "<div class='pro'>";
				echo "<p align='center'>Bạn cần đăng nhập để xem giỏ hàng <br/><a href='../login.php'>Đăng nhập</a></p>";
				echo "</div>";
			}
			?>
		</div>

	</div>	
	</div>
	<?php include './footer.php'?>
</body>

</html>