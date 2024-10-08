<?php
include '../config.php';
session_start();

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = "DELETE FROM `productapproval` WHERE product_id = '$delete_id'";

    if (mysqli_query($conn, $delete_query)) {
        echo "<script type='text/javascript'>
            window.alert('Xóa sản phẩm thành công!');
            </script>";
    } else {
        die('Query failed: ' . mysqli_error($conn));
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
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <?php
        include 'navigation.php'
        ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <!-- Thông tin tài khoản -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nhân viên</span>
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
                        <h1 class="h3 mb-0 text-gray-800">Quản lý sản phẩm</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Ngày đăng</th>
                                            <th>Chi tiết</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $select_all_product = mysqli_query($conn, "SELECT p.product_name, p.price, p.quantity, p.create_time, p.product_id 
                                         FROM productapproval pa JOIN products p ON pa.product_id = p.product_id WHERE pa.status = 'Accept'") or die('Query failed');

                                        $stt = 1;

                                        if (mysqli_num_rows($select_all_product) > 0) {
                                            while ($fetch_product = mysqli_fetch_assoc($select_all_product)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $stt; ?></td>
                                                    <td><?php echo $fetch_product['product_name']; ?></td>
                                                    <td><?php echo $fetch_product['price']; ?></td>
                                                    <td><?php echo $fetch_product['quantity']; ?></td>
                                                    <td><?php echo $fetch_product['create_time']; ?></td>
                                                    <td><a
                                                            href="detailproduct.php?product_id=<?php echo $fetch_product['product_id']; ?>">Xem chi tiết</a></td>
                                                    <td>
                                                        <a href="productmanagement.php?delete=<?php echo $fetch_product['product_id']; ?>"
                                                            onclick="return confirm('Bạn muốn xóa sản phẩm này?')">Xóa sản phẩm</a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $stt++; 
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>Không có sản phẩm.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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