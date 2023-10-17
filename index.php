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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
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
                                    <a href="items.php?Type= " class="header__notify-footer-btn">Xem tất cả</a>
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
                        <li class="header__navbar-item--login header__navbar-item header__navbar-item--strong"><a href="login.php">Đăng nhập</a></li>
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
                    <a href="cart.php"><i class="header__cart-icon fas fa-shopping-cart"></i></a>
                    </div>
                </div>
            </div>
        </header>

        <div class="container">
            <div id="container__slider">
                <div class="grid__full-width">
                    
                    <div class="container__slider-center grid">
                        <div class="container__slider-center-grid">
                            <div class="container__slider-list">
                                <ul class="container__slider-list-item">
                                    <li><a href="items.php?Type=Điện thoại" class="container__slider-list-text text-decoration-none"><i class= "container__slider-icon fa-solid fa-mobile"></i> Điện thoại </a></li>
                                    <li><a href="items.php?Type=Laptop" class="container__slider-list-text text-decoration-none"><i class="container__slider-icon fa-solid fa-laptop"></i></i> Laptop </a></li>
                                    <li><a href="items.php?Type=PC" class="container__slider-list-text text-decoration-none"><i class= "container__slider-icon fa-solid fa-desktop"></i> PC </a></li>
                                    <li><a href="items.php?Type=Phụ kiện" class="container__slider-list-text text-decoration-none"><i class= "container__slider-icon fa-solid fa-wrench"></i> Linh kiện </a></li>
                                </ul>
                            </div>
         
                            <div id="container__slider-discount">
                                <div class="container__slider-discount-item">
                                    <img src="assets/img/Slide1/Sale_1.webp" alt="sale" class="container__slider-item-img">
                                </div> 
                                <div class="container__slider-discount-item">
                                    <img src="assets/img/Slide1/Sale_1.webp" alt="sale" class="container__slider-item-img">
                                </div>
                            </div>
                        </div>
                        </div>
    
                    <div class="container__slider-mySlides fade">
                        <div class="container__slider-numbertext">1 / 6</div>
                        <img src="assets/img/slider/unnamed (1).webp" style="width:100%">
                    </div>
                        
                    <div class="container__slider-mySlides fade">
                        <div class="container__slider-numbertext">2 / 6</div>
                        <img src="assets/img/slider/unnamed (2).webp" style="width:100%">
                    </div>
                        
                    <div class="container__slider-mySlides fade">
                        <div class="container__slider-numbertext">3 / 6</div>
                        <img src="assets/img/slider/unnamed (3).webp" style="width:100%">
                    </div>
                    
                    <div class="container__slider-mySlides fade">
                        <div class="container__slider-numbertext">4 / 6</div>
                        <img src="assets/img/slider/unnamed (4).webp" style="width:100%">
                    </div>  
    
                    <div class="container__slider-mySlides fade">
                        <div class="container__slider-numbertext">5 / 6</div>
                        <img src="assets/img/slider/unnamed(5).webp" style="width:100%">
                    </div>  
    
                    <div class="container__slider-mySlides fade">
                        <div class="container__slider-numbertext">6 / 6</div>
                        <img src="assets/img/slider/unnamed (6).webp" style="width:100%">
                    </div>  
                    
                    
                    <div class="container__slider-dots">
                        <span class="container__slider-dot"></span> 
                        <span class="container__slider-dot"></span> 
                        <span class="container__slider-dot"></span>
                        <span class="container__slider-dot"></span> 
                        <span class="container__slider-dot"></span> 
                        <span class="container__slider-dot"></span>  
                    </div>
                    <div id="container__slider-supper-discount">
                        <div class="container__slider-supper-discount-items">
                            <li><a href=""><img src="assets/img/foot_slide/2.webp" alt="" class="container__slider-supper-discount-img"></a></li>
                            <li><a href=""><img src="assets/img/foot_slide/1.webp" alt="" class="container__slider-supper-discount-img"></a></li>
                            <li><a href=""><img src="assets/img/foot_slide/3.webp" alt="" class="container__slider-supper-discount-img"></a></li>
                            <li><a href=""><img src="assets/img/foot_slide/4.webp" alt="" class="container__slider-supper-discount-img"></a></li>
                        </div>
                    </div>
                </div>    
                
                
                 <script src="./assets/js/script.js"></script>
            </div>

            <div id="container__flast-deal">
                <div class="grid">
                    <div class="container__flast-deal-center">
                        

                        <div class="container__flast-deal-time">
                            <p id="flast-deal-time"></p>
                        </div>


                        <div class="container__flast-deal-products">
                        <?php
                            for($i=1;$i<=$tong_bg;$i++){
                        ?> 
                            <div class="container__flast-deal-item">
                                <a href="item.php?id=<?php echo $Product_id[$i];?>" class="container__flast-deal-link text-decoration-none">
                                <div class="container__flast-deal-header">
                                    <img src="image/<?php echo  $uploadDir_img_logo[$i]?>" alt="" class="container__flast-deal-content-img">
                                </div>
                                <div class="container__flast-deal-contant">
                                    <div class="container__flast-deal-name">
                                        <h3><?php echo $Product_name[$i];?></h3>
                                    </div>                            
                                    <div class="container__flast-deal-description">
                                        <h3><?php echo $Description[$i];?></h3>
                                    </div>
                                    <div class="container__flast-deal-price">
                                        <div class="container__flast-deal-price-discounted">
                                            <h3><?php echo number_format($Price_dropped[$i],0,",")?> đ</h3>
                                        </div>
                                        <div class="container__flast-deal-price-discount">
                                            <div class="container__flast-deal-price-undiscounted"><?php echo number_format($Price[$i],0,",") ?> đ</div>
                                            <div class="container__flast-deal-price-discounted-percent"><?php 
                                                                $Price_droppedd = floatval($Price_dropped[$i]); 
                                                                $Pricee = floatval($Price[$i]);
                                                                if($Price === 0){
                                                                    echo "nothing";
                                                                }else
                                                                    echo number_format((100 -($Price_droppedd / $Pricee) * 100),2) . '%';
                                                            ?></div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        <?php
                            }
                        ?> 

                        </div>

                        

                    </div>
                </div>
                <script src="./assets/js/script.js"></script>
            </div>

            <div id="container__category">
                <div class="grid">
                    <div class="container__category-title"><p>CÁC SẢN PHẨM NỔI BẬT</p></div>
                    <div class="container__category-items">
                        <div class="container__category_item">
                            <a href="items.php?Type=Ipad" class="text-decoration-none">
                                <img src="assets/img/Star-category/ipad.webp" alt="" class="container__category_item-img">
                                <p>Ipad</p> 
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Iphone" class="text-decoration-none">
                                <img src="assets/img/Star-category/iphone.webp" alt="" class="container__category_item-img">
                                <p>Iphone</p> 
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=CPU" class="text-decoration-none">
                                <img src="assets/img/Star-category/cpu.webp" alt="" class="container__category_item-img">
                                <p>CPU</p>
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Card màn hình" class="text-decoration-none">
                                <img src="assets/img/Star-category/card.webp" alt="" class="container__category_item-img">
                                <p>Card màn hình</p>
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Bàn phím" class="text-decoration-none">
                                <img src="assets/img/Star-category/keyboard.webp" alt="" class="container__category_item-img">
                                <p>Bàn phím</p>
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Laptop" class="text-decoration-none">
                                <img src="assets/img/Star-category/laptop.webp" alt="" class="container__category_item-img">
                                <p>Laptop</p>
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Loa" class="text-decoration-none">
                                <img src="assets/img/Star-category/loa.webp" alt="" class="container__category_item-img">
                                <p>Loa</p>
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Macbook" class="text-decoration-none">
                                <img src="assets/img/Star-category/mac.webp" alt="" class="container__category_item-img">
                                <p>Macbook</p>
                            </a>
                        </div>

                        <div class="container__category_item">
                            <a href="items.php?Type=Ổ cứng" class="text-decoration-none">
                                <img src="assets/img/Star-category/main.webp" alt="" class="container__category_item-img">
                                <p>Ổ cứng</p> 
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Màn hình" class="text-decoration-none">
                                <img src="assets/img/Star-category/man_hinh.webp" alt="" class="container__category_item-img">
                                <p>Màn hình</p> 
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Chuột" class="text-decoration-none">
                                <img src="assets/img/Star-category/mouse.webp" alt="" class="container__category_item-img">
                                <p>Chuột</p>
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=PC" class="text-decoration-none">
                                <img src="assets/img/Star-category/pc.webp" alt="" class="container__category_item-img">
                                <p>PC</p>
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Điện thoại" class="text-decoration-none">
                                <img src="assets/img/Star-category/phone.webp" alt="" class="container__category_item-img">
                                <p>Điện thoại</p>
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Phụ kiện" class="text-decoration-none">
                                <img src="assets/img/Star-category/phu_kien.webp" alt="" class="container__category_item-img">
                                <p>Phụ kiện</p>
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Ram" class="text-decoration-none">
                                <img src="assets/img/Star-category/ram.webp" alt="" class="container__category_item-img">
                                <p>Ram</p>
                            </a>
                        </div>
                        <div class="container__category_item">
                            <a href="items.php?Type=Máy tính bảng" class="text-decoration-none">
                                <img src="assets/img/Star-category/maytinhbang.webp" alt="" class="container__category_item-img">
                                <p>Máy tính bảng</p>
                            </a>
                        </div>
                
                    </div>

                </div>
            </div>

            <div class="container__deal-product">
                <div class="grid">
                   <div class="container__deal-product-header">
                        <div class="container__deal-product-title" >
                           LAPTOP - Giá Chỉ Từ 9 Triệu <i class="ti-shopping-cart"></i>
                        </div>
                    </div>
                
                    <div class="container__deal-product-background">
                        <img src="assets/img/laptop/unnamed.png" alt="" class="container__deal-product-background-img">
                    </div>
                                            
                    <div class="container__deal-product-items">
