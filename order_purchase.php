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
    <title>Quản lý đơn hàng</title>

    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/all.min.css">

    <style>
        .main_content {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .tabs {
            width: 70%;
            display: flex;
            cursor: pointer;
            margin: 10px auto;
            /* Căn giữa */
            border-radius: 5px;
            /* Bo góc cho khối tab */
            overflow: hidden;
            /* Ẩn phần thừa */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Bóng đổ cho tab */
        }

        .tab {
            flex: 1;
            padding: 10px 15px;
            background: #f0f0f0;
            text-align: center;
            border: 1px solid #ddd;
            border-bottom: none;
        }

        .tab:hover {
            background: #e0e0e0;
            /* Màu nền khi hover */
            transform: scale(1.05);
            /* Phóng to nhẹ khi hover */
        }

        .tab.active {
            background: #fff;
            font-weight: bold;
            box-shadow: inset 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .tab:not(:last-child) {
            border-right: none;
            /* Ẩn viền bên phải cho tab không phải cuối cùng */
        }


        .content {
            width: 70%;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px;
            flex-direction: column;
        }

        .order_detail {
            width: 98%;
            height: 120px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }

        .product_photo {
            width: 15%;
            display: flex;
            justify-content: center;
        }

        .product_photo img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
            object-fit: cover;
            border: 1px solid #ddd;
        }

        .product_info {
            width: 65%;
            display: flex;
            flex-direction: column;
            padding-left: 10px;
            /* Thêm padding trái */
        }

        .product_info .name_product {
            font-size: 20px;
            /* Tăng kích thước chữ */
            font-weight: bold;
            color: #333;
            /* Đổi màu chữ */
        }

        .product_info .quantity {
            font-size: 16px;
            /* Tăng kích thước chữ */
            color: gray;
            margin-top: 5px;
            /* Thêm khoảng cách phía trên */
        }

        .product_price {
            width: 20%;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            /* Căn bên phải */
            justify-content: flex-end;
        }

        .product_price .price {
            font-size: 20px;
            /* Tăng kích thước chữ */
            color: #ff5722;
            /* Đổi màu chữ */
            font-weight: bold;
        }

        .product_price a {
            text-decoration: none;
            color: #ff5722;
            font-size: 14px;
            margin-top: 5px;
            transition: color 0.3s;
        }

        .product_price a:hover {
            color: #d32f2f;
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
    <div class="main_content">

        <div class="tabs">
            <div class="tab active" onclick="showTab('pending')">Chưa xử lý</div>
            <div class="tab" onclick="showTab('processing')">Đang xử lý</div>
            <div class="tab" onclick="showTab('shipping')">Chờ vận chuyển</div>
            <div class="tab" onclick="showTab('completed')">Hoàn tất</div>
            <div class="tab" onclick="showTab('canceled')">Đã hủy</div>
        </div>

        <?php
        $select_order = mysqli_query($conn, "SELECT 
        p.product_id, 
        p.product_name, 
        p.price, 
        od.quantity, 
        o.order_id, 
        o.created_at, 
        o.status, 
        o.total_amount 
    FROM products p 
    JOIN orderdetail od ON p.product_id = od.product_id
    JOIN orders o ON od.order_id = o.order_id 
    WHERE o.user_id = $user_id;");


        $orders_shipping = [];
        $orders_processing = [];
        $orders_pending = [];
        $orders_completed = [];
        $orders_canceled = [];

        if (mysqli_num_rows($select_order) > 0) {
            while ($fetch_order = mysqli_fetch_assoc($select_order)) {
                switch ($fetch_order['status']) {
                    case 'processing':
                        $orders_processing[] = $fetch_order;
                        break;
                    case 'pending':
                        $orders_pending[] = $fetch_order;
                        break;
                    case 'shipping':
                        $orders_shipping[] = $fetch_order;
                        break;
                    case 'completed':
                        $orders_completed[] = $fetch_order;
                        break;
                    case 'canceled':
                        $orders_canceled[] = $fetch_order;
                        break;
                }
            }
        }
        ?>

        <div class="content" id="processing">
            <?php if (!empty($orders_processing)) {
                foreach ($orders_processing as $order) { ?>
                    <div class="order_detail">
                        <div class="product_photo">
                            <img src="./img/sp1.webp" alt="">
                        </div>
                        <div class="product_info">
                            <span class="name_product"><?php echo $order['product_name'] ?></span>
                            <span class="quantity">Số lượng: <?php echo $order['quantity'] ?></span>
                        </div>

                        <div class="product_price">
                            <span class="price"><?php echo number_format($order['total_amount'], 0, ',', '.') . ' VNĐ'; ?></span>
                            <a href="#">Xem chi tiết</a>
                        </div>
                    </div>

                <?php }
            } else {
                echo '
                    <div class="alert">
                        <img src="./img/order.png" alt="Ảnh giỏ hàng">
                        <p>Bạn không có đơn hàng nào</p>
                    </div>
                ';
            } ?>
        </div>

        <div class="content" id="pending" style="display:none;">
            <?php if (!empty($orders_pending)) {
                foreach ($orders_pending as $order) { ?>
                    <div class="order_detail">
                        <div class="product_photo">
                            <img src="./img/sp1.webp" alt="">
                        </div>
                        <div class="product_info">
                            <span class="name_product"><?php echo $order['product_name'] ?></span>
                            <span class="quantity">Số lượng: <?php echo $order['quantity'] ?></span>
                        </div>

                        <div class="product_price">
                            <span class="price"><?php echo number_format($order['total_amount'], 0, ',', '.') . ' VNĐ'; ?></span>
                            <a href="#">Xem chi tiết</a>
                        </div>
                    </div>
                <?php }
            } else {
                echo '
                    <div class="alert">
                        <img src="./img/order.png" alt="Ảnh giỏ hàng">
                        <p>Bạn không có đơn hàng nào</p>
                    </div>
                ';
            } ?>
        </div>

        <div class="content" id="shipping" style="display:none;">
            <?php if (!empty($orders_shipping)) {
                foreach ($orders_shipping as $order) { ?>
                    <div class="order_detail">
                        <div class="product_photo">
                            <img src="./img/sp1.webp" alt="">
                        </div>
                        <div class="product_info">
                            <span class="name_product"><?php echo $order['product_name'] ?></span>
                            <span class="quantity">Số lượng: <?php echo $order['quantity'] ?></span>
                        </div>

                        <div class="product_price">
                            <span class="price"><?php echo number_format($order['total_amount'], 0, ',', '.') . ' VNĐ'; ?></span>
                            <a href="#">Xem chi tiết</a>
                        </div>
                    </div>
                <?php }
            } else {
                echo '
                    <div class="alert">
                        <img src="./img/order.png" alt="Ảnh giỏ hàng">
                        <p>Bạn không có đơn hàng nào</p>
                    </div>
                ';
            } ?>
        </div>

        <div class="content" id="completed" style="display:none;">
            <?php if (!empty($orders_completed)) {
                foreach ($orders_completed as $order) { ?>
                    <div class="order_detail">
                        <div class="product_photo">
                            <img src="./img/sp1.webp" alt="">
                        </div>
                        <div class="product_info">
                            <span class="name_product"><?php echo $order['product_name'] ?></span>
                            <span class="quantity">Số lượng: <?php echo $order['quantity'] ?></span>
                        </div>

                        <div class="product_price">
                            <span class="price"><?php echo number_format($order['total_amount'], 0, ',', '.') . ' VNĐ'; ?></span>
                            <a href="#">Xem chi tiết</a>
                        </div>
                    </div>
                <?php }
            } else {
                echo '
                    <div class="alert">
                        <img src="./img/order.png" alt="Ảnh giỏ hàng">
                        <p>Bạn không có đơn hàng nào</p>
                    </div>
                ';
            } ?>
        </div>

        <div class="content" id="canceled" style="display:none;">
            <?php if (!empty($orders_canceled)) {
                foreach ($orders_canceled as $order) { ?>
                    <div class="order_detail">
                        <div class="product_photo">
                            <img src="./img/sp1.webp" alt="">
                        </div>
                        <div class="product_info">
                            <span class="name_product"><?php echo $order['product_name'] ?></span>
                            <span class="quantity">Số lượng: <?php echo $order['quantity'] ?></span>
                        </div>

                        <div class="product_price">
                            <span class="price"><?php echo number_format($order['total_amount'], 0, ',', '.') . ' VNĐ'; ?></span>
                            <a href="#">Xem chi tiết</a>
                        </div>
                    </div>
                <?php }
            } else {
                echo '
                    <div class="alert">
                        <img src="./img/order.png" alt="Ảnh giỏ hàng">
                        <p>Bạn không có đơn hàng nào</p>
                    </div>
                ';
            } ?>
        </div>

    </div>


    <script>
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.content');
            const tabElements = document.querySelectorAll('.tab');

            tabs.forEach(tab => {
                tab.style.display = 'none';
            });

            tabElements.forEach(tab => {
                tab.classList.remove('active');
            });

            document.getElementById(tabId).style.display = 'flex'; // Chuyển từ 'block' sang 'flex' để giữ bố cục
            event.currentTarget.classList.add('active');
        }

    </script>

    <?php include 'footer.php' ?>

</body>

</html>