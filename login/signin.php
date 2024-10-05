<?php
include '../config.php';

if (isset($_POST['submit'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $create_time = date('Y-m-d H:i:s');

    $select_user = mysqli_query($conn, "select * from users where phone_number = $phone_number") or die('query fail');

    if (mysqli_num_rows($select_user) > 0) {
        echo "<script type='text/javascript'>
                window.alert('số điện thoại đã tồn tại');
                </script>";
    } else {
        mysqli_query($conn, "insert into users (user_name, password, phone_number, role_id, create_time) values ('$user_name', '$password', '$phone_number', '3', '$create_time')") or die('query fail');
        echo "<script type='text/javascript'>
                window.alert('Đăng ký thành công');
                </script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="./css/signinpage.css">
</head>

<body>
    <main>
        <form method="POST" class="main__content">
            <div class="signin__header">

            </div>
            <div class="signin__title">
                <h3>Đăng ký tài khoản</h3>
            </div>

            <div class="signin__input">
                <input name="user_name" type="text" placeholder="Họ và tên">
                <input name="phone_number" type="text" placeholder="Số diện thoại">
                <input name="password" type="password" placeholder="Mật khẩu">
            </div>

            <div class="signin__policy">
                <input type="checkbox" id="agreeCheckbox">
                <p>Đồng ý với <a href="">Điều khoản sử dụng</a> và <a href="">Chính sách bảo mật</a> của chúng tôi.</p>
            </div>

            <div class="signin_btn">
                <input class="submit_btn" type="submit" name="submit" id="registerBtn" disabled value="Đăng Ký">
            </div>

            <div class="login">
                <p>Đã có tài khoản? <a href="./login.php">Đăng nhập ngay</a></p>
            </div>


        </form>
    </main>
</body>
<script>
    document.getElementById('agreeCheckbox').addEventListener('change', function () {
        const registerBtn = document.getElementById('registerBtn');
        registerBtn.disabled = !this.checked; // Disable the button if checkbox is unchecked
    });
</script>

</html>