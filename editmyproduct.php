<?php
include './config.php';
session_start();
error_reporting(E_ALL & ~E_NOTICE);


$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:../login/login.php');
}

// Kiểm tra xem product_id có được truyền vào không
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Lấy thông tin sản phẩm theo product_id
    $select_product = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '$product_id'") or die('query failed');

    if (mysqli_num_rows($select_product) > 0) {
        $fetch_product = mysqli_fetch_assoc($select_product);
    } else {
        // Nếu không tìm thấy sản phẩm, chuyển hướng về trang cửa hàng của tôi
        header('location: myshop.php');
        exit();
    }
} else {
    header('location: myshop.php');
    exit();
}

// Xử lý cập nhật sản phẩm
if (isset($_POST['submit'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = $_POST['quantity'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $time_used = mysqli_real_escape_string($conn, $_POST['time_used']);
    $purchase_time = mysqli_real_escape_string($conn, $_POST['purchase_time']);
    $place_of_purchase = mysqli_real_escape_string($conn, $_POST['place_of_purchase']);
    $purchase_price = mysqli_real_escape_string($conn, $_POST['purchase_price']);
    $warranty_period = mysqli_real_escape_string($conn, $_POST['warranty_period']);

    // Cập nhật sản phẩm
    mysqli_query($conn, "UPDATE products SET product_name = '$product_name', description = '$description', 
    price = '$price', quantity = '$quantity', time_used = '$time_used', purchase_time = '$purchase_time',
    place_of_purchase = '$place_of_purchase', purchase_price = '$purchase_price', 
    warranty_period = '$warranty_period' WHERE product_id = '$product_id'") or die('query failed');

    $message = 'Cập nhật thông tin sản phẩm thành công!';
    echo "<script type='text/javascript'>
    window.alert('$message');
        window.location.href = 'detailmyproduct.php?id=$product_id'; // Chuyển hướng về trang thông tin chi tiết sản phẩm
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" type="text/css" href="./css/postnews.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
</head>

<body>
    <?php include 'header.php' ?>

    <main>
        <form method="POST" enctype="multipart/form-data" class="container">
            <h3 style="text-align: center; color: gray">Cập nhật thông tin sản phẩm</h3>

            <div class="section">
                <div class="section-content">
                    <div class="input-group">
                        <label for="product_name" style="color: gray">Tên sản phẩm</label>
                        <input name="product_name" type="text" id="product_name"
                            value="<?php echo $fetch_product['product_name']; ?>" required>
                    </div>

                    <div class="input-group">
                        <label for="price" style="color: gray">Giá sản phẩm</label>
                        <input name="price" type="text" id="price" value="<?php echo $fetch_product['price']; ?>"
                            required>
                    </div>

                    <div class="input-group">
                        <label for="quantity" style="color: gray">Số lượng</label>
                        <input name="quantity" type="text" id="quantity"
                            value="<?php echo $fetch_product['quantity']; ?>" required>
                    </div>

                    <div class="input-group">
                        <label for="description" style="color: gray">Mô tả</label>
                        <textarea name="description" id="description"
                            required><?php echo $fetch_product['description']; ?></textarea>
                    </div>

                    <div class="input-group">
                        <label for="image" style="color: gray">Hình ảnh</label>
                        <div class="upload-box">
                            <div class="upload-icon">+</div>
                            <input name="image" accept="image/jpg, image/jpeg, image/png" type="file">
                        </div>
                        <p class="note">Nhấp vào ô phía dưới để tải lên hình ảnh mới (nếu có).</p>
                    </div>

                    <div class="input-group">
                        <label for="time_used" style="color: gray">Thời gian đã sử dụng</label>
                        <input name="time_used" type="text" id="time_used"
                            value="<?php echo $fetch_product['time_used']; ?>" required>
                    </div>

                    <div class="input-group">
                        <label for="purchase_time" style="color: gray">Thời gian mua</label>
                        <input name="purchase_time" type="date" id="purchase_time"
                            value="<?php echo $fetch_product['purchase_time']; ?>">
                    </div>

                    <div class="input-group">
                        <label for="place_of_purchase" style="color: gray">Địa chỉ mua</label>
                        <input name="place_of_purchase" type="text" id="place_of_purchase"
                            value="<?php echo $fetch_product['place_of_purchase']; ?>" required>
                    </div>

                    <div class="input-group">
                        <label for="purchase_price">Giá khi mua</label>
                        <input name="purchase_price" type="text" id="purchase_price"
                            value="<?php echo $fetch_product['purchase_price']; ?>" required>
                    </div>

                    <div class="input-group">
                        <label for="warranty_period" style="color: gray">Hạn sử dụng</label>
                        <input name="warranty_period" type="date" id="warranty_period"
                            value="<?php echo $fetch_product['warranty_period']; ?>">
                    </div>

                    <div class="input-group">
                        <label for="category" style="color: gray">Danh mục</label>
                        <select name="category" id="category">
                            <?php
                            $select_category = mysqli_query($conn, "SELECT * FROM categories");
                            while ($fetch_category = mysqli_fetch_assoc($select_category)) {
                                $selected = ($fetch_category['category_id'] == $fetch_product['category_id']) ? 'selected' : '';
                                echo "<option value='" . $fetch_category['category_id'] . "' $selected>" . $fetch_category['category_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <input type="submit" class="btn-submit" name="submit" value="Cập nhật">
                </div>
            </div>
        </form>
    </main>

    <?php include 'footer.php' ?>
</body>

</html>