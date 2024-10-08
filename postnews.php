<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);

if (isset($_POST['submit'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = $_POST['price'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $quantity = $_POST['quantity'];
    $time_used = $_POST['time_used'];
    $create_time = date('Y-m-d H:i:s');
    $purchase_time = $_POST['purchase_time'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'upload_image/' . $image;
    $warranty_period = $_POST['warranty_period'];
    $place_of_purchase = $_POST['place_of_purchase'];
    $purchase_price = $_POST['purchase_price'];
    $user_id = $_SESSION['user_id'];
    $category_id = $_POST['category'];

    $add_product = mysqli_query($conn, "insert into products (
    product_name,  price, description, quantity, time_used, create_time, purchase_time, product_image, warranty_period,
    place_of_purchase, purchase_price, user_id, category_id) values ('$product_name', '$price', '$description',
    '$quantity', '$time_used', '$create_time', '$purchase_time', '$image', '$warranty_period', '$place_of_purchase',
    '$purchase_price', '$user_id', '$category_id')") or die('query fail');

    if ($add_product) {
        move_uploaded_file($image_tmp_name, $image_folder);
        echo "<script type='text/javascript'>
                window.alert('Đăng sản phẩm thành công, vui lòng chờ nhân viên duyệt sản phẩm của bạn.');
                </script>";
    } else {
        echo "<script type='text/javascript'>
        window.alert('Đăng sản phẩm không thành công.');
        </script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng tin</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" type="text/css" href="./css/postnews.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/brands.min.css">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Fontawesome js -->
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/all.min.js">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/brands.min.js">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/fontawesome.min.js">
</head>

<body>
    <?php include 'header.php' ?>

    <main>
        <form method="POST" enctype="multipart/form-data" class="container">
            <h2>Tạo tin đăng mới</h2>

            <!-- Chọn chuyên mục đăng tin -->
            <div class="section">
                <div class="section-header green">
                    <span>Chọn chuyên mục đăng tin</span>
                    <i class="arrow-icon">▼</i>
                </div>


                <div class="section-content">
                    <select name="category">
                        <?php
                        $select_category = mysqli_query($conn, "select * from categories");

                        if (mysqli_num_rows($select_category) > 0) {
                            while ($fetch_category = mysqli_fetch_assoc($select_category)) {
                                echo "<option value='" . $fetch_category['category_id'] . "'>" . $fetch_category['category_name'] . "</option>";
                            }
                        } else {
                            echo "<option>Không có danh mục nào.</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Nội dung tin đăng -->
            <div class="section">
                <div class="section-header blue">
                    <span>Nội dung tin đăng</span>
                    <i class="arrow-icon">▼</i>
                </div>
                <div class="section-content">
                    <!-- Tiêu đề -->
                    <div class="input-group">
                        <label for="tieude">Tên sản phẩm *</label>
                        <input name="product_name" type="text" id="tieude" placeholder="Tên sản phẩm" maxlength="70"
                            required>
                    </div>

                    <div class="input-group">
                        <label for="tieude">Giá sản phẩm *</label>
                        <input name="price" type="text" id="tieude" placeholder="Giá sản phẩm" required>
                    </div>

                    <div class="input-group">
                        <label for="tieude">Số lượng *</label>
                        <input name="quantity" type="text" id="tieude" placeholder="Số lượng" required>
                    </div>


                    <!-- Mô tả -->
                    <div class="input-group">
                        <label for="mota">Mô tả *</label>
                        <textarea name="description" id="mota" placeholder="Mô tả" maxlength="2000" rows="5"
                            required></textarea>
                        <span class="char-count">0/2000</span>
                        <p class="note">Mô tả bằng tiếng Việt có dấu:<br>
                            - Những điểm nổi bật, đặc thù của nhà bán, căn hộ.<br>
                            - Các tiện ích xung quanh căn hộ.<br>
                            - Thời gian bàn giao, lưu trú.<br>
                            - Nội thất cơ bản hoặc liệt kê những nội thất có sẵn.
                        </p>
                    </div>

                    <!-- Hình ảnh -->
                    <div class="input-group">
                        <label for="hinhanh">Hình ảnh *</label>
                        <div class="upload-box">
                            <div class="upload-icon">+</div>
                            <input name="image" accept="image/jpg, image/jpeg, image/png" type="file" required>
                        </div>
                        <p class="note">Nhấp vào ô phía dưới để tải lên hình ảnh, bạn có thể tải lên tối đa 30 ảnh, mỗi
                            ảnh tối đa 8MB.</p>
                    </div>

                    <!-- Gợi ý -->
                    <div class="input-group suggest-box">
                        <p><strong>Gợi ý</strong><br>
                            - Đăng tải ảnh thật là cách tăng độ tin cậy để dễ dàng giao dịch.<br>
                            - Hình ảnh chất lượng được hơn 98% khách hàng coi là yếu tố quan trọng nhất khi xem tin.</p>
                        <p><strong>Hình ảnh minh họa</strong></p>
                        <div class="image-gallery">
                            <img src="https://via.placeholder.com/100x70" alt="Hình 1">
                            <img src="https://via.placeholder.com/100x70" alt="Hình 2">
                            <img src="https://via.placeholder.com/100x70" alt="Hình 3">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin cơ bản -->
            <div class="section">
                <div class="section-header blue">
                    <span>Thông tin cơ bản</span>
                    <i class="arrow-icon">▼</i>
                </div>
                <div class="section-content">
                    <label for="time_used">Bạn đã sử dụng sản phẩm này bao lâu?</label>
                    <input name="time_used" type="text" placeholder="Bao nhiêu ngày (tuần, tháng, năm,...)" required>
                    <label for="purchase_time">Bạn mua sản phẩm này khi nào?</label>
                    <input name="purchase_time" type="date">
                    <label for="time_used">Bạn mua sản phẩm này ở đâu?</label>
                    <input name="place_of_purchase" type="text" placeholder="Nhập địa chỉ.">
                    <label for="time_used">Giá khi mua của sản phẩm này?</label>
                    <input name="purchase_price" type="text" placeholder="Nhập giá khi mua.">
                    <label for="time_used">Hạn sử dụng của sản phẩm? (Nếu có)</label>
                    <input name="warranty_period" type="date">
                </div>
            </div>


            <!-- Nhập thông tin liên hệ -->
            <div class="section">
                <div class="section-header green">
                    <span>Thông tin liên hệ</span>
                    <i class="arrow-icon">▼</i>
                </div>

                <?php
                $select_user = mysqli_query($conn, "select * from users where user_id = '$user_id'");
                $fetch_user = mysqli_fetch_assoc($select_user);

                ?>

                <div class="section-content">


                    <label for="dienthoai">Điện thoại</label>
                    <input type="text" placeholder="Điện thoại" value="<?php echo $fetch_user['phone_number'] ?>"
                        disabled>

                    <label for="nguoilienhe">Người liên hệ</label>
                    <input type="text" placeholder="Người liên hệ" value="<?php echo $fetch_user['user_name'] ?>"
                        disabled>

                    <label for="tinhthanh">Địa chỉ</label>
                    <input type="text" placeholder="Tỉnh/Thành" value="<?php echo $fetch_user['address'] ?>" disabled>

                </div>
            </div>

            <input type="submit" class="btn-submit" name="submit" value="Đăng sản phẩm">

        </form>
    </main>

    <?php include 'footer.php' ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</html>