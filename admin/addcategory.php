<?php
include '../config.php';
session_start();

$employee_id = $_SESSION['employee_id'];

if (!isset($employee_id)) {
    header('location:../login/login.php');
}

if (isset($_POST['add_category'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $select_category = mysqli_query($conn, "select * from categories where category_name = '$category_name'") or die('query fail');

    if (mysqli_num_rows($select_category) > 0) {
        echo "<script type='text/javascript'>
            window.alert('Danh mục sản phẩm đã tồn tại');
            </script>";
    } else {
        mysqli_query($conn, "insert into categories (category_name, description) values ('$category_name', '$description')") or die('query fail');
        echo "<script type='text/javascript'>
                    window.alert('Thêm danh mục sản phẩm thành công');
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

    <title>Nhân viên - Quản lý danh mục</title>

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
        .navbar {
            margin-top: 0px;
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

                <nav class="navbar navbar-expand  bg-white topbar mb-4 static-top shadow">

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
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Thêm danh mục sản phẩm</h1>
                    </div>

                    <div class="row">

                        <div class="container mt-1">
                            <form method="post">
                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <input type="text" class="form-control" name="category_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <input type="text" class="form-control" name="description" required>
                                </div>

                                <input name="add_category" type="submit" class="btn btn-primary" value="Thêm danh mục">
                            </form>
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