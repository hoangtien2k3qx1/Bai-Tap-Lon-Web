<?php 
  session_start();
  if(!isset($_SESSION['User_name'])) {
    header("Location: login.php");
  }
?>
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
  <link rel="stylesheet" href="./assets/css/base.css">
  <link rel="stylesheet" href="./assets/css/productadd.css">
  <title>Document</title>
</head>
<body>
  <form name="product" action="adm_product_add.php" method="POST" enctype="multipart/form-data">
  <div class="header">
    <div class="grid">
      <div class="header__title">
        <h3>CTA MANEGER</h3>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="grid">
      <div class="container__center">

        <div class="grid__column-2">
          <div class="container__menu">
            <h2 class="container__menu-title">Danh mục</h2>
            <div class="container__menu-descreption">
              <h3>Quản lý Sản Phẩm :</h3>
              <a href="adm_productadd.php" class="container__menu-link">Thêm Sản Phẩm</a> <br>
              <a href="adm_product_list.php" class="container__menu-link">Danh Sách Sản Phẩm</a>
            </div>
            <div class="container__menu-descreption">
              <h3>Quản lý đơn hàng :</h3>
              <a href="adm_orderadd.php" class="container__menu-link">Thêm Đơn Hàng </a> <br>
              <a href="adm_orderlist.php" class="container__menu-link">Danh Sách Đơn Hàng</a>
            </div>
            <div class="container__menu-descreption">
              <h3>Quản lý khách hàng :</h3>
              <a href="adm_customer_list.php" class="container__menu-link">Danh Sách Khách </a>
            </div>
            <div class="container__menu-descreption-home">
              <a href="adm_logout.php"><h3> > Trở Lại Trang Chủ <</h3></a>
            </div>
          </div>
        </div>
  
        <div class="grid__column-10">
          <div class="container__input">
            <div class="container__input-product-name">
              <div class="product-name">Nhập Tên Sản Phẩm :</div>
              <input type="text" class="product-name--input" name="Product_Name">
            </div>
    
            <div class="container__input-product-name">
              <div class="product-name">Loại hàng :</div>
              <select class="product-name--input" name="Product_Type" >
                <option value="Phụ kiện">Phụ kiện</option>
                <option value="Điện thoại">Điện thoại</option>
                <option value="Laptop">Laptop</option>
                <option value="PC">PC</option>
                <option value="Iphone">Iphone</option>
                <option value="Máy tính bảng">Máy tính bảng</option>
                <option value="Màn hình">Màn hình</option>
              </select>
            </div>
    
            <div class="container__input-product-name">
              <div class="product-name">Nhập Hãng :</div>
              <input type="text" class="product-name--input" name="Brand">
            </div>

            <div class="container__input-product-name">
              <div class="product-name">Nhập Mô Tả :</div>
              <input type="text" class="product-name--input" name="Product_Description">
            </div>
    
            <div class="container__input-product-name">
              <div class="product-name">Nhập Giá Đã Giảm :</div>
              <input type="text" class="product-name--input" name="Product_Price_dropped">
            </div>
    
            <div class="container__input-product-name">
              <div class="product-name">Nhập Tên Giá Gốc :</div>
              <input type="text" class="product-name--input" name="Product_Price">
            </div>
    
            <div class="container__input-product-name">
              <div class="product-name">Nhập Ảnh Sản Phẩm :</div>
              <input type="file" class="product-name--input" name="img_logo">
            </div>
    
            <button type="submit" class="product-name--submit"> Thêm Hàng Vào Gian Hàng </button>
          </div>
        </div>
      </div>

    </div>
  </div>
</form>
</body>
</html>
