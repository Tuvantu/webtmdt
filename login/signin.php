<?php
    include 'config.php';
    
    if (isset($_POST['submit'])) 
    {
        $user_name = mysqli_real_escape_string($conn, $_POST['name']);
    }
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="./css/signincss.css">
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
                <input name="password" type="text" placeholder="Mật khẩu">
            </div>

            <div class="signin__policy">
                <input type="checkbox" id="agreeCheckbox">
                <p>Đồng ý với <a href="">Điều khoản sử dụng</a> và <a href="">Chính sách bảo mật</a> của chúng tôi.</p>
            </div>

            
                <input class="submit_btn" type="submit" name="submit" id="registerBtn" disabled value="Đăng Ký">

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