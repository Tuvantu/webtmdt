<?php
include './config.php';
session_start();

?>


<html>

<head>
    <title>CANNO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script type="text/javascript" src="javascript.js"></script>
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
    <form action="timkiem.php" method="POST">
        <div class="app">
            <div class="header">
                <div class="grid wide">
                    <div class="header-main">
                        <div class="logo">
                            <a href="index.php"><img src="./img/logo.png" width="180" height="80"
                                    style="position: relative; top: 10px"></a>
                        </div>
                        <div class="search">
                            <input type="text" name="s" class="search-bar" placeholder="Tìm kiếm">
                            <input type="submit" value="Tìm kiếm" class="btn-search">

                        </div>
                        <div class="account">
                            <p class="name_account">
                                <?php echo $_SESSION['user_name'] ?>
                            </p>
                            <i class="fa-solid fa-circle-user" style="color: #8bea96;"></i>
                        </div>
                    </div>
                </div>
            </div>
    </form>


    <div class="navigation-bar">
        <ul class="navbar-list">
            <li class="navbar-item"><a href="index.php" class="navbar-link">TRANG CHỦ</a></li>
            <li class="navbar-item"><a href="./pages/gioithieu.php" class="navbar-link">GIỚI THIỆU</a></li>
            <li class="navbar-item navbar-item-category">
                <a href="" class="navbar-link">DANH MỤC</a>
                <div class="navbar-category">
                    <ul class="navbar-category-list">
                        <?php
                        $select_category = mysqli_query($conn, "select * from categories") or die('query fail');
                        if (mysqli_num_rows($select_category) > 0) {
                            while ($fetch_category = mysqli_fetch_assoc($select_category)) {
                                ?>
                                <li class="navbar-category-item">
                                    <?php echo $fetch_category['category_name'] ?>
                                </li>

                                <?php
                            }
                        }
                        ?>
                    </ul>

                </div>
            </li>
            <li class="navbar-item"><a href="./pages/lienhe.php" class="navbar-link">LIÊN HỆ</a></li>
        </ul>
        <ul class="navbar-list">
            <li class="navbar-item"><a href="./pages/giohang.php" class="navbar-link">GIỎ HÀNG</a></li>
            <li class="navbar-item"><a href="./pages/dangxuat.php" class="navbar-link">ĐƠN HÀNG</a></li>
            <li class="navbar-item upload"><a href="./postnews.php" class="navbar-link">ĐĂNG TIN</a></li>

        </ul>
    </div>

    <div class="slideshow">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 h-50" src="https://cf.shopee.sg/file/73cfec97ad7a6b6a5574d404f70cd7f6"
                        alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 h-50" src="https://cf.shopee.sg/file/c304cae0e031106e356858f48882bdd6"
                        alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 h-50" src="https://cf.shopee.sg/file/928775f4fa44e1775763975971144679"
                        alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 h-50" src="https://cf.shopee.sg/file/b362f6a1bfe49823caabe068362c4c21"
                        alt="Fourth slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>

    <ul class="header__sort-bar">
        <li class="header__sort-item">
            <a href="" class="header__sort-link">Liên quan</a>
        </li>
        <li class="header__sort-item">
            <a href="" class="header__sort-link">Mới nhất</a>
        </li>
        <li class="header__sort-item">
            <a href="" class="header__sort-link">Bán chạy</a>
        </li>
        <li class="header__sort-item">
            <a href="" class="header__sort-link">Giá</a>
        </li>
    </ul>

    <div class="container">
        <div class="grid wide">
            <div class="row sm-gutter grid-content">
                <div class="column l-2 me-0 s-0">
                    <nav class="category">
                        <h3 class="category-heading">
                            <i class="category-heading-icon fas fa-bars"></i>
                            Danh mục
                        </h3>
                        <ul class="category-list">
                        <?php
                        $select_category = mysqli_query($conn, "select * from categories") or die('query fail');
                        if (mysqli_num_rows($select_category) > 0) {
                            while ($fetch_category = mysqli_fetch_assoc($select_category)) {
                                ?>
                            <li class="navbar-category-item category-item2">
                                <?php echo $fetch_category['category_name'] ?>
                            </li>
                            <?php
                            }
                        }
                        ?>
                        </ul>
                        <ul class="navbar-category-list">
                            <li class="navbar-category-item">

                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="column l-10 me-12 s-12">
                    <div class="home-filter">
                        <span class="label" style="margin-right: 16px;">Sắp xếp theo</span>
                        <button class="home-filter-btn btn">Phổ biến</button>
                        <button class="home-filter-btn btn btn--active">Mới nhất</button>
                        <button class="home-filter-btn btn">Bán chạy</button>
                        <div class="select-price">
                            <span class="select-label">Giá</span>
                            <i class="fas fa-angle-down"></i>
                            <ul class="select-price-list">
                                <li class="select-price-item">
                                    <a href="" class="select-price-link">Giá từ thấp đến cao</a>
                                </li>
                                <li class="select-price-item">
                                    <a href="" class="select-price-link">Giá từ cao đến thấp</a>
                                </li>
                            </ul>
                        </div>
                        <div class="page">
                            <div class="page-num">
                                <span class="page-current">1</span>/14
                            </div>
                            <div class="page-control">
                                <a href="" class="page-control-btn">
                                    <i class="page-control-icon fas fa-angle-left"></i>
                                </a>
                                <a href="" class="page-control-btn">
                                    <i class="page-control-icon fas fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- BÊN DƯỚI LÀ sản phẩm -->

                    <?php

                    $select_product = mysqli_query($conn, "select * from ")

                    ?>

                    <div class="home-product">
                        <div class="row sm-gutter">
                        <div class="column l-2-4 me-4 s-6" >
							<a class="home-product-item" href="product.php">
								<div class="home-product-item__img" style="background-image: url(./img/sp1.webp)">
								</div>
								<h4 class="home-product-item__name">Điện thoại Nokia Điện thoại Nokia Điện thoại Nokia</h4>
								<div class="home-product-item__price">
									<div class="home-product-item__priceproduct">6.000.000đ</div>
								</div>
								<div class="home-product-item__timeupload">
									
									
									<span class="home-product-item__time">
                                    <i class="fa-solid fa-clock" style="color: #a9aaad;"></i> 08/10/2024
                                    </span>
								</div>
	
							</a>
						</div>
                        </div>
                    </div>
                    <!-- BÊN trên LÀ sản phẩm -->

                </div>
            </div>


        </div>
    </div>
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
                            <a class="footer-item-link">Chất lượng</a>
                        </li>
                        <li class="footer-item">
                            <a class="footer-item-link">Giá tốt nhất</a>
                        </li>
                        <li class="footer-item">
                            <a class="footer-item-link">Tất cả vì khách hàng</a>
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
                <p>WEBSITE THƯƠNG MẠI ĐIỆN TỬ MUA BÁN ĐỒ CŨ C2C</p>
            </div>
        </div>
    </div>
    <div class="scroll-to-top" onclick="scrollToTop();">
        <i class="scroll-to-top-icon fas fa-chevron-up"></i>
    </div>
    </div>
</body>

</html>