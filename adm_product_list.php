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
	$sql_select_hangsx="SELECT * FROM `product`";
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
  <link rel="stylesheet" href="./assets/css/base.css">
  <link rel="stylesheet" href="./assets/css/adm_productlist.css">
  <title>Document</title>
</head>
<body>
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
              <a href="#" class="container__menu-link">Danh Sách Sản Phẩm</a>
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
          <table width="200" border="1" style="border-collapse: collapse;" >
            <tbody class="container__table">
              <tr>
                <td colspan="10" class="container__table-title">Danh Sách Sản phẩm</td>
              </tr>
              <tr>
                <td class="container__table-description">Stt</td>
                <td class="container__table-description">Product_id</td>
                <td class="container__table-description">Brand</td>
                <td class="container__table-description">Product_name</td>
                <td class="container__table-description">Type</td>
                <td class="container__table-description">Description</td>
                <td class="container__table-description">Price</td>
                <td class="container__table-description">Prince_dropped</td>
                <td class="container__table-description">Product_img</td>
                <td class="container__table-description">Option</td>
              </tr>

              <?php
                for($i=1;$i<=$tong_bg;$i++)
                {
		          ?>
              <tr>
                <td class="container__table-description"><?php echo $i ?></td>
                <td class="container__table-description"><?php echo $Product_id[$i] ?></td>
                <td class="container__table-description"><?php echo $Product_name[$i] ?></td>
                <td class="container__table-description"><?php echo $Brand[$i] ?></td>
                <td class="container__table-description"><?php echo $product_type[$i] ?></td>
                <td class="container__table-description"><?php echo $Description[$i] ?></td>
                <td class="container__table-description"><?php echo number_format($Price[$i]) .' đ' ?></td>
                <td class="container__table-description"><?php echo number_format($Price_dropped[$i]) .' đ' ?></td>
                <td class="container__table-description-img"><img src="image/<?php echo $uploadDir_img_logo[$i] ?>" alt=""></td>
                <td class="container__table-description-btn">
                  <a  class="container__table-description--btn" href="adm_product_update.php?id=<?php echo $Product_id[$i];?>">Sửa</a>
                  <a  class="container__table-description--btn" onclick="return confirm('Bạn có chắc muốn xóa mặt hàng ?');" href="adm_product_delete.php?id=<?php echo $Product_id[$i];?>">Xóa</a></td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

</body>
</html>
