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
    <title>Đơn Bán Hàng</title>

    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/all.min.css">
    <style>
        h3 {
            text-align: center;
            color: #4CAF50;
        }

        table {
            width: 98%;
            border-collapse: collapse;
            margin: 10px auto;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        td {
            font-size: 13px;
        }

        th {
            background-color: #347732;
            color: white;
            font-size: 13px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #d9fdd9;
        }

        .alert {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .alert img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .alert p {
            font-size: 18px;
            color: yellowgreen;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php include 'header.php' ?>
    <h3>ĐƠN BÁN HÀNG CỦA BẠN</h3>

    <table>
        <tr>
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Thời Gian Mua</th>
            <th>Tổng tiền</th>
            <th>Địa chỉ</th>
            <th>Thành phố</th>
            <th>Quận / Huyện</th>
            <th>Phường / Xã</th>
            <th>Trạng Thái</th>
            <th>Chi tiết</th>
        </tr>

        <?php
        $select_order = mysqli_query($conn, "SELECT 
        p.product_id, 
        p.product_name, 
        p.price, 
        p.quantity, 
        p.create_time, 
        p.description, 
        p.product_image, 
        od.quantity, 
        o.order_id, 
        o.created_at, 
        o.status,
        o.total_amount, o.full_name, o.address, o.city, o.district, o.ward
        FROM products p 
        JOIN orderdetail od ON p.product_id = od.product_id
        JOIN orders o ON od.order_id = o.order_id 
        WHERE p.user_id = $user_id;");
        $stt = 1;
        if (mysqli_num_rows($select_order) > 0) {
            while ($fetch_order = mysqli_fetch_assoc($select_order)) {
                ?>
                <tr>
                    <td><?php echo $stt ?></td>
                    <td><?php echo $fetch_order['order_id'] ?></td>
                    <td><?php echo $fetch_order['full_name'] ?></td>
                    <td><?php echo $fetch_order['created_at'] ?></td>
                    <td><?php echo number_format($fetch_order['total_amount'], 0, ',', '.') . ' VNĐ'; ?></td>
                    <td><?php echo $fetch_order['address'] ?></td>
                    <td><?php echo $fetch_order['city'] ?></td>
                    <td><?php echo $fetch_order['district'] ?></td>
                    <td><?php echo $fetch_order['ward'] ?></td>
                    <td><?php echo $fetch_order['status'] ?></td>
                    <td>
                        <a href="detail_order.php?order_id=<?php echo $fetch_order['order_id'] ?>">
                            <i class="fa-solid fa-pen-to-square" style="color: #B56927; font-size: 20px;"></i>
                        </a>
                    </td>
                </tr>
                <?php
                $stt++;
            }
        } else {
            echo '
            <div class="alert">
                <img src="./img/saleorder.png" alt="Ảnh giỏ hàng">
                <p>Bạn chưa bán sản phẩm nào.</p>
            </div>';
        }
        ?>

    </table>

    <?php include 'footer.php' ?>

</body>

</html>