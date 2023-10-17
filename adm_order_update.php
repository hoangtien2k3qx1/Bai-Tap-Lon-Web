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
<?php

	$Order_id= $_GET['sid'];

    $query = "Select * From orders Where Order_id = $Order_id";
    $result = mysqli_query($conn, $query);
    $row2 = mysqli_fetch_assoc($result); //hien thi len form
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
  <form name="product" action="adm_order_edit.php" method="POST" enctype="multipart/form-data">
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
            <div><h3>MÃ ĐƠN : <?php echo $row2['Order_id'] ?></h3></div>
            <input type="hidden" value="<?php echo $row2['Order_id'] ?> " name="Order_id" >
            
                <div class="container__input-product-name">
                    <div class="product-name">Mã Sản Phẩm :</div>
                    <select class="product-name--input" name="Product_id">
                    <option value="<?php echo $row2['Product_id'] ?>" selected><?php echo $row2['Product_id'] ?></option>
                    <?php
                        $sql_select_sx="SELECT * FROM `product`";
                        $result_se_=mysqli_query($conn,$sql_select_sx);
                        $tong_bg=mysqli_num_rows($result_se_);// dem so ban ghi
                        //echo $tong_bg; die;
                        
                        $stt=0;
                        while($row=mysqli_fetch_object($result_se_)){
                            $stt++;
                            $Product_idd[$stt] = $row-> Product_id;
                            $Descriptionn[$stt] = $row-> Description;
                        }
                        
                        ?>
                       <?php
                        for ($i = 1; $i <= $tong_bg; $i++) {
                            ?>
                            <option value="<?php echo $Product_idd[$i] ?>">
                                <?php echo $Product_idd[$i] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

              <div class="container__input-product-name">
                <div class="product-name">Số Lượng :</div>
                <select class="product-name--input" name="Number" >
                  <option value="<?php echo $row2['Number'] ?>"><?php echo $row2['Number'] ?></option>  
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                </select>
              </div>
              <button type="submit" class="product-name--submit"> Sửa lại đơn hàng </button>
            </div>
          </div>
        </div>
  
      </div>
    </div>
  </form>
</body>
</html>