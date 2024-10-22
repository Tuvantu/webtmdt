<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: ./login/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Lấy giỏ hàng của người dùng
$sql = "SELECT cart.product_id, cart.quantity, products.product_name, products.price 
        FROM cart 
        JOIN products ON cart.product_id = products.product_id 
        WHERE cart.user_id = '$user_id'";
$query = mysqli_query($conn, $sql);

$sql1 = "SELECT cart.product_id, cart.quantity, products.product_name, products.price 
        FROM cart 
        JOIN products ON cart.product_id = products.product_id 
        WHERE cart.user_id = '$user_id'";
$query1 = mysqli_query($conn, $sql1);

$total1 = 0;
$subtotal1 = 0;
while ($row1 = mysqli_fetch_array($query1)) {
    $subtotal1 = $row1['quantity'] * $row1['price'];
    $total1 += $subtotal1;
}

$total = 0;



// Xử lý thanh toán nếu form đã được gửi
if (isset($_POST['submit'])) {
    // Nhận thông tin từ biểu mẫu
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $payment_method = $_POST['payment_method'];
    
    // Thông tin thẻ (nếu có)
    $card_number = $_POST['card_number'] ?? null;
    $expiration_date = $_POST['expiration_date'] ?? null;
    $cvv = $_POST['cvv'] ?? null;

    // Thêm thông tin đơn hàng vào cơ sở dữ liệu
    $order_sql = "INSERT INTO orders (user_id, total_amount, full_name, phone_number, address, city, district, ward, card_number, expiration_date, cvv, created_at, status) 
                  VALUES ('$user_id', '$total1', '$full_name', '$phone', '$address', '$city', '$district', '$ward', '$card_number', '$expiration_date', '$cvv', NOW(), 'pending')";
    
    if (mysqli_query($conn, $order_sql)) {
        // Lấy ID của đơn hàng vừa tạo
        $order_id = mysqli_insert_id($conn);

        // Lấy sản phẩm từ giỏ hàng và thêm vào đơn hàng
        while ($cart = mysqli_fetch_array($query)) {
            $product_id = $cart['product_id'];
            $quantity = $cart['quantity'];
            $price = $cart['price'];

            // Thêm vào bảng orderdetail
            $order_detail_sql = "INSERT INTO orderdetail (order_id, product_id, quantity, price) 
                                 VALUES ('$order_id', '$product_id', '$quantity', '$price')";
            mysqli_query($conn, $order_detail_sql);

            $product_quantity= mysqli_query($conn, "SELECT * FROM `products` WHERE product_id = '$product_id'");
            $fetch_product_quantity= mysqli_fetch_assoc($product_quantity);
            $qty = $fetch_product_quantity['quantity'] - $quantity;

            $delete_product_quantity = mysqli_query($conn, "UPDATE products SET quantity = '$qty' WHERE product_id = '$product_id'");
        }

        // Xóa giỏ hàng sau khi thanh toán thành công
        $delete_cart_sql = "DELETE FROM cart WHERE user_id = '$user_id'";
        mysqli_query($conn, $delete_cart_sql);

        // Thông báo người dùng về trạng thái thanh toán
        if ($payment_method === 'cod') {
            // Nếu thanh toán bằng tiền mặt (COD), điều hướng đến confirmation.php
            echo "<script>alert('Thanh toán khi nhận hàng thành công. Bạn sẽ được chuyển hướng!'); window.location.href = 'confirmation_test.php';</script>";
        } else {
            // Thanh toán qua thẻ
            echo "<script>alert('Thanh toán thành công! Bạn sẽ được chuyển hướng!'); window.location.href = 'confirmation_test.php';</script>";
        }
        exit();
    } else {
        echo "<script>alert('Có lỗi xảy ra khi thanh toán!');</script>";
    }
}
 ?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/brands.min.css">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Fontawesome js -->
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/all.min.js">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/brands.min.js">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/fontawesome.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info_user,
        .payment_content {
            flex: 1;
            margin-right: 10px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .info_user:last-child,
        .payment_content:last-child {
            margin-right: 0;
        }

        .info_row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        label {
            display: inline-block;
            width: 150px; /* Set a fixed width for labels */
            margin-right: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="phone"] {
            flex: 1; /* Make input fill the remaining space next to label */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .method_payment {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .method_payment input {
            margin-right: 15px;
        }

        .method_avt {
            font-size: 20px;
            margin-right: 15px;
        }

        .card_payment_details {
            display: none;
            margin-top: 20px;
        }

        .card_payment_details.active {
            display: block;
        }

        .button_payment {
            margin-top: 20px;
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color: #ff9900;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #e68a00;
        }

        .order_summary {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .order_summary h3 {
            margin: 0;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
            color: #ff9900;
        }
        .cart-table-container {
    margin: 20px auto;
    padding: 20px;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 800px; /* Giới hạn chiều rộng tối đa */
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
}

.cart-table th,
.cart-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.cart-table th {
    background-color: #4CAF50; /* Màu nền cho tiêu đề */
    color: white; /* Màu chữ tiêu đề */
}

.cart-table tr:hover {
    background-color: #f1f1f1; /* Hiệu ứng hover cho hàng */
}

.total-row {
    font-weight: bold;
    background-color: #e7f3fe; /* Màu nền cho hàng tổng */
    font-size: 1.1em; /* Kích thước chữ lớn hơn */
}

.cart-table td {
    color: #333; /* Màu chữ cho các ô dữ liệu */
}

    </style>
</head>
<body>
    <?php include 'header.php' ?>
<div class="container">
    <form method="POST" id="checkout-form">
        <div class="form-row">
            <div class="info_user">
                <h3>Thông tin giao hàng</h3>
                
                <div class="info_row">
                    <label for="name">Họ và tên</label>
                    <input type="text" name="full_name" placeholder="Họ và tên" required>
                </div>

                <div class="info_row">
                    <label for="phone_number">Số điện thoại</label>
                    <input type="phone" name="phone_number" placeholder="Số điện thoại" required>
                </div>

                <div class="info_row">
                    <label for="address">Địa chỉ nhận hàng</label>
                    <input type="text" name="address" placeholder="Vui lòng nhập địa chỉ của bạn" required>
                </div>

                <div class="info_row">
                    <label for="city">Tỉnh / Thành phố</label>
                    <input type="text" name="city" placeholder="Vui lòng nhập tỉnh / thành phố" required>
                </div>

                <div class="info_row">
                    <label for="district">Quận / huyện</label>
                    <input type="text" name="district" placeholder="Vui lòng nhập quận / huyện" required>
                </div>

                <div class="info_row">
                    <label for="ward">Phường / xã</label>
                    <input type="text" name="ward" placeholder="Vui lòng nhập phường / xã">
                </div>
            </div>

            <div class="payment_content">
                <h3>Chọn phương thức thanh toán</h3>
                <div class="method_payment">
                    <input type="radio" id="cod" name="payment_method" value="cod" required>
                    <div class="method_avt">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="method_name">
                        <span>Thanh toán khi nhận hàng</span>
                    </div>
                </div>

                <div class="method_payment">
                    <input type="radio" id="card" name="payment_method" value="card" onclick="toggleCardPaymentDetails(true)">
                    <div class="method_avt" style="color: blue;">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="method_name">
                        <span>Thanh toán qua thẻ ngân hàng</span>
                    </div>
                </div>

                <div class="method_payment">
                    <input type="radio" id="zalopay" name="payment_method" value="zalopay" onclick="toggleCardPaymentDetails(false)">
                    <div class="method_avt" style="color: orange;">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="method_name">
                        <span>Thanh toán qua ví ZaloPay</span>
                    </div>
                </div>

                <!-- Thông tin thanh toán qua thẻ -->
                <div class="card_payment_details" id="card-details">
                    <div class="info_row">
                        <label for="card_number">Số thẻ</label>
                        <input type="text" name="card_number" placeholder="Số thẻ" id="card_number">
                    </div>

                    <div class="info_row">
                        <label for="expiry_date">Ngày hết hạn</label>
                        <input type="text" name="expiry_date" placeholder="MM/YY" id="expiry_date">
                    </div>

                    <div class="info_row">
                        <label for="cvv">CVV</label>
                        <input type="text" name="cvv" placeholder="CVV" id="cvv">
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Sản phẩm -->
         <?php
            // Nếu giỏ hàng trống
            if (mysqli_num_rows($query) === 0) {
                echo "<p>Giỏ hàng của bạn trống. <a href='./index.php'>Quay lại mua sắm.</a></p>";
                exit();
            }
         ?>
        <div class="cart-table-container">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Hiển thị giỏ hàng
                    while ($row = mysqli_fetch_array($query)) {
                        $subtotal = $row['quantity'] * $row['price'];
                        $total += $subtotal;
                        echo "<tr>
                                <td>{$row['product_name']}</td>
                                <td>{$row['quantity']}</td>
                                <td>" . number_format($row['price'], 0, ',', '.') . " đ</td>
                                <td>" . number_format($subtotal, 0, ',', '.') . " đ</td>
                                </tr>";
                    }
                    ?>
                    <tr class="total-row">
                        <td colspan="3" align="right">Tổng cộng:</td>
                        <td><b><?php echo number_format($total, 0, ',', '.'); ?> đ</b></td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="button_payment">
            <input class="btn_addtocart" type="submit" name="submit" data-toggle="modal" value="Thanh toán">
        </div>
    </form>
</div>

<script>
    function toggleCardPaymentDetails(show) {
        var cardDetails = document.getElementById('card-details');
        if (show) {
            cardDetails.classList.add('active');
        } else {
            cardDetails.classList.remove('active');
        }
    }
</script>
<?php include 'footer.php' ?>
</body>
</html>
