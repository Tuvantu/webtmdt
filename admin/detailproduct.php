<?php
include '../config.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nhân viên - Quản lý sản phẩm</title>

    <!-- ICON -->

    <!-- Fontawesome css -->
    <link rel="stylesheet" href="../icon/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="../icon/fontawesome-free-6.6.0-web/css/brands.min.css">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/fontawesome.min.css">
    <!-- Fontawesome js -->
    <link rel="stylesheet" href="../icon/fontawesome-free-6.6.0-web/js/all.min.js">
    <link rel="stylesheet" href="../icon/fontawesome-free-6.6.0-web/js/brands.min.js">
    <link rel="stylesheet" href="../icon/fontawesome-free-6.6.0-web/js/fontawesome.min.js">

    <link rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .btn-createaccount {
            width: 200px;
            height: 35px;
            border-radius: 5px;
            background-color: #93DC5C;
            border: none;
            font-weight: bold;
            color: black;
            font-size: 15px;
        }

        .btn-createaccount:hover {
            background-color: #bcbcbd;
        }

        .navbar {
            margin-top: 0px;
        }
        .card {
            border-radius: 15px;
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .img-fluid {
            object-fit: cover;
            /* Đảm bảo hình ảnh không bị méo */
            margin-left: 20px;
            /* Thêm khoảng cách giữa hình ảnh và nội dung */
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">
        <?php
        include 'navigation.php';
        ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <!-- Thông tin tài khoản -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $_SESSION['employee_name'] ?>
                                </span>
                                <div class="sidebar-brand-icon">
                                    <i class="fas fa-circle-user"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Hồ sơ cá nhân
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid mt-5">
                    <h2 class="text-center mb-4">Thông Tin Chi Tiết Sản Phẩm</h2>
                    <div class="card shadow-lg">
                        <div class="card-header text-center bg-primary text-white">
                            <h4 class="mb-0">Thông Tin Sản Phẩm</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="path/to/image.jpg" alt="Hình ảnh sản phẩm" class="img-fluid rounded"
                                    id="productImage">
                            </div>
                            <h5 class="card-title">Tên sản phẩm: <span id="productName">Tên sản phẩm ở đây</span></h5>
                            <p class="card-text">Giá sản phẩm: <strong id="productPrice">Giá sản phẩm ở đây</strong> VND
                            </p>
                            <p class="card-text">Số lượng: <strong id="productQuantity">Số lượng ở đây</strong></p>
                            <p class="card-text">Mô tả:</p>
                            <p class="card-text text-muted" id="productDescription">Mô tả sản phẩm ở đây</p>
                            <p class="card-text">Thời gian sử dụng: <strong id="usageDuration">Thời gian sử dụng ở
                                    đây</strong></p>
                            <p class="card-text">Ngày đăng: <strong id="postingDate">Ngày đăng ở đây</strong></p>
                            <p class="card-text">Thời gian mua: <strong id="purchaseTime">Thời gian mua ở đây</strong>
                            </p>
                            <p class="card-text">Nơi mua: <strong id="purchaseLocation">Nơi mua ở đây</strong></p>
                            <p class="card-text">Hạn sử dụng: <strong id="expirationDate">Hạn sử dụng ở đây</strong></p>
                            <p class="card-text">Giá khi mua: <strong id="purchasePrice">Giá khi mua ở đây</strong> VND
                            </p>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <button class="btn btn-secondary" onclick="window.history.back()">Quay lại</button>
                        </div>
                    </div>
                </div>





            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Website Thương Mại Điện Tử Mua Bán Đồ Cũ C2C</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>



    <!-- Modal đăng xuất-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn muốn đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Phiên làm việc của bạn sẽ kết thúc nếu nhấn vào "Đăng xuất".</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <a class="btn btn-primary" href="../login/login.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>


</body>

</html>