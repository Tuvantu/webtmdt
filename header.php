<?php
include './config.php';
session_start();

?>
<form action="timkiem.php" method="POST">
        <div class="app">
            <div class="header">
                <div class="grid wide">
                    <div class="header-main">
                        <div class="logo">
                            <a href="index.php"><img src="./img/logo.png" width="180" height="80"
                                    style="position: relative; top: 10px"></a>
                        </div>
                        <div class="search">
                            <input type="text" name="s" class="search-bar" placeholder="Tìm kiếm">
                            <input type="submit" value="Tìm kiếm" class="btn-search">

                        </div>
                        <div class="account" style="position: relative; top: 0px; gap: 13px">
                            <p class="name_account">
                                <?php echo $_SESSION['user_name'] ?>
                            </p>
                            <i class="fa-solid fa-circle-user" style="color: #8bea96; top: 8px;"></i>
                        </div>
                    </div>
                </div>
            </div>
    </form>


    <div class="navigation-bar">
        <ul class="navbar-list">
            <li class="navbar-item"><a href="index.php" class="navbar-link">TRANG CHỦ</a></li>
            <li class="navbar-item"><a href="./pages/gioithieu.php" class="navbar-link">GIỚI THIỆU</a></li>
            <li class="navbar-item navbar-item-category">
                <a href="" class="navbar-link">DANH MỤC</a>
                <div class="navbar-category">
                    <ul class="navbar-category-list">
                        <?php
                        $select_category = mysqli_query($conn, "select * from categories") or die('query fail');
                        if (mysqli_num_rows($select_category) > 0) {
                            while ($fetch_category = mysqli_fetch_assoc($select_category)) {
                                ?>
                                <li class="navbar-category-item">
                                    <?php echo $fetch_category['category_name'] ?>
                                </li>

                                <?php
                            }
                        }
                        ?>
                    </ul>

                </div>
            </li>
            <li class="navbar-item"><a href="./pages/lienhe.php" class="navbar-link">LIÊN HỆ</a></li>
        </ul>
        <ul class="navbar-list">
            <li class="navbar-item"><a href="./pages/giohang.php" class="navbar-link">GIỎ HÀNG</a></li>
            <li class="navbar-item"><a href="./pages/dangxuat.php" class="navbar-link">ĐƠN HÀNG</a></li>
            <li class="navbar-item upload"><a href="postnews.php" class="navbar-link">ĐĂNG TIN</a></li>

        </ul>
    </div>

    