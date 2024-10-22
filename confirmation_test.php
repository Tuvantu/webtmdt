<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS for order confirmation -->
    <style>
        /* CSS cho header và footer */
        header {
            width: 100%; /* Chiếm toàn bộ chiều rộng */
            background-color: #3498db; /* Màu nền cho header */
            color: white; /* Màu chữ */
            padding: 15px 0; /* Khoảng cách bên trên và dưới */
            text-align: center; /* Căn giữa nội dung */
            position: fixed; /* Ghi chú: nếu bạn muốn cố định header ở đầu trang */
            top: 0; /* Ghi chú: vị trí trên cùng */
            z-index: 1000; /* Đảm bảo header nằm trên các phần tử khác */
        }

        footer {
            width: 100%; /* Chiếm toàn bộ chiều rộng */
            background-color: #2c3e50; /* Màu nền cho footer */
            color: white; /* Màu chữ */
            padding: 10px 0; /* Khoảng cách bên trên và dưới */
            text-align: center; /* Căn giữa nội dung */
            position: relative; /* Tùy chọn, không cần cố định */
            bottom: 0; /* Đặt footer ở đáy của trang */
        }

        /* Các quy tắc CSS khác */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        .order-confirmation__container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            text-align: center;
            margin: 20px auto;
        }

        .order-confirmation__title {
            color: #27ae60;
            font-size: 2em;
            margin-bottom: 10px;
        }

        .order-confirmation__message {
            font-size: 1.1em;
            color: #333;
            margin-bottom: 20px;
        }

        .order-confirmation__link {
            background-color: #3498db;
            color: #fff;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-top: 20px;
        }

        .order-confirmation__link:hover {
            background-color: #2980b9;
        }

        .order-confirmation__icon {
            color: #27ae60;
            font-size: 3em;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="order-confirmation">
    <?php include 'header.php'; ?>

    <div class="order-confirmation__container">
        <i class="fas fa-check-circle order-confirmation__icon"></i>
        <h2 class="order-confirmation__title">Đặt hàng thành công!</h2>
        <p class="order-confirmation__message">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi. Đơn hàng của bạn đang được xử lý và sẽ được giao trong thời gian sớm nhất.</p>
        <a class="order-confirmation__link" href="index.php">Tiếp tục mua sắm</a>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
