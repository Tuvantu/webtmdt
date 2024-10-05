<?php
include '../config.php';

if (isset($_POST['submit'])) {
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));

    $check_phonenumber = mysqli_query($conn, "select * from users where phone_number = $phone_number") or die('query fail');

    if (mysqli_num_rows($check_phonenumber) > 0) {
        $result = mysqli_fetch_assoc($check_phonenumber);
        $user_id = $result['user_id'];
        $phone_number_ori = $result['phone_number'];

        if ($phone_number == $phone_number_ori) {
            mysqli_query($conn, "update users set password = '$new_password' where user_id ='$user_id'") or die('query fail');
            echo "<script type='text/javascript'>
                window.alert('Cập nhật mật khẩu thành công');
                </script>";
        } else {
            echo "<script type='text/javascript'>
                window.alert('Số điện thoại không tồn tại trên hệ thống, vui lòng nhập lại.');
                </script>";
        }
    } else {
        echo "<script type='text/javascript'>
                window.alert('Không tìm thấy người dùng');
                </script>";
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="./css/fgpassword.css">
</head>

<body>
    <main>
        <form method="POST" class="main__content">
            <div class="fogot__header">

            </div>
            <div class="fogot__title">
                <h3>Đặt lại mật khẩu</h3>
            </div>

            <div class="fogot__text">
                <p>Nhập số điện thoại của bạn để đặt lại mật khẩu.</p>
            </div>

            <div class="fogot__input">
                <input name="phone_number" type="text" placeholder="Số điện thoại">
            </div>

            <div class="fogot__input">
                <input name="new_password" type="password" placeholder="Nhập mật khẩu mơi">
            </div>

            <div class="fogot_btn">
                <input class="change_btn" type="submit" name="submit" value="Đổi mật khẩu">
            </div>

            <div class="fogot__exit">
                <a href="./login.php">Quay về trang Đăng nhập.</a>
            </div>

        </form>
    </main>
</body>

</html>