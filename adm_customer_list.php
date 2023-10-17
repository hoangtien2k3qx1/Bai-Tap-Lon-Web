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
	$sql_select_hangsx="SELECT * FROM `customer`";
	$result_se_hang=mysqli_query($conn,$sql_select_hangsx);
	$tong_bg=mysqli_num_rows($result_se_hang);// dem so ban ghi
	//echo $tong_bg; die;
	
	$stt=0;
	while($row=mysqli_fetch_object($result_se_hang)){
		$stt++;
    $Customer_id[$stt] = $row-> Customer_id;
    $Customer_name[$stt] = $row-> Customer_name ;
    $Customer_phonenumber[$stt] = $row-> Customer_phonenumber;
    $Customer_email[$stt] = $row-> Customer_email;
    $Customer_address[$stt] = $row-> Customer_address;

	}
	
	?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/base.css">
  <link rel="stylesheet" href="./assets/css/adm_productlist.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
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
          <table width="200" border="1" style="border-collapse: collapse;" >
            <tbody class="container__table" style="text-aline: center;" >
              <tr>
                <td colspan="8" class="container__table-title">Danh Sách Khách Hàng</td>
              </tr>
              <tr>
                <td style="padding: 3px; text-align: center;">Stt</td>
                <td class="container__table-description">Customer_id</td>
                <td class="container__table-description">Customer_name</td>
                <td class="container__table-description">phoneNumber</td>
                <td class="container__table-description">Email</td>
                <td class="container__table-description">Customer_address</td>
                <td class="container__table-description">Option</td>
              </tr>

              <?php
                for($i=1;$i<=$tong_bg;$i++)
                {
		          ?>
              <tr>
                <td style="padding: 3px; text-align: center;"><?php echo $i ?></td>
                <td class="container__table-description"><?php echo $Customer_id[$i] ?></td>
                <td class="container__table-description"><?php echo $Customer_name[$i] ?></td>
                <td class="container__table-description"><?php echo $Customer_phonenumber[$i] ?></td>
                <td class="container__table-description"><?php echo $Customer_email[$i] ?></td>
                <td class="container__table-description"><?php echo $Customer_address[$i] ?></td>
                <td class="container__table-description-btn">
                  <a class="container__table-description--btn" href="adm_customer_update.php?cid=<?php echo $Customer_id[$i] ?>">Sửa</a> 
                  <a class="container__table-description--btn" onclick="return confirm('Bạn có chắc muốn xóa mặt hàng ?');" href="adm_customer_delete.php?cid=<?php echo $Customer_id[$i] ?>">Xóa</a>
                  <a class="container__table-description--btn" href="adm_orderlist.php?cid=<?php echo $Customer_id[$i] ?>">Xem đơn hàng</a>
                </td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
          <button id="export-button_product" class="btn" style="margin: 10px 10px 0 0; text-align: center;">
            Xuất EXCEL
          </button>
          <script src="./assets/js/excel_order_list.js"></script>
        </div>
      </div>

    </div>
  </div>

</body>
</html>
