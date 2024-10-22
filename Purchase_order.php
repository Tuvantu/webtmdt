<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);


$user_id = $_SESSION['user_id'];
?> 


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Đơn Mua Hàng</title>

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
            margin: 20px;
            background-color: #f9f9f9; /* Nền sáng */
        }

        h1 {
            text-align: center;
            color: #4CAF50; /* Màu xanh lá */
        }

        table {
            width: 80%; /* Giảm độ rộng của bảng */
            border-collapse: collapse;
            margin: 20px auto; /* Căn giữa bảng */
        }

        table, th, td {
            border: 1px solid #ddd; /* Đường viền nhẹ */
        }

        th, td {
            padding: 8px; /* Giảm padding để làm nhỏ bảng */
            text-align: left; /* Căn trái cho ô dữ liệu */
        }

        th {
            background-color: #4CAF50; /* Nền màu xanh lá cho tiêu đề */
            color: white; /* Chữ trắng cho tiêu đề */
            text-align: center; /* Căn giữa cho tiêu đề cột */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Nền sáng cho hàng chẵn */
        }

        tr:hover {
            background-color: #d9fdd9; /* Màu nền khi hover */
        }

        .no-orders {
            text-align: center;
            color: #999;
            font-style: italic;
            padding: 20px;
        }



    </style>
</head>

<body>
    <?php include 'header.php' ?>

    <h1>Danh Sách Đơn Mua Hàng</h1>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>ID Đơn Hàng</th>
                <th>Tổng Số Tiền</th>
                <th>Trạng Thái</th>
                <th>Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Truy vấn để lấy dữ liệu từ bảng orders và orderdetail
            $sql = "SELECT o.order_id, o.full_name, o.phone_number, o.address, o.city, o.district, o.ward, o.total_amount, o.status,
                           od.product_id, od.quantity, od.price
                    FROM orders o
                    JOIN orderdetail od ON o.order_id = od.order_id WHERE o.user_id = '$user_id'";
                    $stt = 1 ;
            $result = $conn->query($sql);

            // Kiểm tra và hiển thị dữ liệu
            if ($result->num_rows > 0) {
                // Xuất dữ liệu cho từng hàng
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            
                            <td>{$row['order_id']}</td>
                            <td>{$row['total_amount']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['product_id']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['price']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9' class='no-orders'>Không có đơn hàng nào.</td></tr>";
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </tbody>
    </table>
    <?php include 'footer.php' ?>

</body>
</html>
