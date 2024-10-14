<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
?>
<html>

<head>
    <title>Hồ sơ của tôi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="./css/myprofile.css">
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
        <div class="myprofile">
            <div class="title">
                <span>Hồ sơ cá nhân</span>
            </div>

            <div class="profile_detail">
                <div class="row">
                    <label for="">Họ và tên</label>
                    <input type="text">
                </div>
                <div class="row">
                    <label for="">Số điện thoại</label>
                    <input type="text">
                </div>
                <div class="row">
                    <label for="">Email</label>
                    <input type="text">
                </div>
                <div class="row">
                    <label for="">Địa chỉ</label>
                    <input type="text">
                </div>
            </div>
        </div>

        <div class="myprofile">
            <div class="title">
                <span>Thông tin bảo mật</span>
            </div>
            <div class="title_description">
                <span>Những thông tin dưới đây mang tính bảo mật. Chỉ bạn mới có thể thấy và chỉnh sửa những thông tin
                    này.</span>
            </div>
            <div class="profile_detail">
                <div class="row">
                    <label for="">CCCD / Định danh</label>
                    <input type="text">
                </div>
                <div class="row">
                    <label for="">Giới tính</label>
                    <input type="text">
                </div>
                <div class="row">
                    <label for="">Ngày, tháng, năm sinh</label>
                    <input type="text">
                </div>
            </div>


        </div>
        <div class="button">
            <button type="button">Chỉnh sửa hồ sơ</button>
        </div>
    </div>









    <?php include 'footer.php' ?>
</body>

</html>