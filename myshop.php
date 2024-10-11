<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
?>
<html>

<head>
    <title>Cửa hàng của tôi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="./css/shop.css">
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

    <div class="container">
        <div class="info_shop">
            <div class="shop_avt">
                <img src="./img/avt.jfif" alt="">
            </div>

            <div class="shop_name">
                <span class="name">
                    <?php echo $user_name  ?>
                </span>
                <?php
                    $select_user = mysqli_query($conn, "select * from users where user_id = $user_id");
                    $fetch_user = mysqli_fetch_assoc($select_user);
                ?>
                <span> <i class="fa-solid fa-phone-volume" style="color: gray;"></i> <span class="phone_number">Số điện
                        thoại: </span><?php echo $fetch_user['phone_number'] ?></span>
                <span><i class="fa-solid fa-location-dot" style="color: gray;"></i> <span>Địa chỉ: </span>
                <?php echo $fetch_user['address'] ?></span>
            </div>

            <div class="shop_description">
                <?php
                    $select_product = mysqli_query($conn, "select * from products where user_id = $user_id");
                    $total_product = mysqli_num_rows($select_product);
                ?>

                <span><i class="fa-solid fa-basket-shopping" style="color: gray;"></i> <span>Sản phẩm:
                    </span><span class="number"><?php echo $total_product ?></span></span>
                <span><i class="fa-solid fa-cart-shopping" style="color: gray;"></i> <span>Sản phẩm đã
                        bán: </span><span class="number">3</span></span>

            </div>
        </div>

        <div class="product">
            <?php
            // Truy vấn tất cả các sản phẩm từ productapproval có status là 'Accept'
            $query = "SELECT p.* FROM productapproval pa
                  JOIN products p ON pa.product_id = p.product_id
                  WHERE pa.status = 'Accept' AND p.user_id = $user_id";

            $select_all_product = mysqli_query($conn, $query) or die('Query Failed');

            if (mysqli_num_rows($select_all_product) > 0) {
                while ($product = mysqli_fetch_assoc($select_all_product)) {
                    ?>

                    <div class="product_item">
                        <a href="detailmyproduct.php?id=<?php echo $product['product_id']; ?>">
                            <div class="product_photo">
                                <img src="./upload_image/<?php echo $product['product_image']; ?>" alt="">
                            </div>

                            <div class="product_name">
                                <span class=""><?php echo $product['product_name']; ?></span>
                            </div>

                            <div class="product_price">
                                <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                            </div>

                            <div class="product_time">
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
    </div>










    <?php include 'footer.php' ?>
</body>

</html>