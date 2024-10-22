<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #f9f9f9; 
            font-family: 'Nunito Sans', sans-serif; 
            margin: 0; 
            padding: 0; 
        }

        .container {
            width: 100%; 
            max-width: 1200px; 
            margin: auto; 
            padding: 20px; 
            background-color: #fff; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px; 
        }

        .header__sort-bar {
            margin: 20px 0; 
            text-align: center; 
        }

        .products {
            margin-bottom: 20px; 
            display: flex; 
            align-items: center; 
            padding: 10px; 
            border: 1px solid #ddd; 
            border-radius: 10px; 
            background-color: #ffffff; 
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); 
        }

        .products img {
            width: 150px; 
            height: auto; 
            border-radius: 10px; 
            margin-right: 20px; 
        }

        .product-info {
            flex-grow: 1; 
        }

        .product-info h5 {
            font-size: 1.6rem; 
            color: #444; 
            margin: 0; 
        }

        .products .price {
            font-size: 1.3rem; 
            color: #28a745; 
        }

        .button-group {
            display: flex; 
            justify-content: flex-end; 
            margin-top: 25px; 
            gap: 15px; 
        }

        .btn {
            padding: 10px 15px; 
            font-size: 1rem; 
            border-radius: 5px; 
            border: none; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        .btn-primary {
            background-color: #007bff; 
            color: white; 
        }

        .btn-secondary {
            background-color: #6c757d; 
            color: white; 
        }

        .btn-primary:hover {
            background-color: #0056b3; 
        }

        .btn-secondary:hover {
            background-color: #5a6268; 
        }

        .pro {
            text-align: right; 
            margin-top: 30px; 
        }

        a {
            color: #007bff; 
            text-decoration: none; 
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php include 'header.php' ?>

    <div class="container">

        <ul class="header__sort-bar">
            <li class="header__sort-item">
                <a href="" class="header__sort-link" style="font-size: large;">Giỏ hàng</a>
            </li>
        </ul>

        <div>
            <?php
            $total = 0;
            $user_id = $_SESSION['user_id']; 

            if (isset($user_id)) {
                // Xử lý khi nhấn nút "Cập nhật giỏ hàng"
                if (isset($_POST['submit'])) {
                    foreach ($_POST['qty'] as $product_id => $new_quantity) {
                        $new_quantity = intval($new_quantity); // Chuyển đổi thành số nguyên

                        // Chỉ cập nhật nếu số lượng > 0, nếu không thì xóa sản phẩm khỏi giỏ hàng
                        if ($new_quantity > 0) {
                            $update_sql = "UPDATE cart 
                                           SET quantity = $new_quantity 
                                           WHERE user_id = '$user_id' 
                                           AND product_id = '$product_id'";
                            mysqli_query($conn, $update_sql);
                        } else {
                            $delete_sql = "DELETE FROM cart 
                                           WHERE user_id = '$user_id' 
                                           AND product_id = '$product_id'";
                            mysqli_query($conn, $delete_sql);
                        }
                    }
                }

                // Lấy sản phẩm trong giỏ hàng từ cơ sở dữ liệu
                $sql = "SELECT cart.product_id, cart.quantity, products.product_name, products.price, products.product_image 
                        FROM cart 
                        JOIN products ON cart.product_id = products.product_id 
                        WHERE cart.user_id = '$user_id'";
                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) > 0) {
                    echo "<form action='' method='post'>"; // Form gửi dữ liệu về chính trang này

                    // Hiển thị sản phẩm trong giỏ hàng
                    while ($row = mysqli_fetch_array($query)) {
                        echo "<div class='products'>";
                        echo "<img src='./upload_image/{$row['product_image']}' alt='{$row['product_name']}'>"; // Product image
                        echo "<div class='product-info'>"; // Thông tin sản phẩm
                        echo "<h5>{$row['product_name']}</h5>";
                        echo "<p class='price'>Giá sản phẩm: " . number_format($row['price']) . "đ</p>";
                        echo "<p align='right'>Số lượng: <input type='number' name='qty[{$row['product_id']}]' size='5' value='{$row['quantity']}' style='width: 60px;'></p>";
                        echo "<p align='right'>Giá tiền: " . number_format($row['quantity'] * $row['price']) . " đ</p>";
                        echo "<a href='./delcart.php?product_id={$row['product_id']}'>Xóa</a>";
                        echo "</div>"; // Đóng div thông tin sản phẩm
                        echo "</div>"; // Đóng div sản phẩm
                        $total += $row['quantity'] * $row['price'];
                    }

                    echo "<div class='pro'>";
                    echo "<b>Tổng tiền cho các món hàng: <font color='red'>" . number_format($total) . " đ</font></b><hr>";
                    $_SESSION['total'] = $total; // Lưu tổng tiền vào session nếu cần

                    echo "<div class='button-group'>";
                    echo "<a href='./test.php' class='btn btn-primary'>Thanh toán</a>"; // Nút thanh toán
                    echo "<input type='submit' name='submit' value='Cập nhật giỏ hàng' class='btn btn-secondary'>"; // Nút cập nhật
                    echo "</div>";
                    
                    echo "<div align='center'>";
                    echo "<b><a href='./index.php'>Mua sắm tiếp</a> - <a href='./delcart.php?delete_all'>Xóa bỏ giỏ hàng</a></b>";
                    echo "</div>";

                    echo "</form>";
                } else {
                    // Nếu không có sản phẩm trong giỏ hàng
                    echo "<div class='pro'>";
                    echo "<p align='center'>Bạn không có món hàng nào trong giỏ hàng <br/><a href='./index.php'>Mua sản phẩm mới nào!</a></p>";
                    echo "</div>";
                }
            } else {
                // Nếu người dùng chưa đăng nhập
                echo "<div class='pro'>";
                echo "<p align='center'>Bạn cần đăng nhập để xem giỏ hàng <br/><a href='./login/login.php'>Đăng nhập</a></p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

</body>
<?php include 'footer.php' ?>

</html>
