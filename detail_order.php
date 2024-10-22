<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);

$order_id = $_GET['order_id'];

if (!$order_id) {
    header('Location: sales_order.php'); // Điều hướng nếu không có mã đơn hàng
    exit();
}

// Truy vấn chi tiết đơn hàng
$select_order = mysqli_query($conn, "SELECT 
                    o.order_id, o.created_at, o.total_amount, o.status, o.full_name, o.phone_number, o.address, o.city, o.district, o.ward
                FROM orders o
                WHERE o.order_id = '$order_id'");

// Truy vấn sản phẩm trong đơn hàng
$select_product = mysqli_query($conn, "SELECT 
                od.quantity, od.price,
                p.product_name, p.product_image
                FROM orderdetail od
                JOIN products p ON od.product_id = p.product_id
                WHERE od.order_id = '$order_id'");

if (mysqli_num_rows($select_order) > 0) {
    $fetch_order = mysqli_fetch_assoc($select_order);

    if (isset($_POST['update_order'])) {
        $new_status = $_POST['status'];

        // Cập nhật trạng thái đơn hàng trong database
        $update_query = "UPDATE orders SET status='$new_status' WHERE order_id='$order_id'";
        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('Cập nhật trạng thái thành công!');</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra khi cập nhật trạng thái đơn hàng!');</script>";
        }

        // Sau khi cập nhật, load lại trang để hiển thị trạng thái mới
        echo "<script>window.location.href = 'sales_order.php';</script>";
    }


    ?>

    <!DOCTYPE html>
    <html lang="vi">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chi tiết đơn hàng</title>
        <link rel="stylesheet" type="text/css" href="./css/grid.css">
        <link rel="stylesheet" type="text/css" href="./css/responsive.css">
        <link rel="stylesheet" type="text/css" href="./css/main.css">
        <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/all.min.css">
        <style>
            /* Improved CSS Styles */
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            h3 {
                text-align: center;
                color: #333;
                margin-bottom: 20px;
            }

            .order-detail {
                max-width: 80%;
                margin: 20px auto;
                padding: 20px;
                background-color: white;
                border-radius: 12px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .informaion_shipping {
                width: 100%;
                display: flex;
                justify-content: space-between;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                margin-bottom: 20px;
            }

            .information_customer,
            .information_payment {
                width: 48%;
                padding: 15px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            }

            .information_header {
                background-color: #FFDE6F;
                padding: 10px;
                text-align: center;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
                font-weight: bold;
                color: #444;
            }

            .information_body {
                background-color: #fff;
                padding: 10px;
                font-size: 14px;
                color: #666;
            }

            select {
                width: 150px;
                height: 30px;
                border: none;
                color: yellowgreen;
                font-weight: bold;
            }
            .update_status {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .update_status_order {
                border: none;
                background-color: white;
                color: yellowgreen;
                font-weight: bold;
            }

            .information_body table {
                width: 100%;
            }

            .table_title {
                font-weight: bold;
                color: #333;
            }

            .table_content {
                color: #555;
                text-align: left;
            }

            .product-list {
                width: 100%;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            }

            .product-list table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
            }

            .product-list th,
            .product-list td {
                padding: 12px;
                border-bottom: 1px solid #e0e0e0;
            }

            .product-list th {
                background-color: #347732;
                color: #fff;
                font-weight: bold;
            }

            .product-list td {
                text-align: center;
                color: #555;
            }

            .product-list td img {
                width: 50px;
                height: 50px;
                border-radius: 50%;
            }

            .total_amount {
                width: 100%;
                text-align: right;
                margin-top: 10px;
            }

            .total_amount h4 {
                font-size: 18px;
                color: #333;
            }

            .total_amount span {
                color: #FF5722;
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <?php include 'header.php'; ?>

        <div class="order-detail">
            <h3>CHI TIẾT ĐƠN HÀNG</h3>

            <div class="informaion_shipping">
                <div class="information_customer">
                    <div class="information_header">
                        <h4>Thông tin khách hàng</h4>
                    </div>
                    <form method="POST" class="information_body">
                        <table>
                            <tr>
                                <td class="table_title">Tên khách hàng:</td>
                                <td class="table_content"><?php echo $fetch_order['full_name']; ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">Số điện thoại:</td>
                                <td class="table_content"><?php echo $fetch_order['phone_number']; ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">Địa chỉ:</td>
                                <td class="table_content">
                                    <?php echo $fetch_order['address'], " - ", $fetch_order['ward'], " - ", $fetch_order['district'], " - ", $fetch_order['city']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="table_title">Thời gian:</td>
                                <td class="table_content"><?php echo $fetch_order['created_at']; ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">Trạng thái:</td>
                                <td class="table_content">
                                    <select name="status">
                                        <option value="processing" <?php echo $fetch_order['status'] == 'processing' ? 'selected' : ''; ?>>Đang xử lý</option>
                                        <option value="pending" <?php echo $fetch_order['status'] == 'pending' ? 'selected' : ''; ?>>Chưa xử lý</option>
                                        <option value="shipping" <?php echo $fetch_order['status'] == 'shipping' ? 'selected' : ''; ?>>Đang vận chuyển</option>
                                        <option value="canceled" <?php echo $fetch_order['status'] == 'canceled' ? 'selected' : ''; ?>>Đã hủy</option>
                                        <option value="completed" <?php echo $fetch_order['status'] == 'completed' ? 'selected' : ''; ?>>Đã nhận hàng</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <div class="update_status">
                            <input class="update_status_order" type="submit" name="update_order" value="Cập nhật đơn hàng">
                        </div>
                    </form>
                </div>

                <div class="information_payment">
                    <div class="information_header">
                        <h4>Thông tin thanh toán</h4>
                    </div>
                    <div class="information_body">
                        <table>
                            <tr>
                                <td class="table_title">Phương thức thanh toán:</td>
                                <td class="table_content">COD</td>
                            </tr>
                            <tr>
                                <td class="table_title">Trạng thái:</td>
                                <td class="table_content">
                                    <?php echo $fetch_order['status'] == 1 ? 'Đã giao' : 'Đang chờ'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="table_title">Thời gian thanh toán:</td>
                                <td class="table_content"><?php echo $fetch_order['created_at']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="product-list">
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                    </tr>
                    <?php
                    $stt = 1;
                    while ($fetch_product = mysqli_fetch_assoc($select_product)) { ?>
                        <tr>
                            <td><?php echo $stt; ?></td>
                            <td><img src="<?php echo $fetch_product['product_image']; ?>" alt="Ảnh sản phẩm"></td>
                            <td><?php echo $fetch_product['product_name']; ?></td>
                            <td><?php echo $fetch_product['quantity']; ?></td>
                            <td><?php echo number_format($fetch_product['price'], 0, ',', '.') . ' VNĐ'; ?></td>
                            <td><?php echo number_format($fetch_product['price'] * $fetch_product['quantity'], 0, ',', '.') . ' VNĐ'; ?>
                            </td>
                        </tr>
                        <?php $stt++;
                    } ?>
                </table>

                <div class="total_amount">
                    <h4>Tổng đơn hàng:
                        <span><?php echo number_format($fetch_order['total_amount'], 0, ',', '.') . ' VNĐ'; ?></span>
                    </h4>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </body>

    </html>
    <?php
}
?>