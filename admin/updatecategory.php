<?php
include '../config.php';
session_start();

$employee_id = $_SESSION['employee_id'];

if (!isset($employee_id)) {
    header('location:../login/login.php');
}

// Kiểm tra xem category_id có được truyền vào không
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Lấy thông tin danh mục theo category_id
    $select_category = mysqli_query($conn, "SELECT * FROM categories WHERE category_id = '$category_id'") or die('query failed');

    if (mysqli_num_rows($select_category) > 0) {
        $fetch_category = mysqli_fetch_assoc($select_category);
    } else {
        // Nếu không tìm thấy danh mục, chuyển hướng về trang quản lý danh mục
        header('location: category.php');
        exit();
    }
} else {
    header('location: category.php');
    exit();
}

// Xử lý cập nhật danh mục
if (isset($_POST['update_category'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Cập nhật danh mục
    mysqli_query($conn, "UPDATE categories SET category_name = '$category_name', description = '$description' WHERE category_id = '$category_id'") or die('query failed');

    $message = 'Cập nhật danh mục sản phẩm thành công!';
    echo "<script type='text/javascript'>
            window.alert('$message');
            window.location.href = 'category.php'; // Chuyển hướng về trang quản lý danh mục
          </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cập nhật danh mục</title>
    <link rel="stylesheet" href="../icon/fontawesome-free-6.6.0-web/css/all.min.css">
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
    <a class="nav-link" href="indexemployee.php">
        <i class="fas fa-fw fa-bars"></i>
        <span>Bảng điều khiển</span></a>
</li>

<hr class="sidebar-divider">

<li class="nav-item">
    <a class="nav-link" href="browseproduct.php">
        <i class="fas fa-fw fa-check"></i>
        <span>Duyệt sản phẩm</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="productmanagement.php">
        <i class="fas fa-fw fa-shop"></i>
        <span>Quản lý sản phẩm</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="category.php">
        <i class="fas fa-fw fa-clipboard"></i>
        <span>Quản lý danh mục</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="notification.php">
        <i class="fas fa-fw fa-bell"></i>
        <span>Gửi thông báo</span></a>
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
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nhân viên</span>
                            <div class="sidebar-brand-icon">
                                <i class="fas fa-circle-user"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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
                    <h1 class="h3 mb-0 text-gray-800">Cập nhật danh mục sản phẩm</h1>
                </div>

                <div class="row">
                    <div class="container mt-1">
                        <form method="post">
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" class="form-control" name="category_name" value="<?php echo $fetch_category['category_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <input type="text" class="form-control" name="description" value="<?php echo $fetch_category['description']; ?>" required>
                            </div>
                            <input name="update_category" type="submit" class="btn btn-primary" value="Cập nhật danh mục">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Website Thương Mại Điện Tử Mua Bán Đồ Cũ C2C</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
