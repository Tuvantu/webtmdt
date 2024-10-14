<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);
?>
<html>
<head>
    <title>Cửa hàng của tôi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="./css/myshop.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script type="text/javascript" src="../javascript.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body style="height: 197vh;">

    <?php include 'header.php' ?>

    <!-- thông tin cửa hàng -->
    <div class="shop-header">
        <div class="shop-profile">
            <img src="./img/avt.jfif" alt="Profile Image" class="shop-logo">
            <div class="shop-info">
                <h2>CANNON</h2>
                <p>Online 24 phút trước</p>
                <button class="favorite-btn">Yêu Thích</button>
                <button class="follow-btn">+ THEO DÕI</button>
                <button class="chat-btn">
                    <img src="chat-icon.png" alt="Chat"> CHAT
                </button>
            </div>
        </div>

        <div class="shop-stats">
            <div class="stats-column">
                <p>Sản Phẩm: <span class="highlight">103</span></p>
                <p>Đang Theo: <span class="highlight">5</span></p>
                <p>Tỉ Lệ Phản Hồi Chat: <span class="highlight">94%</span> (Trong Vài Giờ)</p>
            </div>
            <div class="stats-column">
                <p>Người Theo Dõi: <span class="highlight">3,4k</span></p>
                <p>Đánh Giá: <span class="highlight">4.9</span> (9,4k Đánh Giá)</p>
                <p>Tham Gia: <span class="highlight">29 Tháng Trước</span></p>
            </div>
        </div>
    </div>

    <nav class="category-nav">
        <a href="" id="suggestions-link">Gợi Ý Sản Phẩm</a>
        <a href="" id="all-products-link">Tất Cả Sản Phẩm</a>
    </nav>

    <div class="product-suggestions" id="suggestions">
        <div class="suggestions-header">
            <h2>Gợi Ý Sản Phẩm</h2>
            <a href="#" class="view-all">Xem Tất Cả</a>
        </div>
        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-item">
                <img src="product1.jpg" alt="Product 1">
                <div class="product-info">
                    <span class="label">Yêu thích</span>
                    <h3>Lót chuột 80x30cm gaming...</h3>
                    <div class="price">
                        <span class="current-price">₫7.000</span>
                        <span class="discount">-77%</span>
                    </div>
                    <div class="badges">
                        <span class="badge">Rẻ Vô Địch</span>
                        <span class="badge">Mua Kèm Deal Sốc</span>
                    </div>
                    <div class="rating">
                        <span>4.9</span> | Đã bán 18,1k
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-item">
                <img src="product2.jpg" alt="Product 2">
                <div class="product-info">
                    <span class="label">Yêu thích</span>
                    <h3>Lót chuột cỡ lớn pad chuột...</h3>
                    <div class="price">
                        <span class="current-price">₫49.000</span>
                        <span class="discount">-2%</span>
                    </div>
                    <div class="badges">
                        <span class="badge">Giảm ₫1k</span>
                        <span class="badge">Mua Kèm Deal Sốc</span>
                    </div>
                    <div class="rating">
                        <span>4.9</span> | Đã bán 1,3k
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-item">
                <img src="product3.jpg" alt="Product 3">
                <div class="product-info">
                    <span class="label">Yêu thích</span>
                    <h3>Miếng lót chuột, pad chuột...</h3>
                    <div class="price">
                        <span class="current-price">₫71.250</span>
                        <span class="discount">-5%</span>
                    </div>
                    <div class="badges">
                        <span class="badge">Giảm ₫3k</span>
                        <span class="badge">Mua 2 & Giảm ₫3,000</span>
                    </div>
                    <div class="rating">
                        <span>4.9</span> | Đã bán 235
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-item">
                <img src="product4.jpg" alt="Product 4">
                <div class="product-info">
                    <span class="label">Yêu thích</span>
                    <h3>Lót chuột - pad chuột Marvel...</h3>
                    <div class="price">
                        <span class="current-price">₫14.250</span>
                        <span class="discount">-5%</span>
                    </div>
                    <div class="badges">
                        <span class="badge">Mua Kèm Deal Sốc</span>
                    </div>
                    <div class="rating">
                        <span>4.9</span> | Đã bán 1,6k
                    </div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-item">
                <img src="product5.jpg" alt="Product 5">
                <div class="product-info">
                    <span class="label">Yêu thích</span>
                    <h3>Miếng lót chuột, pad chuột...</h3>
                    <div class="price">
                        <span class="current-price">₫16.560</span>
                        <span class="discount">-8%</span>
                    </div>
                    <div class="badges">
                        <span class="badge">Mua Kèm Deal Sốc</span>
                    </div>
                    <div class="rating">
                        <span>5.0</span> | Đã bán 4
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-suggestions" id="all-products" style="margin-top: 150px;">
        <div class="suggestions-header">
            <h2>Tất Cả Sản Phẩm</h2>
            <a href="#" class="view-all">Xem Tất Cả</a>
        </div>
        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-item">
                <img src="product1.jpg" alt="Product 1">
                <div class="product-info">
                    <span class="label">Yêu thích</span>
                    <h3>Lót chuột 80x30cm gaming...</h3>
                    <div class="price">
                        <span class="current-price">₫7.000</span>
                        <span class="discount">-77%</span>
                    </div>
                    <div class="badges">
                        <span class="badge">Rẻ Vô Địch</span>
                        <span class="badge">Mua Kèm Deal Sốc</span>
                    </div>
                    <div class="rating">
                        <span>4.9</span> | Đã bán 18,1k
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-item">
                <img src="product2.jpg" alt="Product 2">
                <div class="product-info">
                    <span class="label">Yêu thích</span>
                    <h3>Lót chuột cỡ lớn pad chuột...</h3>
                    <div class="price">
                        <span class="current-price">₫49.000</span>
                        <span class="discount">-2%</span>
                    </div>
                    <div class="badges">
                        <span class="badge">Giảm ₫1k</span>
                        <span class="badge">Mua Kèm Deal Sốc</span>
                    </div>
                    <div class="rating">
                        <span>4.9</span> | Đã bán 1,3k
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-item">
                <img src="product3.jpg" alt="Product 3">
                <div class="product-info">
                    <span class="label">Yêu thích</span>
                    <h3>Miếng lót chuột, pad chuột...</h3>
                    <div class="price">
                        <span class="current-price">₫71.250</span>
                        <span class="discount">-5%</span>
                    </div>
                    <div class="badges">
                        <span class="badge">Giảm ₫3k</span>
                        <span class="badge">Mua 2 & Giảm ₫3,000</span>
                    </div>
                    <div class="rating">
                        <span>4.9</span> | Đã bán 235
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-item">
                <img src="product4.jpg" alt="Product 4">
                <div class="product-info">
                    <span class="label">Yêu thích</span>
                    <h3>Lót chuột - pad chuột Marvel...</h3>
                    <div class="price">
                        <span class="current-price">₫14.250</span>
                        <span class="discount">-5%</span>
                    </div>
                    <div class="badges">
                        <span class="badge">Mua Kèm Deal Sốc</span>
                    </div>
                    <div class="rating">
                        <span>4.9</span> | Đã bán 1,6k
                    </div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-item">
                <img src="product5.jpg" alt="Product 5">
                <div class="product-info">
                    <span class="label">Yêu thích</span>
                    <h3>Miếng lót chuột, pad chuột...</h3>
                    <div class="price">
                        <span class="current-price">₫16.560</span>
                        <span class="discount">-8%</span>
                    </div>
                    <div class="badges">
                        <span class="badge">Mua Kèm Deal Sốc</span>
                    </div>
                    <div class="rating">
                        <span>5.0</span> | Đã bán 4
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>
   
</body>
<script>
document.getElementById('suggestions-link').addEventListener('click', function(event) {
    event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
    const suggestionsSection = document.getElementById('suggestions');
    suggestionsSection.scrollIntoView({
        behavior: 'smooth'
    }); // Cuộn đến phần "Gợi Ý Sản Phẩm"
});

document.getElementById('all-products-link').addEventListener('click', function(event) {
    event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
    const allProductsSection = document.getElementById('all-products');
    allProductsSection.scrollIntoView({
        behavior: 'smooth'
    }); // Cuộn đến phần "Tất Cả Sản Phẩm"
});
</script>
</html>