<?php
    $sql_select_hangsx="SELECT * FROM `product` WHERE Type like 'Laptop' LIMIT 5";
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
                        <div class="container__deal-product-item">
                            <div class="container__deal-product-center">
                                <a href="item.php?id=<?php echo $Product_id[$i];?>" class="text-decoration-none">
                                    <div class="container__deal-product-center-header">
                                        <img src="image/<?php echo  $uploadDir_img_logo[$i]?>" alt="" class="container__deal-product-center-img">
                                    </div>
                                    <div class="container__deal-product-description">
                                        <div class="container__deal-product-description-name">
                                            <h3><?php echo $Product_name[$i];?></h3>
                                        </div>                            
                                        <div class="container__deal-product-description-product">
                                            <h3><?php echo $Description[$i];?></h3>
                                        </div>
                                        <div class="container__deal-product-description-price">
                                            <div class="container__deal-product-description-price-discounted">
                                                <h3><?php echo number_format($Price_dropped[$i],0,",")?> đ</h3>
                                            </div>
                                            <div class="container__deal-product-description-discount">
                                                <div class="container__deal-product-description-undiscounted"><?php echo number_format($Price[$i],0,",") ?> đ</div>
                                                <div class="container__deal-product-description-percent"><?php 
                                                                $Price_droppedd = floatval($Price_dropped[$i]); 
                                                                $Pricee = floatval($Price[$i]);
                                                                if($Price === 0){
                                                                    echo "nothing";
                                                                }else
                                                                    echo number_format((100 -($Price_droppedd / $Pricee) * 100),2) . '%';
                                                            ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                        </div>
                    </div>
                </div>
            </div>

