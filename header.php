<?php
include './config.php';
session_start();
$user_id = @$_SESSION['user_id'];
?>
<form action="index.php" method="POST">
    <div class="app">
        <div class="header">
            <div class="grid wide">
                <div class="header-main">
                    <div class="logo">
                        <a href="index.php"><img src="./img/C.png" width="180" height="80"
                                style="object-fit: cover; margin-top: 20px"></a>
                    </div>
                    <div class="search">
                        <input type="text" name="s" class="search-bar" placeholder="Tìm kiếm">
                        <input type="submit" value="Tìm kiếm" class="btn-search">
                    </div>

                    <div class="account" style="position: relative; top: 0px; gap: 13px" onclick="toggleDropdown()">
                        <?php
                        if (isset($user_id)) {
                            ?>
                            <p class="name_account">
                                <?php echo $_SESSION['user_name']; ?>
                            </p>
                            <i class="fa-solid fa-circle-user" style="color: #8bea96;"></i>
                            <div id="dropdown" class="dropdown-content" style="display: none;">
                                <a href="myprofile.php?user_id=<?php echo $user_id ?>">Hồ sơ cá nhân</a>
                                <a href="change_password.php?user_id=<?php echo $user_id ?>">Đổi mật khẩu</a>
                                <button type="button" onclick="showModal()" class="btn_logout">Đăng xuất</button>
                            </div>
                            <?php
                        } else {
                            ?>
                            <a href="./login/login.php" class="login">Đăng nhập</a>
                            <span class="space">/</span>
                            <a href="./login/signin.php" class="signin">Đăng ký</a>
                            <?php
                        }
                        ?>
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
        <li class="navbar-item">
            <?php if ($user_id): ?>
                <a href="./cart.php" class="navbar-link">GIỎ HÀNG</a>
            <?php else: ?>
                <a href="./login/login.php" class="navbar-link">GIỎ HÀNG</a>
            <?php endif; ?>
        </li>
        <li class="navbar-item navbar-item-order">
            <a href="#" class="navbar-link" onclick="toggleOrderDropdown()">ĐƠN HÀNG</a>
            <div id="orderDropdown" class="dropdown-content" style="display: none; margin-top: 35px">
                <a href="./pages/donmuahang.php">Đơn mua</a>
                <a href="./pages/donbanhang.php">Đơn bán</a>
            </div>
        </li>
        <li class="navbar-item">
            <?php if ($user_id): ?>
                <a href="./myshop.php" class="navbar-link">CỬA HÀNG</a>
            <?php else: ?>
                <a href="./login/login.php" class="navbar-link">CỬA HÀNG</a>
            <?php endif; ?>
        </li>
        <li class="navbar-item upload">
            <?php if ($user_id): ?>
                <a href="./postnews.php" class="navbar-link">ĐĂNG TIN</a>
            <?php else: ?>
                <a href="./login/login.php" class="navbar-link">ĐĂNG TIN</a>
            <?php endif; ?>
        </li>
    </ul>
</div>

<!-- Modal HTML -->
<div id="logoutModal" class="modal" style="display:none;">
    <div class="modal-content">
        <p style="font-size: 16px">Bạn có chắc chắn muốn đăng xuất?</p>
        <div class="modal_btn">
            <button type="button" class="btn_cancel" onclick="closeModal()">Hủy</button>
            <a href="logout.php" class="btn_ok">OK</a>
        </div>
    </div>
</div>

<style>
    .account {
        position: relative;
    }

    .account a,
    .account .space {
        text-decoration: none;
        color: green;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        margin-top: 185px;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    /* Modal styles */
    .modal {
        display: flex;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        justify-content: center;
        align-items: center;
    }

    .btn_profile,
    .btn_logout {
        width: 160px;
        height: 50px;
        border-radius: 5px;
        border: none;
        background-color: white;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 100%;
        max-width: 300px;
        text-align: center;
        font-size: 16px;
    }

    .btn_cancel,
    .btn_ok {
        width: 80px;
        height: 30px;
        border-radius: 5px;
        background-color: white;
    }

    .modal_btn {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .btn_cancel {
        border: 1px solid red;
        color: red;
    }

    .btn_ok {
        border: 1px solid green;
        color: green;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("dropdown");
        dropdown.style.display = (dropdown.style.display === "none" || dropdown.style.display === "") ? "block" : "none";
    }

    function toggleOrderDropdown() {
        var orderDropdown = document.getElementById("orderDropdown");
        orderDropdown.style.display = (orderDropdown.style.display === "none" || orderDropdown.style.display === "") ? "block" : "none";
    }

    window.onclick = function (event) {
        if (!event.target.matches('.name_account') && !event.target.matches('.fa-circle-user') && !event.target.matches('.navbar-item-order a')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === 'block') {
                    openDropdown.style.display = 'none';
                }
            }
        }
    }

    function showModal() {
        document.getElementById("logoutModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("logoutModal").style.display = "none";
    }

</script>
