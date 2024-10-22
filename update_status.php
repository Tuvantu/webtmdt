<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);

$user_id = $_SESSION['user_id'];

// Truy vấn để lấy sản phẩm đã bán của người dùng
$sql = "SELECT 
    p.product_id, 
    p.product_name, 
    p.price, 
    p.quantity AS product_quantity, 
    p.time_used, 
    p.create_time, 
    p.description, 
    p.purchase_time, 
    p.product_image, 
    p.warranty_period, 
    p.place_of_purchase, 
    p.purchase_price, 
    p.update_time, 
    p.status,
    od.quantity AS order_quantity, 
    o.order_id, 
    o.created_at AS order_created_at, 
    o.status AS order_status,
    o.total_amount AS order_total_amount
FROM products p
JOIN orderdetail od ON p.product_id = od.product_id  -- Join với orderdetail
JOIN orders o ON od.order_id = o.order_id            -- Join với orders
WHERE p.user_id = $user_id;


    ";

$query = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật trạng thái đơn hàng</title>

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
            background-color: #f9f9f9;
            position: relative;
        }

        h3 {
            text-align: center;
            color: #4CAF50;
            /* Màu xanh lá */
        }

        table {
            width: 80%;
            /* Giảm độ rộng của bảng */
            border-collapse: collapse;
            margin: 50px auto;
            /* Căn giữa bảng */
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            /* Đường viền nhẹ */
        }

        th,
        td {
            padding: 8px;
            /* Giảm padding để làm nhỏ bảng */
            text-align: center;
            /* Căn giữa cho ô dữ liệu */
        }

        th {
            background-color: #4CAF50;
            /* Nền màu xanh lá cho tiêu đề */
            color: white;
            /* Chữ trắng cho tiêu đề */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
            /* Nền sáng cho hàng chẵn */
        }

        tr:hover {
            background-color: #d9fdd9;
            /* Màu nền khi hover */
        }

        .no-orders {
            text-align: center;
            color: #999;
            font-style: italic;
            padding: 20px;
        }

        .update_status {
            width: 80px;
            padding: 5px;
            background-color: #02A002;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            position: absolute;
            right: 130px;
            cursor: pointer;
        }

        .update_status:hover {
            background-color: #9DEE0D;
        }

        table select {
            width: 150px;
            height: 30px;
            border-radius: 5px;
            border: 1px solid green;
        }
    </style>
</head>

<body>

    <?php include 'header.php' ?>

    <h3>ĐƠN BÁN HÀNG CỦA BẠN</h3>

    

    <?php if (mysqli_num_rows($query) > 0): ?>
        <table>
            <tr>
                <th>STT</th>
                <th>Hình Ảnh</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Thời Gian Mua</th>
                <th>Tổng tiền</th>
                <th>Trạng Thái</th>
            </tr>

            <?php
            $stt = 1;
            while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?php echo $stt ?></td>
                    <td><img src="./upload_image/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>"
                            style="width: 50px; height: 50px;"></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo number_format($row['price'], 0, ',', '.') . ' VNĐ'; ?></td>
                    <td><?php echo $row['order_quantity']; ?></td>
                    <td><?php echo $row['order_created_at']; ?></td>
                    <td><?php echo number_format($row['order_total_amount'], 0, ',', '.') . ' VNĐ'; ?></td>
                    <td>
                        <select name="order_status">
                            <option value="pending" style="color: green">Đang chờ</option>
                            <option value="processing" style="color: green">Đang xử lý</option>
                            <option value="shipped" style="color: green">Đang giao hàng</option>
                            <option value="completed" style="color: green">Hoàn thành</option>
                            <option value="cancelled" style="color: red">Đã hủy</option>
                        </select>
                    </td>

                </tr>
                <?php
                $stt++;
            endwhile; ?>
        </table>
    <?php else: ?>
        <p class="no-orders">Bạn chưa bán sản phẩm nào.</p>
    <?php endif; ?>

    <?php include 'footer.php' ?>
</body>

</html>