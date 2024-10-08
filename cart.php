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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script type="text/javascript" src="../javascript.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php  include 'header.php' ?>
	

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

		<div class="footer">
			<div class="grid wide">
				<div class="row">
					<div class="column l-2-4 me-4 s-6">
						<h3 class="footer__heading">Chăm sóc khách hàng</h3>
						<ul class="footer-list">
							<li class="footer-item">
								<a href="" class="footer-item-link">Trung tâm trợ giúp</a>
							</li>
							<li class="footer-item">
								<a href="" class="footer-item-link">TT Mail</a>
							</li>
							<li class="footer-item">
								<a href="" class="footer-item-link">Hướng dẫn mua hàng</a>
							</li>
						</ul>
					</div>
					<div class="column l-2-4 me-4 s-6">
						<h3 class="footer__heading">Giới thiệu</h3>
						<ul class="footer-list">
							<li class="footer-item">
								<a href="" class="footer-item-link">Giới thiệu</a>
							</li>
							<li class="footer-item">
								<a href="" class="footer-item-link">Tuyển dụng</a>
							</li>
							<li class="footer-item">
								<a href="" class="footer-item-link">Điều khoản</a>
							</li>
						</ul>
					</div>
					<div class="column l-2-4 me-4 s-6">
						<h3 class="footer__heading">Tiêu chí</h3>
						<ul class="footer-list">
							<li class="footer-item">
								<a  class="footer-item-link">Chất lượng</a>
							</li>
							<li class="footer-item">
								<a  class="footer-item-link">Giá tốt nhất</a>
							</li>
							<li class="footer-item">
								<a  class="footer-item-link">Tất cả vì khách hàng</a>
							</li>
						</ul>
					</div>
					<div class="column l-2-4 me-4 s-6">
						<h3 class="footer__heading">Theo dõi</h3>
						<ul class="footer-list">
							<li class="footer-item">
								<a href="" class="footer-item-link">
									<i class="fab fa-facebook"></i>
									Facebook
								</a>
							</li>
							<li class="footer-item">
								<a href="" class="footer-item-link">
									<i class="fab fa-instagram"></i>
									Instagram
								</a>
							</li>
						</ul>
					</div>
					<div class="column l-2-4 me-4 s-6">
						<h3 class="footer__heading">Liên hệ với chúng tôi</h3>
						<input class="footer__input" type="text" placeholder="Email address">
						<input type="submit" value="Gửi">
					</div>
				</div>
			</div>
			<div class="footer__bottom">
				<div class="grid wide">
					<p>© 2021 - Bản quyền thuộc về công ty TT Shoes</p>
				</div>
			</div>
		</div>
		<div class="scroll-to-top" onclick="scrollToTop();">
			<i class="scroll-to-top-icon fas fa-chevron-up"></i>
		</div>
	</div>
</body>

</html>