<?php
    $sql_select_hangsx="SELECT * FROM `product` WHERE Type like 'Phụ kiện' LIMIT 5";
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
            <div class="container__deal-product">
                <div class="grid">
                   <div class="container__deal-product-header">
                        <div class="container__deal-product-title" >
                           LINH KIỆN - GIẢM ĐẾN 62% <i class="ti-shopping-cart"></i>
                        </div>
                    </div>
                
                    <div class="container__deal-product-background">
                        <img src="assets/img/laptop/unnamed (1).png" alt="" class="container__deal-product-background-img">
                    </div>
                                            
                    <div class="container__deal-product-items">
                
                    <?php
                        for($i=1;$i<=$tong_bg;$i++){
                    ?>
                        <div class="container__deal-product-item">
                            <div class="container__deal-product-center">
                                <a href="item.php?id=<?php echo $Product_id[$i];?>" class="text-decoration-none">
                                    <div class="container__deal-product-center-header">
                                        <img src="image/<?php echo  $uploadDir_img_logo[$i]?>" alt="" class="container__deal-product-center-img">
                                    </div>
                                    <div class="container__deal-product-description">
                                        <div class="container__deal-product-description-name">
                                            <h3><?php echo $Product_name[$i];?></h3>
                                        </div>                            
                                        <div class="container__deal-product-description-product">
                                            <h3><?php echo $Description[$i];?></h3>
                                        </div>
                                        <div class="container__deal-product-description-price">
                                            <div class="container__deal-product-description-price-discounted">
                                                <h3><?php echo number_format($Price_dropped[$i],0,",")?> đ</h3>
                                            </div>
                                            <div class="container__deal-product-description-discount">
                                                <div class="container__deal-product-description-undiscounted"><?php echo number_format($Price[$i],0,",") ?> đ</div>
                                                <div class="container__deal-product-description-percent"><?php 
                                                                $Price_droppedd = floatval($Price_dropped[$i]); 
                                                                $Pricee = floatval($Price[$i]);
                                                                if($Price === 0){
                                                                    echo "nothing";
                                                                }else
                                                                    echo number_format((100 -($Price_droppedd / $Pricee) * 100),2) . '%';
                                                            ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>

        </div>
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
