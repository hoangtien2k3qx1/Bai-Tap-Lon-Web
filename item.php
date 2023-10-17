<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "cta_shop";


    //tao ket noi
    $conn = new mysqli($host, $username, $password, $database);
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/item.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.4.2-web/css/all.min.css">
</head>
<body>
    <div class="app">
        <header class="header">
            <div class="grid">
                <nav class="header__navbar">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-item--has-qr header__navbar-item--separate">
                            Cửa hàng CTA

                            <!-- Header QR code -->
                            <div class="header__qr">
                                <img src="assets/img/header-QR/qr-code.png" alt="QR code" class="header__qr-img">
                                <div class="header__qr-apps">
                                    <a href="" class="header__qr-link">
                                        <img src="assets/img/header-QR/gg-play.png" alt="" class="header__qr-download-img">
                                    </a>
                                    <a href="" class="header__qr-link">
                                        <img src="assets/img/header-QR/app-store.png" alt="" class="header__qr-download-img">
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="header__navbar-item">
                            <span class="header__navbar-title--no-pointer">Kết nói</span>
                            <a href="" class="header__navbar-icon-link">
                                <i class="header__navbar-icon fab fa-facebook"></i>
                            </a>
                            <a href="" class="header__navbar-icon-link">
                                <i class="header__navbar-icon fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
    
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item  header__navbar-item--has-notify">
                            <a href="" class="header__navbar-item-link">
                                <i class="header__navbar-icon fas fa-bell"></i>
                                Thông báo 
                            </a>
                            <div class="header__notify">
                                <header class="header__notify-header">
                                    <h3>Thông báo mới :</h3>
                                </header>
                                <?php
                                    $sql_select_hangsx="SELECT * FROM `product` ORDER BY Price_dropped ASC LIMIT 5";
                                    $result_se_hang=mysqli_query($conn,$sql_select_hangsx);
                                    $tong_bg=mysqli_num_rows($result_se_hang);// dem so ban ghi
                                    //echo $tong_bg; die;

                                $stt=0;
                                while($row=mysqli_fetch_object($result_se_hang)){
                                    $stt++;
                                    $Product_id[$stt] = $row-> Product_id;
                                    $Product_name[$stt] = $row-> Product_name ;
                                    $Brand[$stt] = $row-> Brand;
                                    $product_type[$stt] = $row-> Type;
                                    $Description[$stt] = $row-> Description;
                                    $Price[$stt] =$row-> Price;
                                    $Price_dropped[$stt] = $row-> Price_dropped;
                                    $uploadDir_img_logo[$stt] = $row-> Product_img;
                                }

                                ?>

                                <?php
                                    for($i=1;$i<=$tong_bg;$i++){
                                ?> 
                                <ul class="header__notify-list">
                                    <li class="header__notify-item">
                                        <a href="item.php?id=<?php echo $Product_id[$i];?>" class="header__notify-link">
                                            <img src="image/<?php echo  $uploadDir_img_logo[$i]?>" alt="" class="header__notify-img">
                                            <div class="header__notify-info">
                                                <span class="header__notify-name"><?php echo $Product_name[$i];?></span>
                                                <span class="header__notify-decription"><?php echo $Description[$i];?></span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <?php
                                    }
                                ?>
                                <footer class="header__notify-footer">
                                    <a href="" class="header__notify-footer-btn">Xem tất cả</a>
                                </footer>
                            </div>
                        </li>
                        <li class="header__navbar-item">
                            <a href="" class="header__navbar-item-link">
                                <i class="header__navbar-icon far fa-question-circle"></i>
                                Trợ giúp
                            </a>
                        </li>
                        <li class="header__navbar-item header__navbar-item--strong"></li>
                        <a href="login.php"><li class="header__navbar-item header__navbar-item--strong">Đăng nhập</li></a>
                    </ul>
                </nav>

                <!-- header-with-search -->
                <div class="header-with-search">
                    <div class="header__logo">
                        <a href="index.php"><img src="assets/img/header-QR/logo.svg" alt="" class="header__logo-img"></a>
                    </div>
                    <form class="header-with-search-form" name="product"  action="items.php" method="POST" enctype="multipart/form-data" >
                    <div class="header__search">
                        
                        <input class="header__search-input" placeholder="Nhập để tìm kiếm sản phẩm ..." name="Search_product"></input>
                        <div class="header__search-select">
                            <span class="header__search-select-label">Trong shop</span>
                            <i class="header__search-select-icon fas fa-angle-down"></i>

                            <ul class="header__search-option">
                                <li class="header__search-option-item header__search-option-item--active">
                                    <span>Trong shop</span>
                                    <i class="fas fa-check"></i>
                                </li>
                                <li class="header__search-option-item">
                                    <span></span>
                                    <i class="fas fa-check"></i>
                                </li>
                            </ul>
                        </div>
                        <button class="header__search-btn">
                            <i class="header__search-btn-icon fas fa-search"></i>
                        </button>
                
                </div>
                    </form>

                    <div class="header__cart">
                        <i class="header__cart-icon fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>
        </header>

        <?php
	$Product_id = $_GET['id'];
        $query = "Select * From product Where Product_id = $Product_id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result); //hien thi len form
        ?>
        <div class="container">
            <div class="grid">
                <div class="container__header">
                    <a href="index.php"><i class="container__header-icon fa-solid fa-house"></i></a>
                    <a href="items.php?Type="><i class="container__header-icon fa-solid fa-angle-right"> Product</i></a>
                    <a href=""><i class="container__header-icon fa-solid fa-angle-right"> <?php echo $row['Product_name'] ?></i></a>
                </div>
                <div class="container__content">
                    <div class="grid__column-3">
                        <div class="container__content-items">
                            <div class="container__content-item">
                                <img src="image/<?php echo $row['Product_img'] ?>" alt="" class="container__content-item-img">
                            </div>
                            <div class="container__content-item-description">
                                
                            </div>
                        </div>
                    </div>
                    
                        <div class="grid__column-6">
                            <form action="item_cart.php" method="post" style="width: 100%;">
                                <div class="container__content-mid">
                                    <div class="container__content-name">
                                        <h3><?php echo $row['Description'] ?></h3>
                                    </div>
                                    <div class="container__content-description">
                                        <div class="container__content-description-brand">Thương hiệu: <?php echo $row['Brand'] ?></div>
                                        <div class="container__content-description-id">Mã Sản Phẩm: <?php echo $row['Product_id'] ?></div>
                                    </div>
                                    <div class="container__content-price"><?php echo number_format($row['Price_dropped'],0,",")?> đ</div>
                                    <div class="container__content-discount">
                                        <div class="container__content-price-dropped"><?php echo number_format($row['Price'],0,",") ?> đ</div>
                                        <div class="container__content-price-percen"><?php 
                                                                        $Price_droppedd = floatval($row['Price_dropped']); 
                                                                        $Pricee = floatval($row['Price']);
                                                                        if($Price === 0){
                                                                            echo "nothing";
                                                                        }else
                                                                            echo number_format((100 -($Price_droppedd / $Pricee) * 100),2) . '%';
                                                                    ?></div>
                                    </div>
                                    <div class="container__content-btn-buy--numb">
                                        Nhập số lượng  
                                    <select class="product-name--input" name="number" >
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        
                                    </select>
                                        <!-- <input type="number" class="container__content-btn-buy--nub" name="number"> -->
                                        <input type="hidden" name="id" value="<?php echo $row['Product_id'] ?>">
                                    </div>
                                    <div class="container__content-btn-buy">
                                        <button class="text-decoration-none container__content-btn-buy-link" style="width: 100%;" >Thêm Vào Giỏ hàng</button>
                                        <!-- <a href="" class="text-decoration-none container__content-btn-buy-link">Thêm Vào Giỏ hàng</a> -->
                                    </div>
                                    <div class="container__content-promotion">
                                        <h3>Khuyến mãi liên quan</h3>
                                        <li class="container__content-promotionn-description">Nhập mã PVAMD500 giảm <span>500.000đ</span> cho đơn hàng có sản phẩm này</li>
                                        <li class="container__content-promotionn-description">Giảm thêm đến <span>300.000đ</span> dành cho Học sinh - sinh viên</li>
                                        <li class="container__content-promotionn-description">Nhập mã <span>QRPV9</span> khi thanh toán qua VNPAY-QR
                                            <ul>
                                                <li>- Giảm <span>50.000đ</span> cho đơn từ <span>2,500,000đ</span></li>
                                                <li>- Giảm <span>100.000đ</span> cho đơn từ <span>5,000,000đ</span></li>
                                                <li>- Giảm <span>100.000đ</span> cho đơn từ <span>15,000,000đ</span></li>
                                            </ul>
                                        </li>
                                        <li class="container__content-promotionn-description">Nhập mã PHONGVU200 giảm thêm đến <span>200.000đ</span> khi thanh toán qua ZaloPay</li>
                                        <li class="container__content-promotionn-description">Nhập mã SacomPV
                                            <ul>
                                                <li>1. Tặng ngay <span>500.000đ</span> cho mỗi giao dịch thành công từ <span>10,000,000đ</span></li>
                                                <li>2. Tặng ngay <span>200.000đ</span> cho mỗi giao dịch thành công từ <span>5,000,000đ</span> khi</li>
                                            </ul>
                                        </li>
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                    <div class="grid__column-3">
                        <div class="container__content-company">
                            <div class="container__content-company-name">Công Ty Cổ Phần CTA</div>
                            <div class="container__content-company-policy"><h3>Chính sách bán hàng</h3></div>
                            <div class="container__content-company-policy"><i class="fa-solid fa-truck-fast"></i> Miễn phí giao hàng cho đơn hàng từ 5 triệu </div>
                            <div class="container__content-company-policy"><i class="fa-solid fa-shield"></i> Cam kết hàng chính hãng 100% </div>
                            <div class="container__content-company-policy"><i class="fa-solid fa-arrows-rotate"></i> Đổi trả trong vòng 10 ngày</div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- footer -->
        <footer class="footer">
            <div class="grid">
                <div class="footer__nav">
            
                    <div class="footer__nav-description">
                        <div class="footer__nav-description-title">Hỗ Trợ Khách Hàng</div>
                        <li><a href="" class="footer__nav-subnav">Thẻ ưu đãi</a></li>
                        <li><a href="" class="footer__nav-subnav">Hướng dẫn mua online</a></li>
                        <li><a href="" class="footer__nav-subnav">Chính sách trả góp</a></li>
                        <li><a href="" class="footer__nav-subnav">Dịch vụ sửa chữa</a></li>
                        <li><a href="" class="footer__nav-subnav">Ưu đãi dành cho doang nghiệp</a></li>
                    </div>
                    <div class="footer__nav-description">
                        <div class="footer__nav-description-title">Chính Sách Mua Hàng</div>
                        <li><a href="" class="footer__nav-subnav">Điều kiện giao dịch chung</a></li>
                        <li><a href="" class="footer__nav-subnav">Chính sách bảo bành</a></li>
                        <li><a href="" class="footer__nav-subnav">Chính sách đổi trả</a></li>
                        <li><a href="" class="footer__nav-subnav">Chính sách thanh toán</a></li>
                        <li><a href="" class="footer__nav-subnav">Giao hàng và lắp đặt tại nhà</a></li>
                    </div>
                    <div class="footer__nav-description">
                        <div class="footer__nav-description-title">Thông tin Store CTA</div>
                        <li><a href="" class="footer__nav-subnav">Giới thiệu CTA</a></li>
                        <li><a href="" class="footer__nav-subnav">Hệ thống cửa hàng</a></li>
                        <li><a href="" class="footer__nav-subnav">Trung tâm bảo hành</a></li>
                        <li><a href="" class="footer__nav-subnav">Chính sách bảo mật</a></li>
                        <li><a href="" class="footer__nav-subnav">Tin công nghệ</a></li>
                        <li><a href="" class="footer__nav-subnav">Tuyển dụng</a></li>
                    </div>
                    <div class="footer__nav-description">
                        <div class="footer__nav-description-title">Cộng đồng</div>
                        <li><a href="" class="footer__nav-subnav">Gọi mua hàng (Miễn phí): 19001001</a></li>
                        <li><a href="" class="footer__nav-subnav">Gọi chăm sóc khách hàng : 19001002</a></li>
                        <li><a href="" class="footer__nav-subnav"><i class="fa-brands fa-facebook"></i></i> Facebook: CTA</a></li>
                        <li><a href="" class="footer__nav-subnav"><i class="fa-brands fa-youtube"></i> Youtube: CTA_Store</a></li>
                        <li><a href="" class="footer__nav-subnav"><i class="fa-brands fa-instagram"></i> IG: CTA_IG</a></li>
                    </div>
                    <div class="footer__nav-description">
                        <div class="footer__nav-description-title">Email liên hệ</div>
                        <div class="email-fooder">
                            <li><a href="" class="footer__nav-subnav">Hỗ trợ khách hàng: </a></li>
                        </div>
                        <div class="email-fooder">
                            <li><a href="" class="footer__nav-subnav">Liên hệ báo giá: </a></li>
                        </div>
                        <div class="email-fooder">
                            <li><a href="" class="footer__nav-subnav">Hợp tác phát triển: </a></li>
        
                        </div>
                    </div>
                </div>
                <div class="footer__payment">
                    <div class="footer__payment-nav">
                        <div class="footer__payment-subnav">
                            <div class="footer__nav-description-title">Phương thức thanh toán</div>
        
                            <div class="footer__payment-subnav-items">
                                <div class="footer__payment-subnav-item">
                                    <div class="footer__payment-subnav-content"><i class="footer__payment-subnav-icon fa-solid fa-qrcode"></i> QR Code</div>
                                </div>
                            </div>
        
                            <div class="footer__payment-subnav-items">
                                <div class="footer__payment-subnav-item">
                                    <div class="footer__payment-subnav-content"><i class="footer__payment-subnav-icon fa-solid fa-money-bill"></i> Tiền mặt</div>
                                </div>
                            </div>
                            <div class="footer__payment-subnav-items">
                                <div class="footer__payment-subnav-item">
                                    <div class="footer__payment-subnav-content"><i class="footer__payment-subnav-icon fa-solid fa-money-bill-transfer"></i> Trả góp</div>
                                </div>
                            </div>
                            <div class="footer__payment-subnav-items">
                                <div class="footer__payment-subnav-item">
                                    <div class="footer__payment-subnav-content"><i class="footer__payment-subnav-icon fa-solid fa-piggy-bank"></i> Internet banking</div>
                                </div>
                            </div>
                        </div>
                        <div class="footer__payment-subnav-img">
                            <div class="footer__nav-description-title">Phương thức thanh toán</div>
                            <div>
                                <img src="assets/img/footer/vnpay_banks.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__company">
                <div class="footer__company-nav grid">
                    <div class="footer__company-copyright">
                        <div class="footer__company-title">CÔNG TY CỔ PHẦN THƯƠNG MẠI - DỊCH VỤ CTA</div>
                        <div class="footer__nav-subnav"><i class="fa-regular fa-copyright"></i> Giấy chứng nhận đăng ký doanh nghiệp:</div>
                        <div class="footer__nav-subnav">0304998358 do Sở KH-ĐT TP.HCM cấp lần đầu ngày 30 tháng 05 năm 2007</div>
                    </div>
                    <div class="footer__company-adress">
                        <div class="footer__company-title">Địa chỉ trụ sở chính</div>
                        <div class="footer__nav-subnav">Tầng 5, Số 117-119-121 Nguyễn Du, Phường Bến Thành, Quận 1, Thành Phố Hồ Chí Minh</div>
                        <div class="footer__company-title">Địa chỉ văn phòng điều hành</div>
                        <div class="footer__nav-subnav">Tầng 6, Số 1 Phố Thái Hà, Phường Trung Liệt, Quận Đống Đa, Hà Nội</div>
                    </div>
                    <div class="footer__company-certificate">
                        <div><img src="assets/img/footer/da-dang-ky.png" alt=""></div>
                        <div><img src="assets/img/footer/dmca-badge-w100-2x1-02.png" alt=""></div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>
</html>