<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    $fetch_product = mysqli_fetch_assoc($result);
}

if (isset($_POST['add_cart'])) {
    $product_id = $_GET['id'];
    if (isset($_POST['abc_quantity'])) {
        $quantity = $_POST['abc_quantity'];
    } else {
        $quantity = $_POST['quantity'] ?? 1;
    }
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $fetch_cart = mysqli_fetch_assoc($result);
        $quantity = $fetch_cart['quantity'] + $quantity;
        $sql = "UPDATE cart SET quantity = $quantity WHERE user_id = '$user_id' AND product_id = $product_id";
        mysqli_query($conn, $sql);
        echo "<script type='text/javascript'>
                window.alert('Sản phẩm đã có trong giỏ hàng và đã được cập nhật số lượng');
                </script>";
    } else {
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', $product_id, $quantity)";
        mysqli_query($conn, $sql);
        echo "<script type='text/javascript'>
				window.alert('Thêm sản phẩm vào giỏ hàng thành công');
				</script>";
        header('Location: product.php?id=' . $product_id);
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    try {
        mysqli_query($conn, "DELETE FROM `products` WHERE product_id = '$delete_id'") or die('query failed');
        echo "<script type='text/javascript'>
            window.alert('Xóa sản phẩm thành công.');
                    window.location.href = 'detailmyproduct.php?id=$delete_id'; // Chuyển hướng về trang thông tin chi tiết sản phẩm
            </script>";
    } catch (mysqli_sql_exception $e) {
        echo "<script type='text/javascript'>
            window.alert('Không thể xóa sản phẩm này.');
            window.location.href = 'detailmyproduct.php?id=$delete_id'; // Chuyển hướng về trang thông tin chi tiết sản phẩm
            </script>";
    }
}

?>
<html>

<head>
    <title>Sản phẩm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

    <div class="main_content">
        <div class="product_content">
            <?php
            $user_id = $_SESSION['user_id'];
            $select_user = mysqli_query($conn, "select * from users where user_id = '$user_id'");
            $fetch_user = mysqli_fetch_assoc($select_user);
            ?>
            <div class="product_photo">
                <img src="./upload_image/<?php echo $fetch_product['product_image']; ?>" alt="">
            </div>

            <div class="product_info">
                <div class="product_name">
                    <span><?php echo $fetch_product['product_name'] ?></span>
                </div>

                <div class="product_status">
                    <span><i>Đã sử dụng</i></span>
                    <span>-</span>
                    <span><i>Không còn bảo hành</i></span>
                </div>

                <div class="product_price">
                    <span>
                        <?php echo number_format($fetch_product['price'], 0, ',', '.'); ?> đ
                    </span>
                </div>

                <div class="address">
                    <i class="fa-solid fa-location-dot" style="color: gray;"></i>
                    <span><?php echo $fetch_user['address'] ?></span>
                </div>

                <div class="create_time">
                    <i class="fa-solid fa-clock" style="color: gray;"></i>
                    <span>Cập nhật vào: <?php echo $fetch_product['create_time'] ?></span>
                </div>


                <div class="product-detail-quantity">
                    <div class="product-detail-label-lb" style="width: 110px;">Số lượng</div>
                    <?php
                    if ($fetch_product['quantity'] > 1) {
                        ?>

                        <div class="product-detail-quantity-action">
                            <input type="button" value="-" id="btn-sub"
                                class="product-detail-quantity-btn product-detail-quantity-btn-left">
                            <input name="quantity" max="<?php echo $fetch_product['quantity'] ?>" min="1" type="number"
                                value="1" id="quantity-input" class="product-detail-quantity-input">
                            <input type="button" value="+" id="btn-add"
                                class="product-detail-quantity-btn product-detail-quantity-btn-right">
                        </div>

                        <?php
                    } else {
                        ?>
                        <div class="product-detail-quantity-action">
                            <input name="abc_quantity" type="number" disabled value="1" id="quantity-input"
                                class="product-detail-quantity-input">
                        </div>
                        <?php
                    }
                    ?>

                </div>

                <div class="product_addtocart">
                    <button class="btn_addtocart" type="submit" name="add_cart" data-toggle="modal"
                        ata-target="#dialog1">
                        <a href="detailmyproduct.php?delete=<?php echo $fetch_product['product_id'] ?>" style="color: red"
                            onclick="return confirm('Bạn muốn xóa sản phẩm này?')"> <i
                                class="fa-solid fa-trash"></i> Xóa sản phẩm
                        </a> </button>

                    <button class="btn_buy" type="submit" name="btn_buy">
                        <a href="editmyproduct.php?product_id=<?php echo $fetch_product['product_id'] ?>"
                            style="color: white"><i class="fa-solid fa-pen"></i> Chỉnh sửa sản phẩm</a>
                    </button>
                </div>
                <div class="shop_info">


                    <div class="shop_infodetail">
                        <div class="shop_avt">
                            <img src="./img/avt.jfif" alt="">
                        </div>

                        <div class="shop_content">
                            <span class="shop_name"><?php echo $fetch_user['user_name'] ?></span>
                            <span><span style="color: gray; font-weight: bold">Đã bán: </span>: 2 sản phẩm</span>
                            <span><span style="color: gray; font-weight: bold">Số điện thoại:
                                </span><?php echo $fetch_user['phone_number'] ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="product_infomation">
            <div class="description">
                <span class="title">Mô tả chi tiết</span>
                <span><?php echo $fetch_product['description'] ?></span>
            </div>

            <div class="other_infomation">
                <span class="title">Thông tin liên quan</span>

                <table>

                    <?php
                    $category_id = $fetch_product['category_id'];
                    $select_category = mysqli_query($conn, "select * from categories where category_id = '$category_id'");
                    $fetch_category = mysqli_fetch_assoc($select_category);
                    ?>

                    <tr>
                        <td class="table_title">Danh mục</td>
                        <td> <?php echo $fetch_category['category_name'] ?> </td>
                    </tr>
                    <tr>
                        <td class="table_title">Thời gian đã sử dụng</td>
                        <td><?php echo $fetch_product['time_used'] ?></td>
                    </tr>
                    <tr>
                        <td class="table_title">Thời gian mua</td>
                        <td><?php echo $fetch_product['purchase_time'] ?></td>
                    </tr>
                    <tr>
                        <td class="table_title">Địa chỉ mua sản phẩm</td>
                        <td><?php echo $fetch_product['place_of_purchase'] ?></td>
                    </tr>
                    <tr>
                        <td class="table_title">Giá ban đầu</td>
                        <td><?php echo $fetch_product['purchase_price'] ?></td>
                    </tr>
                    <tr>
                        <td class="table_title">Hạn sử dụng</td>
                        <td><?php echo $fetch_product['warranty_period'] ?></td>
                    </tr>
                </table>
            </div>


        </div>

    </div>



    <?php include 'footer.php' ?>



</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="../javascript.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</html>