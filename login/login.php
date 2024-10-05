<?php
    include '../config.php';
    session_start();

    if (isset($_POST['submit'])) {
        $phone_number = mysqli_real_escape_string( $conn, $_POST['phone_number']);
        $password = mysqli_real_escape_string( $conn, md5($_POST['password']));

        $select_username = mysqli_query($conn, "select * from users where phone_number = '$phone_number'and password = '$password'") or die ('query fail');
        
        if (mysqli_num_rows($select_username) > 0) {
            $result = mysqli_fetch_assoc($select_username);

            if($result['role_id'] == 1) {
                $_SESSION['admin_name'] = $result['user_name'];
                $_SESSION['admin_id'] = $result['user_id'];
                header('location:../adminpage.php');
            } elseif($result['role_id'] == 2) {
                $_SESSION['employee_name'] = $result['user_name'];
                $_SESSION['employee_id'] = $result['user_id'];
                header('location:../employee.php');
            } else {
                $_SESSION['user_name'] = $result['user_name'];
                $_SESSION['user_id'] = $result['user_id'];
                header('location:../user.php');
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <main>
        <form method="POST" class="main__content">
            <div class="login__header">

            </div>
            <div class="login__title">
                <h3>Đăng nhập tài khoản</h3>
            </div>

            <div class="login__input">
                <input name="phone_number" type="text" placeholder="Số điện thoại">
                <input name="password" type="password" placeholder="Mật khẩu">
            </div>

            <div class="login__fogotpw">
                <a href="./fogotpassword.php">Quên mật khẩu?</a>
            </div>

                <input type="submit" name="submit" value="Đăng nhập">

            <div class="login__text">
                <p>Chưa có tài khoản? <a href="./signin.php">Đăng ký tài khoản mới.</a></p>
            </div>
        </form>
    </main>
</body>

</html>