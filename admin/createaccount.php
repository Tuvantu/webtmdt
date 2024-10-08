<?php
include '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:../login/login.php');
}

if (isset($_POST['add_account'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $create_time = date('Y-m-d H:i:s');

    $select_user = mysqli_query($conn, "select * from users where phone_number = $phone_number") or die('query fail');

    if (mysqli_num_rows($select_user) > 0) {
        echo "<script type='text/javascript'>
                window.alert('Tài khoản đã tồn tại');
                </script>";
    } else {
        mysqli_query($conn, "insert into users (user_name, password, phone_number, email, address, role_id, create_time) values ('$user_name', '$password', '$phone_number', '$email', '$address', '2', '$create_time')") or die('query fail');
        echo "<script type='text/javascript'>
                window.alert('Thêm tài khoản thành công');
                </script>";
    }
}

?>





<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Trang chủ</title>

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

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #8DA47E">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">C2C</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Bảng điều khiển</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Quản lý tài khoản</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="accountuser.php">Tất cả tài khoản</a>
                        <a class="collapse-item" href="accountemployee.php">Nhân viên</a>
                    </div>
                </div>
            </li>


            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <!-- Thông tin tài khoản -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $_SESSION['admin_name'] ?>
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

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tạo tài khoản nhân viên</h1>
                    </div>

                    <div class="row">

                        <div class="container mt-1">
                            <form method="post">
                                <div class="form-group">
                                    <label for="fullname">Họ và Tên:</label>
                                    <input type="text" class="form-control" id="fullname" name="user_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone_number" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Địa chỉ:</label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <input name="add_account" type="submit" class="btn btn-primary" value="Tạo tài khoản">
                            </form>
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

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

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