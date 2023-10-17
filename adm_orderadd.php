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
  <form name="product" action="adm_order_add.php" method="POST" enctype="multipart/form-data">
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
            <form action="cart_add.php" method="post"></form>
            <div class="container__input">
              <div class="container__input-product-name">
                <div class="product-name">Họ Và Tên :</div>
                <input type="text" class="product-name--input" name="Name">
              </div>
            
              <div class="container__input-product-name">
                <div class="product-name">Địa chỉ :</div>
                <input type="text" class="product-name--input" name="Address">
              </div>
  
              <div class="container__input-product-name">
                <div class="product-name">SĐT :</div>
                <input type="text" class="product-name--input" name="Phonenumber">
              </div>
      
              <div class="container__input-product-name">
                <div class="product-name">Email :</div>
                <input type="email" class="product-name--input" name="Email">
              </div>    
              
              
              <?php
              $Type = "";
              if ($_SERVER["REQUEST_METHOD"] == "GET") {
                  if (isset($_GET['id'])) {
                      $Type = $_GET['id'];
                  }
              }

              $sql_select_hangsx = "SELECT * FROM `product`";
              if (!empty($Type)) {
                  $sql_select_hangsx .= " WHERE Product_id = '$Type'";
              }

              $result_se_hang = mysqli_query($conn, $sql_select_hangsx);
              $tong_bg = mysqli_num_rows($result_se_hang);

              $stt = 0;
              while ($row = mysqli_fetch_object($result_se_hang)) {
                  $stt++;
                  $Product_id[$stt] = $row->Product_id;
                  $Product_name[$stt] = $row->Product_name;
                  $Description[$stt] = $row->Description;
                  $Price_dropped[$stt] = $row->Price_dropped;
              }

              $ds = "";
              if ($tong_bg > 0) {
                  $ds = $Description[1];
                  $pr = $Product_id[1];
              }
              ?>


                <?php
                  $sql_select_sx="SELECT * FROM `product`";
                  $result_se_=mysqli_query($conn,$sql_select_sx);
                  $tong_bg=mysqli_num_rows($result_se_);// dem so ban ghi
                  //echo $tong_bg; die;
                  
                  $stt=0;
                  while($row=mysqli_fetch_object($result_se_)){
                    $stt++;
                    $Product_idd[$stt] = $row-> Product_id;
                  }
                  
                  ?>
                <div class="container__input-product-name">
                    <div class="product-name">Mã Sản Phẩm :</div>
                    <select class="product-name--input" name="Product_id" onchange="navigateToAdmOrderAdd(this.value)">
                        <option value="<?php echo $pr ?>" selected><?php echo $pr ?></option>
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

                <script>
                function navigateToAdmOrderAdd(productId) {
                    window.location.href = "adm_orderadd.php?id=" + productId;
                }
                </script>
                
              <div class="container__input-product-name">
                <div class="product-name">Mô tả :</div>
                <input type="text" class="product-name--input" name="Description" value="<?php echo $ds?>">
              </div> 

              <div class="container__input-product-name">
                <div class="product-name">Số Lượng :</div>
                <select class="product-name--input" name="Number" >
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                </select>
              </div>

              <!-- <div class="container__input-product-name">
                <div class="product-name">Tổng giá :</div>
                <input type="text" class="product-name--input" name="Total_sale">
              </div>  -->
      
              <button type="submit" class="product-name--submit"> Thêm Hàng Vào Đơn Hàng </button>
            </div>
          </div>
        </div>
  
      </div>
    </div>
  </form>
</body>
</html>
