<?php
include './config.php';

if (isset($_GET['id'])) {
	$product_id = $_GET['id'];
	$sql = "SELECT * FROM products WHERE product_id = $product_id";
	$result = mysqli_query($conn, $sql);
	$fetch_product = mysqli_fetch_assoc($result);
}

?>
<html>

<head>
	<title>Sản phẩm</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/grid.css">
	<link rel="stylesheet" type="text/css" href="./css/responsive.css">
	<link rel="stylesheet" type="text/css" href="./css/main.css">
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

	<script>
		$(document).ready(function () {
			$("#Guibl").click(function () {

				$.post("../pages/thembinhluan.php",
					{
						username: $("#username").val(),
						noidung: $("#noidung").val(),
						idsp: $("#idsp").val()
					},
					function (data, status) {
						$("#dsbinhluan").append("<p> <?php echo $_SESSION['username']; ?>" + ":  " + $("#noidung").val() + "</p> ");
						$("#noidung").val('');

					});
			});
		});
	</script>
</head>

<body>
	<div class="app">

		<?php include 'header.php' ?>


		<div class="product-detail">
			<div class="grid wide">

				<div class="prodoct-detail-info">
					<div class="grid__column-left">
						<div class="product-detail-item-img">
							<div class="product-detail-item-img-general product-detail-item-img-1" id="img-1"
								style="background-image: url('./upload_image/<?php echo $fetch_product['product_image']; ?>');">
							</div>
						</div>
					</div>
					<div class="grid__column-right">
						<div class="product-detail-title">

							<span class="product-detail-label">
								<?php echo $fetch_product['product_name'] ?>
							</span>
						</div>
						<div class="product-detail-appreciate">
							<div class="product-detail-appreciate__space product-detail-appreciate__rating">
								<span style="text-decoration: underline;">Làm sau</span>
								<i class="home-product-item__star-gold fas fa-star"></i>
								<i class="home-product-item__star-gold fas fa-star"></i>
								<i class="home-product-item__star-gold fas fa-star"></i>
								<i class="home-product-item__star-gold fas fa-star"></i>
								<i class="home-product-item__star-gold fas fa-star"></i>
							</div>
							<div style="border-right: none;"
								class="product-detail-appreciate__space product-detail-appreciate__appre">
								<span>1k</span>
								<div class="product-detail-label-lb">Đánh giá ( làm sau )</div>
							</div>
							<!-- <div class="product-detail-appreciate__space product-detail-appreciate__sold">
								<span>2,6k</span>
								<div class="product-detail-label-lb">Đã bán</div>
							</div> -->
						</div>

						<div class="product-detail-price">
							<span class="product-detail-price__present">
								<?php echo number_format($fetch_product['price'], 0, ',', '.'); ?> đ
							</span>
						</div>

						<div class="product-detail-ship">
							<label class="product-detail-label-lb" style="width: 110px;">Vận chuyển</label>
							<div class="product-detail-ship-content">
								<div class="product-detail-ship-content-free">
									<img src="./img/free_shipping.png" height="30" width="30">
									<span style="margin-left: 5px;">Miễn phí vận chuyển</span>
								</div>
							</div>
						</div>

						<div class="product-detail-quantity">
							<div class="product-detail-label-lb" style="width: 110px;">Số lượng</div>

							<?php
							if ($fetch_product['quantity'] > 1) {
								?>

								<div class="product-detail-quantity-action">
									<input type="button" value="-" id="btn-sub" 
										class="product-detail-quantity-btn product-detail-quantity-btn-left">
									<input max="<?php $fetch_product['quantity'] ?>" min="1" type="number" value="1" id="quantity-input" class="product-detail-quantity-input">
									<input type="button" value="+" id="btn-add"
										class="product-detail-quantity-btn product-detail-quantity-btn-right">
								</div>

								<?php
							} else {

								?>
								<div class="product-detail-quantity-action">
									<input type="text" disabled value="1" id="quantity-input" class="product-detail-quantity-input">
								</div>
								<?php
							}
							?>

						</div>

						<div class="product-detail-shopping">
							<a href="../pages/addcart.php?item='.$row['id'].'">
								<button class="product-detail-shopping-addtocart-btn" data-toggle="modal"
									ata-target="#dialog1">
									<i class="fas fa-cart-plus"></i>
									Thêm vào giỏ hàng
								</button>
							</a>
						</div>
					</div>
				</div>';

				<?php
				$category_id = $fetch_product['category_id'];
				$select_category = mysqli_query($conn, "select * from categories where category_id = '$category_id'");
				$fetch_category = mysqli_fetch_assoc($select_category);
				?>

				<div class="product-detail-decribe">
					<div class="product-detail-describe__detail">
						<h3 class="product-detail-decribe-heading">CHI TIẾT SẢN PHẨM</h3>
						<div class="product-detail-describe__detail-content">

							<div class="product-detail-describe__detail-content-row">
								<label class="product-detail-describe-label">Mô tả:</label>
								<div class="product-detail-describe__detail-content-column">
									<?php echo $fetch_product['description'] ?>
								</div>
							</div>

							<div class="product-detail-describe__detail-content-row">
								<label class="product-detail-describe-label">Danh mục</label>
								<div class="product-detail-describe__detail-content-column">
									<ul class="product-detail-breadcrumb">
										<li><?php echo $fetch_category['category_name'] ?></li>
									</ul>
								</div>
							</div>
							<div class="product-detail-describe__detail-content-row">
								<label class="product-detail-describe-label">Thời gian đã sử dụng:</label>
								<div class="product-detail-describe__detail-content-column">
									<?php echo $fetch_product['time_used'] ?>
								</div>
							</div>
							<div class="product-detail-describe__detail-content-row">
								<label class="product-detail-describe-label">Thời gian mua:</label>
								<div class="product-detail-describe__detail-content-column">
									<?php echo $fetch_product['purchase_time'] ?>
								</div>
							</div>
							<div class="product-detail-describe__detail-content-row">
								<label class="product-detail-describe-label">Địa chỉ mua:</label>
								<div class="product-detail-describe__detail-content-column">
									<?php echo $fetch_product['place_of_purchase'] ?>
								</div>
							</div>
							<div class="product-detail-describe__detail-content-row">
								<label class="product-detail-describe-label">Giá lúc mua:</label>
								<div class="product-detail-describe__detail-content-column">
									<?php echo number_format($fetch_product['purchase_price'], 0, ',', '.'); ?> đ
								</div>
							</div>
							<div class="product-detail-describe__detail-content-row">
								<label class="product-detail-describe-label">Hạn sử dụng:</label>
								<div class="product-detail-describe__detail-content-column">
									<?php echo $fetch_product['warranty_period'] ?>
								</div>
							</div>

						</div>
					</div>
					<div class="product-detail-describe__describe">



						<div class="product-detail-appreciation">
							<h3 class="product-detail-appreciation-heading">ĐÁNH GIÁ SẢN PHẨM</h3>
							<div class="product-detail-appreciation-content">
								<div class="product-detail-appreciation-content-row">
									<div id="dsbinhluan">

										<div class="product-detail-appreciation-content-right">
											<div class="product-detail-appreciation-account-name">
												<i class="product-detail-appreciation-account-icon fas fa-user-circle">
												</i> '.$row7['username'].'
											</div>
											<div class="product-detail-appreciation-rating">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="far fa-star"></i>
											</div>
											<div class="product-detail-appreciation-content-content">
												'.$row7['noidung'].'
											</div>
											<div class="product-detail-appreciation-time">
												'.$row7['time'].'
											</div>
											<div class="product-detail-appreciation-action">
												<span class="product-detail-appreciation-action-like">Thích</span>
												<span class="product-detail-appreciation-action-reply">Phản hồi</span>
												<a href=" ../pages/xoabl.php?id= '.$row7['id'].'"><span
														class="product-detail-appreciation-action-reply"
														style="color: pink;">Xóa</span></a>
											</div>
										</div>
										';}


									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- SP tuong tu -->
					<div class="container text-center my-3">
						<h3>Sản phẩm bán chạy</h3>
						<!-- BÊN DƯỚI LÀ sản phẩm -->
						<div class="home-product">
							<div class="row sm-gutter">
								<?php
								while ($row = mysqli_fetch_assoc($result)) {
									if ($row['soluong'] > 0) {
										echo '<div class="column l-2-4 me-4 s-6" >
							<a class="home-product-item" href="../pages/sanpham.php?id= ' . $row['id'] . '">
								<div class="home-product-item__img" style="background-image:url(../' . $row['hinhanh'] . ')">
								</div>
								<h4 class="home-product-item__name">' . $row['tensp'] . '</h4>
								<div class="home-product-item__price">
									<div class="home-product-item__price-old">' . number_format($row['giasp'], 3) . 'đ</div>
									<div class="home-product-item__price-new">' . number_format($row['giasp'] - $row['giasp'] * 0.25, 3) . 'đ</div>
								</div>
								<div class="home-product-item__action">
									<span class="home-product-item__like home-product-item__liked">
										<i class="home-product-item__like-none far fa-heart"></i>
										<i class="home-product-item__like-fill fas fa-heart"></i>
									</span>
									<div class="home-product-item__rating">
										<i class="home-product-item__star-gold fas fa-star"></i>
										<i class="home-product-item__star-gold fas fa-star"></i>
										<i class="home-product-item__star-gold fas fa-star"></i>
										<i class="home-product-item__star-gold fas fa-star"></i>
										<i class="home-product-item__star-gold fas fa-star"></i>
									</div>
									<span class="home-product-item__sold">Số lượng:' . $row['soluong'] . '</span>
								</div>
								
								<div class="home-product-item__favorite">
									<i class="home-product-item__favorite-icon fas fa-check"></i>
									<span>Yêu thích</span>
								</div>
								<div class="home-product-item__sale">
									<span class="home-product-item__sale-percent">25%</span>
									<span class="home-product-item__sale-label">GIẢM
									</span>
								</div>
							</a>
						</div>';
									} else {
										echo '<div class="column l-2-4 me-4 s-6" >
							<a class="home-product-item" href="../pages/sanpham.php?id= ' . $row['id'] . '">>
								<div class="home-product-item__img" style="background-image:url(' . $row['hinhanh'] . ')">
								</div>
								<h4 class="home-product-item__name">' . $row['tensp'] . '</h4>
								<div class="home-product-item__price">
									<div class="home-product-item__price-old">' . number_format($row['giasp'], 3) . 'đ</div>
									<div class="home-product-item__price-new">' . number_format($row['giasp'] - $row['giasp'] * 0.25, 3) . 'đ</div>
								</div>
								<div class="home-product-item__action">
									<span class="home-product-item__like home-product-item__liked">
										<i class="home-product-item__like-none far fa-heart"></i>
										<i class="home-product-item__like-fill fas fa-heart"></i>
									</span>
									<div class="home-product-item__rating">
										<i class="home-product-item__star-gold fas fa-star"></i>
										<i class="home-product-item__star-gold fas fa-star"></i>
										<i class="home-product-item__star-gold fas fa-star"></i>
										<i class="home-product-item__star-gold fas fa-star"></i>
										<i class="home-product-item__star-gold fas fa-star"></i>
									</div>
									<span class="home-product-item__sold">Số lượng: Hết hàng</span>
								</div>
								
								<div class="home-product-item__favorite">
									<i class="home-product-item__favorite-icon fas fa-check"></i>
									<span>Yêu thích</span>
								</div>
								<div class="home-product-item__sale">
									<span class="home-product-item__sale-percent">25%</span>
									<span class="home-product-item__sale-label">GIẢM
									</span>
								</div>
							</a>
						</div>';
									}
								}
								?>
							</div>
						</div>
						<!-- BÊN trên LÀ sản phẩm -->





					</div>
				</div>
				<!-- modal -->
				<div class="modal" id="dialog1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">

							<div class="modal-header">
								<h5 class="modal-title">Thêm vào giỏ hàng thành công</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>


							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

							</div>

						</div>
					</div>
				</div>
				<div class="modal" id="dialog2" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Mua Thành Công</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>


							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

							</div>

						</div>
					</div>
				</div>




				<div class="footer">
					<div class="grid wide">
						<div class="grid__row">
							<div class="grid__column-2-4">
								<h3 class="footer__heading">Chăm sóc khách hàng</h3>
								<ul class="footer-list">
									<li class="footer-item">
										<a href="" class="footer-item-link">Trung tâm trợ giúp</a>
									</li>
									<li class="footer-item">
										<a href="" class="footer-item-link">HT Mall</a>
									</li>
									<li class="footer-item">
										<a href="" class="footer-item-link">Hướng dẫn mua hàng</a>
									</li>
								</ul>
							</div>
							<div class="grid__column-2-4">
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
							<div class="grid__column-2-4">
								<h3 class="footer__heading">Danh mục</h3>
								<ul class="footer-list">
									<li class="footer-item">
										<a href="" class="footer-item-link">Hoddie</a>
									</li>
									<li class="footer-item">
										<a href="" class="footer-item-link">Sweater</a>
									</li>
									<li class="footer-item">
										<a href="" class="footer-item-link">Áo ấm mùa hè</a>
									</li>
								</ul>
							</div>
							<div class="grid__column-2-4">
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
							<div class="grid__column-2-4">
								<h3 class="footer__heading">Liên hệ với chúng tôi</h3>
								<input class="footer__input" type="text" placeholder="Email address">
								<input type="submit" value="Gửi">
							</div>
						</div>
					</div>
					<div class="footer__bottom">
						<div class="grid wide">
							<p>© 2020 - Bản quyền thuộc về công ty HT Clothes</p>
						</div>
					</div>
				</div>
				<div class="scroll-to-top" onclick="scrollToTop();">
					<i class="scroll-to-top-icon fas fa-chevron-up"></i>
				</div>
			</div>

			<script type="text/javascript">
				var sub = document.getElementById('btn-sub');
				var add = document.getElementById('btn-add');
				var input = document.getElementById('quantity-input');
				sub.addEventListener('click', function () { subValue(); });
				add.addEventListener('click', function () { addValue(); });
				function subValue() {
					if (input.value <= 1) {
						return 1;
					} else {
						--input.value;
					}
				}
				function addValue() {
					++input.value;
				}
			</script>
			<script type="text/javascript">
				$('document').ready(function () {
					$('#select-1').mouseenter(function () {
						$('#img-1').css('zIndex', '1');
						$('#img-2').css('zIndex', '0');
						$('#img-3').css('zIndex', '0');
						$('#img-4').css('zIndex', '0');
						$('#img-5').css('zIndex', '0');
					});
					$('#select-2').mouseenter(function () {
						$('#img-1').css('zIndex', '0');
						$('#img-2').css('zIndex', '1');
						$('#img-3').css('zIndex', '0');
						$('#img-4').css('zIndex', '0');
						$('#img-5').css('zIndex', '0');
					});
					$('#select-3').mouseenter(function () {
						$('#img-1').css('zIndex', '0');
						$('#img-2').css('zIndex', '0');
						$('#img-3').css('zIndex', '1');
						$('#img-4').css('zIndex', '0');
						$('#img-5').css('zIndex', '0');
					});
					$('#select-4').mouseenter(function () {
						$('#img-1').css('zIndex', '0');
						$('#img-2').css('zIndex', '0');
						$('#img-3').css('zIndex', '0');
						$('#img-4').css('zIndex', '1');
						$('#img-5').css('zIndex', '0');
					});
					$('#select-5').mouseenter(function () {
						$('#img-1').css('zIndex', '0');
						$('#img-2').css('zIndex', '0');
						$('#img-3').css('zIndex', '0');
						$('#img-4').css('zIndex', '0');
						$('#img-5').css('zIndex', '1');
					});

				});
			</script>
</body>

</html>