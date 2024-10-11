<html>

<head>
    <title>CANNON</title>
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
    <?php include 'header.php' ?>

    <div class="slideshow">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 h-50" src="./img/slider1.png" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 h-50" src="./img/slider2.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 h-50" src="./img/slider3.png" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 h-50" src="./img/slider4.png" alt="Fourth slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 h-50" src="./img/slider5.png" alt="Fourth slide">
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

    <!-- <ul class="header__sort-bar">
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
    </ul> -->

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
                            $select_category = mysqli_query($conn, "SELECT * FROM categories") or die('Query failed');
                            if (mysqli_num_rows($select_category) > 0) {
                                while ($fetch_category = mysqli_fetch_assoc($select_category)) {
                                    ?>
                                    <li class="navbar-category-item category-item2">
                                        <a
                                            href="?category_id=<?php echo $fetch_category['category_id']; ?>"><?php echo $fetch_category['category_name']; ?></a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
                <div class="column l-10 me-12 s-12">
                    <div class="home-filter">
                        <span class="label" style="margin-right: 16px;">Sắp xếp theo</span>
                        <form method="GET" action="">
                            <div>
                                <select name="sort_by" onchange="this.form.submit()" class="select_sort_by">
                                    <option value="new">Mới nhất</option>
                                    <option value="price_asc" <?php echo (isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_asc') ? 'selected' : ''; ?>>Giá từ thấp đến cao
                                    </option>
                                    <option value="price_desc" <?php echo (isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_desc') ? 'selected' : ''; ?>>Giá từ cao đến thấp
                                    </option>
                                </select>
                            </div>
                        </form>
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


                    <div class="home-product">
                        <div class="row sm-gutter">
                            <?php
                            // Lấy category_id từ URL nếu có
                            $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';

                            // Xác định thứ tự sắp xếp
                            $order_by = "p.create_time DESC"; // Mặc định sắp xếp theo mới nhất
                            if (isset($_GET['sort_by'])) {
                                switch ($_GET['sort_by']) {
                                    case 'new':
                                        $order_by = "p.create_time DESC"; // Mặc định sắp xếp theo mới nhất
                                        break;
                                    case 'price_asc':
                                        $order_by = "p.price ASC"; // Sắp xếp giá từ thấp đến cao
                                        break;
                                    case 'price_desc':
                                        $order_by = "p.price DESC"; // Sắp xếp giá từ cao đến thấp
                                        break;
                                }
                            }

                            // Truy vấn tất cả các sản phẩm từ productapproval có status là 'Accept'
                            $query = "SELECT p.* FROM productapproval pa
                  JOIN products p ON pa.product_id = p.product_id
                  WHERE pa.status = 'Accept'";

                            // Nếu có lọc theo danh mục, thêm điều kiện vào truy vấn
                            if (!empty($category_id)) {
                                $query .= " AND p.category_id = '$category_id'";
                            }

                            // Thêm điều kiện sắp xếp
                            $query .= " ORDER BY $order_by";

                            $select_all_product = mysqli_query($conn, $query) or die('Query Failed');

                            if (mysqli_num_rows($select_all_product) > 0) {
                                while ($product = mysqli_fetch_assoc($select_all_product)) {
                                    // Hiển thị thông tin sản phẩm
                                    ?>

                                    <div class="column l-2-4 me-4 s-6">

                                        <a class="home-product-item"
                                            href="product.php?id=<?php echo $product['product_id']; ?>">
                                            <div class="home-product-item__img"
                                                style="background-image: url('./upload_image/<?php echo $product['product_image']; ?>')">
                                            </div>
                                            <h4 class="home-product-item__name"><?php echo $product['product_name']; ?></h4>
                                            <div class="home-product-item__price">
                                                <div class="home-product-item__priceproduct">
                                                    <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                                                </div>
                                            </div>
                                            <div class="home-product-item__timeupload">
                                                <span class="home-product-item__time">
                                                    <i class="fa-solid fa-clock" style="color: #a9aaad;"></i>
                                                    <?php echo $product['create_time']; ?>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p>Không có sản phẩm nào được phê duyệt!</p>";
                            }
                            ?>
                        </div>


                    </div>

                    <!-- BÊN trên LÀ sản phẩm -->

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