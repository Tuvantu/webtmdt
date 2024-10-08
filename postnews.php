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
        <div class="container">
            <h2>Tạo tin đăng mới</h2>

            <!-- Chọn chuyên mục đăng tin -->
            <div class="section">
                <div class="section-header green">
                    <span>Chọn chuyên mục đăng tin</span>
                    <i class="arrow-icon">▼</i>
                </div>
                <div class="section-content">
                    <select>
                        <option value="Điện thoại di động">Đồ điện tử / Điện thoại di động</option>
                        <!-- Thêm các tùy chọn khác tại đây -->
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
                        <input type="text" id="tieude" placeholder="Tên sản phẩm" maxlength="70" required>
                        <span class="char-count">0/70</span>
                    </div>

                    <!-- Mô tả -->
                    <div class="input-group">
                        <label for="mota">Mô tả *</label>
                        <textarea id="mota" placeholder="Mô tả" maxlength="2000" rows="5" required></textarea>
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
                            <p>Tải ảnh lên</p>
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
                    <input type="text" placeholder="Bạn đã sử dụng sản phẩm này bao lâu?" required>
                    <input type="text" placeholder="Bạn mua sản phẩm này khi nào?">
                    <input type="text" placeholder="Bạn mua sản phẩm này ở đâu?">
                    <input type="text" placeholder="Giá khi mua của sản phẩm này?">
                    <input type="text" placeholder="Hạn sử dụng của sản phẩm?">
                </div>
            </div>


            <!-- Nhập thông tin liên hệ -->
            <div class="section">
                <div class="section-header green">
                    <span>Thông tin liên hệ</span>
                    <i class="arrow-icon">▼</i>
                </div>
                <div class="section-content">
                    <label for="dienthoai">Điện thoại *</label>
                    <input type="text" placeholder="Điện thoại" required>

                    <label for="nguoilienhe">Người liên hệ *</label>
                    <input type="text" placeholder="Người liên hệ" required>

                    <label for="tinhthanh">Địa chỉ *</label>
                    <input type="text" placeholder="Tỉnh/Thành" required>
                    
                </div>
            </div>
        </div>
        <button class="btn-submit">Đăng bài</button>
    </main>

    <?php include 'footer.php' ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</html>