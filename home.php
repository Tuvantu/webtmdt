<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuLam</title>

    <!-- Fontawesome css -->
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/brands.min.css">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/css/fontawesome.min.css">
    <!-- Fontawesome js -->
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/all.min.js">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/brands.min.js">
    <link rel="stylesheet" href="./icon/fontawesome-free-6.6.0-web/js/fontawesome.min.js">

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/primary.css">
</head>

<body>
    <header>
        <div class="header" style="">
            <div class="header__logo">

            </div>

            <div class="header__search">
                <form action="" method="get">
                    <input type="text" placeholder="Nhập từ khóa để tìm kiếm">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass" style="color: #949494;"></i></button>
                </form>
            </div>

            <div class="header__menu">
                <div class="menu__item">
                    <a href="#" id="notify">
                        <p>Thông báo</p>
                    </a>
                </div>


                <div class="menu__item">
                    <a href="#">
                        <p>Tin nhắn</p>
                    </a>
                </div>
                <div class="menu__item">
                    <a href="#">
                        <p>Đơn hàng</p>
                    </a>
                </div>

                <div class="postnews">
                    <a href="#">
                        <i class="fa-solid fa-pen-to-square" style="color: white;"></i>
                        <p>Đăng tin</p>
                    </a>
                </div>
                <div class="cart">
                    <a href="#">
                        <i class="fa-solid fa-cart-shopping" style="color: #e4fd68;"></i>
                    </a>
                </div>

                <div class="login">
                    <a href="./login/login.php">
                        <i class="fa-solid fa-circle-user" style="color: white;"></i>
                        <p>Đăng nhập</p>
                    </a>
                </div>
            </div>

        </div>
    </header>

    <main>

        <!-- MODAL THÔNG BÁO -->
        <div id="notificationModal" class="notification-modal">
            <p>Nội dung thông báo</p>
        </div>
        <div class="main__slider">
            <img src="./img/slide.jpg" alt="">
        </div>

        <!-- DANH MỤC SẢN PHẨM -->
        <div class="main__category">
            <div class="title">
                <p><i class="fa-solid fa-bag-shopping" style="color: #8ABC40;"></i> Khám phá danh mục</p>
            </div>

            <div class="category">

                <div class="category__item">
                    <a href="">
                        <div class="category__photo">
                            <img src="./img/dodunglambep.jfif" alt="">
                        </div>
                        <div class="category__title">
                            <p>Đồ dùng làm bếp</p>
                        </div>
                    </a>
                </div>

                <div class="category__item">
                    <a href="">
                        <div class="category__photo">
                            <img src="./img/dodientu.jfif" alt="">
                        </div>
                        <div class="category__title">
                            <p>Đồ điện tử</p>
                        </div>
                    </a>
                </div>

                <div class="category__item">
                    <a href="">
                        <div class="category__photo">
                            <img src="./img/thoitrang.jfif" alt="">
                        </div>
                        <div class="category__title">
                            <p>Thời trang</p>
                        </div>
                    </a>
                </div>

                <div class="category__item">
                    <a href="">
                        <div class="category__photo">
                            <img src="./img/mypham.jfif" alt="">
                        </div>
                        <div class="category__title">
                            <p>Mỹ phẩm</p>
                        </div>
                    </a>
                </div>

                <div class="category__item">
                    <a href="">
                        <div class="category__photo">
                            <img src="./img/xeco.jfif" alt="">
                        </div>
                        <div class="category__title">
                            <p>Xe cộ</p>
                        </div>
                    </a>
                </div>

                <div class="category__item">
                    <a href="">
                        <div class="category__photo">
                            <img src="./img/sachvo.jfif" alt="">
                        </div>
                        <div class="category__title">
                            <p>Văn phòng phẩm</p>
                        </div>
                    </a>
                </div>

                <div class="category__item">
                    <a href="">
                        <div class="category__photo">
                            <img src="./img/mevabe.jfif" alt="">
                        </div>
                        <div class="category__title">
                            <p>Mẹ và bé</p>
                        </div>
                    </a>
                </div>

                <div class="category__item">
                    <a href="">
                        <div class="category__photo">
                            <img src="./img/noithat.jfif" alt="">
                        </div>
                        <div class="category__title">
                            <p>Nội thất</p>
                        </div>
                    </a>
                </div>

                <div class="category__item">
                    <a href="">
                        <div class="category__photo">
                            <img src="./img/giaitrithethao.jfif" alt="">
                        </div>
                        <div class="category__title">
                            <p>Giải trí, thể thao</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
        <!-- SẢN PHẨM NỔI BẬT -->
        <div class="main__product">
            <div class="title">
                <p><i class="fa-solid fa-star" style="color: #8ABC40;"></i> Sản phẩm nổi bật</p>
            </div>

            <div class="product_container">
                <div class="product">
                    <a href="#">
                        <div class="product_photo">
                            <img src="./img/iphone13.jpg" alt="anh san pham">
                        </div>
                        <div class="product_info">
                            <p class="product_title">Iphone13 </p>
                            <p class="product_price">8.500.000 đ</p>
                            <div class="time_address">
                                <span class="timeupload timeadd"><i class="fa-solid fa-clock"
                                        style="color: #8ABC40;"></i><span>25/09/2024</span></span>
                                <span class="address timeadd"><i class="fa-solid fa-location-pin"
                                        style="color: #8ABC40;"></i><span>Bến Tre</span></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product">
                    <a href="#">
                        <div class="product_photo">
                            <img src="./img/giay.webp" alt="anh san pham">
                        </div>
                        <div class="product_info">
                            <p class="product_title">Giày đá banh mizuno sala japan size 40.5</p>
                            <p class="product_price">1.700.000 đ</p>
                            <div class="time_address">
                                <span class="timeupload timeadd"><i class="fa-solid fa-clock"
                                        style="color: #8ABC40;"></i><span>25/09/2024</span></span>
                                <span class="address timeadd"><i class="fa-solid fa-location-pin"
                                        style="color: #8ABC40;"></i><span>TP. Hồ Chí Minh</span></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product">
                    <a href="#">
                        <div class="product_photo">
                            <img src="./img/quan.webp" alt="anh san pham">
                        </div>
                        <div class="product_info">
                            <p class="product_title">LẪN SHORT HOA SZ 32/ LƯNG 82-86/D56/Ô32 Mới</p>
                            <p class="product_price">90.000 đ</p>
                            <div class="time_address">
                                <span class="timeupload timeadd"><i class="fa-solid fa-clock"
                                        style="color: #8ABC40;"></i><span>25/09/2024</span></span>
                                <span class="address timeadd"><i class="fa-solid fa-location-pin"
                                        style="color: #8ABC40;"></i><span>TP. Hồ Chí Minh</span></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product">
                    <a href="#">
                        <div class="product_photo">
                            <img src="./img/daysac.webp" alt="anh san pham">
                        </div>
                        <div class="product_info">
                            <p class="product_title">Dây cáp sạc dành cho điện thoại Ip</p>
                            <p class="product_price">5.000 đ</p>
                            <div class="time_address">
                                <span class="timeupload timeadd"><i class="fa-solid fa-clock"
                                        style="color: #8ABC40;"></i><span>25/09/2024</span></span>
                                <span class="address timeadd"><i class="fa-solid fa-location-pin"
                                        style="color: #8ABC40;"></i><span>TP. Hồ Chí Minh</span></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product">
                    <a href="#">
                        <div class="product_photo">
                            <img src="./img/xemay.webp" alt="anh san pham">
                        </div>
                        <div class="product_info">
                            <p class="product_title">SH 150 ABS Xanh Đen 2018 Mới 99% _Có Trả Góp</p>
                            <p class="product_price">75.000.000 đ</p>
                            <div class="time_address">
                                <span class="timeupload timeadd"><i class="fa-solid fa-clock"
                                        style="color: #8ABC40;"></i><span>25/09/2024</span></span>
                                <span class="address timeadd"><i class="fa-solid fa-location-pin"
                                        style="color: #8ABC40;"></i><span>TP. Hồ Chí Minh</span></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="product">
                    <a href="#">
                        <div class="product_photo">
                            <img src="./img/sach.webp" alt="anh san pham">
                        </div>
                        <div class="product_info">
                            <p class="product_title">Sách Phong thuỷ & Nhân học</p>
                            <p class="product_price">80.000 đ</p>
                            <div class="time_address">
                                <span class="timeupload timeadd"><i class="fa-solid fa-clock"
                                        style="color: #8ABC40;"></i><span>25/09/2024</span></span>
                                <span class="address timeadd"><i class="fa-solid fa-location-pin"
                                        style="color: #8ABC40;"></i><span>TP. Hồ Chí Minh</span></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product">
                    <a href="#">
                        <div class="product_photo">
                            <img src="./img/lens.webp" alt="anh san pham">
                        </div>
                        <div class="product_info">
                            <p class="product_title">Thanh lý Lens Canon 55-250 IS</p>
                            <p class="product_price">1.300.000 đ</p>
                            <div class="time_address">
                                <span class="timeupload timeadd"><i class="fa-solid fa-clock"
                                        style="color: #8ABC40;"></i><span>25/09/2024</span></span>
                                <span class="address timeadd"><i class="fa-solid fa-location-pin"
                                        style="color: #8ABC40;"></i><span>TP. Hồ Chí Minh</span></span>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </main>

    <footer>
        <div class="footer_infomation">
            <div class="info_company">
                <div class="image_logo">
                    <img src="" alt="">
                </div>

                <div class="info_detail">
                    <h4>WEBSITE MUA BÁN ĐỒ CŨ</h4>
                    <span class="numberphone"><i class="fa-solid fa-phone" style="color: #93DC5C;"></i>
                        0327348580</span>
                    <span class="address_company">
                        <strong>Địa chỉ: </strong>12 Nguyễn Văn Bảo, Phường 4, Quận Gò Vấp, Thành phố Hồ Chí Minh
                    </span>
                    <span class="email">
                        <strong>Email: </strong>tuvantu251202@gmail.com
                    </span>
                    <span class="people">
                        <strong>Người đại diện chịu trách nhiệm:</strong>
                        Từ Văn Tú, Bùi Thùy Lam.
                    </span>

                </div>
            </div>

            <div class="help">
                <div class="support">
                    <div class="support_cusomer">
                        <h5>HỖ TRỢ KHÁCH HÀNG</h5>
                        <div class="list">
                            <a href="#">Tin tức & khuyến mãi</a>
                            <a href="#">Hỗ trợ đăng tin</a>
                            <a href="#">Câu hỏi thường gặp</a>
                            <a href="">An toàn mua bán</a>
                        </div>
                    </div>

                    <div class="aboutus">
                        <h5>VỀ CHÚNG TÔI</h5>
                        <div class="list">
                            <a href="#">Giới thiệu</a>
                            <a href="#">Liên hệ</a>
                            <a href="#">Điều khoản sử dụng</a>
                            <a href="">Chính sách bảo mật</a>
                        </div>
                    </div>
                </div>

                <div class="link">
                    <h5>LIÊN KẾT</h5>

                    <div class="icon_link">
                        <i class="fa-brands fa-facebook" style="color: #005cfa;"></i>
                        <i class="fa-brands fa-youtube" style="color: #ff0000;"></i>
                        <i class="fa-solid fa-phone" style="color: #00ff91;"></i>
                    </div>
                    <span class="text">TuLam có trách nhiệm chuyển tại thông tin. Không chịu bất kỳ trách nhiệm nà từ
                        các tin này. Xin cảm ơn!</span>

                </div>
            </div>
        </div>
    </footer>
</body>


<SCript>
    document.getElementById('notify').addEventListener('click', function (event) {
        event.preventDefault(); // Ngăn chặn chuyển hướng mặc định

        var modal = document.getElementById('notificationModal');

        // Kiểm tra trạng thái của modal
        if (modal.style.display === "none" || modal.style.display === "") {
            modal.style.display = "block"; // Hiện modal
        } else {
            modal.style.display = "none"; // Ẩn modal nếu đã hiển thị
        }
    });

    // Ẩn modal nếu nhấp chuột bên ngoài modal
    window.onclick = function (event) {
        var modal = document.getElementById('notificationModal');
        if (event.target !== modal && !modal.contains(event.target) && event.target !== document.getElementById('notify')) {
            modal.style.display = "none";
        }
    }

</SCript>

</html>