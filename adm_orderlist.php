
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
          <table width="200" border="1" style="border-collapse: collapse;">
            <tbody class="container__table">
                <!-- <div class="container__search">
                  <input type="text" class="container__search__input" placeholder="Nhập Tên(id) để tìm kiếm khách hàng...">
                  <button class="btn container__search__btn">Search</button>
                </div> -->
              <tr>
                <td colspan="12" class="container__table-title">Danh Sách Đơn hàng</td>
              </tr>
              <tr>
                <td style="padding: 3px; text-align: center;" >Stt</td>
                <td class="container__table-description">Product_id</td>
                <td class="container__table-description">Description</td>
                <td style="padding: 3px; text-align: center;">Order_quantity</td>
                <td class="container__table-description">Total_price</td>
                <td style="padding: 3px; text-align: center;">Order_id</td>
                <td class="container__table-description">Order_date</td>
                <td style="padding: 3px; text-align: center;">Customer_id</td>
                <td class="container__table-description">Customer_name</td>
                <td class="container__table-description">Customer_phone</td>
                <td class="container__table-description">Address</td>
                <td class="container__table-description">Option</td>
              </tr>



              <?php                        
                  if(isset($_GET['cid'])){
                      $cid = $_GET['cid'];
                      if($cid == ""){
                          $sql_select_hangsx = "SELECT * FROM `orders`";
                          $result_se_hang = mysqli_query($conn, $sql_select_hangsx);
                          $tong_bg = mysqli_num_rows($result_se_hang); // dem so ban ghi
                      }else {
                          $sql_select_hangsx="SELECT * FROM `orders` WHERE Customer_id in ('$cid')";
                          $result_se_hang=mysqli_query($conn,$sql_select_hangsx);
                          $tong_bg=mysqli_num_rows($result_se_hang);// dem so ban ghi
                      }
                  }
                  else
                  {
                      $sql_select_hangsx = "SELECT * FROM `orders`";
                      $result_se_hang = mysqli_query($conn, $sql_select_hangsx);
                      $tong_bg = mysqli_num_rows($result_se_hang); // dem so ban ghi
                  }

                $stt=0;
                while ($row = mysqli_fetch_object($result_se_hang)) {
                  $stt++;
                  $Order_id[$stt] = $row->Order_id;
                  $dateTime = new DateTime($row->Order_date);
                  $Order_date[$stt] = $dateTime->format('Y-m-d H:i:s');
                  $Customer_id[$stt] = $row->Customer_id;
                  $Product_id[$stt] = $row->Product_id;
                  $Number[$stt] = $row->Number;
                }             
              ?>


              <?php
                for($i=1;$i<=$tong_bg;$i++)
                {
		          ?>

              <?php
                $query = "SELECT * FROM `customer` WHERE Customer_id = '$Customer_id[$i]'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result); //hien thi len form
              ?>

              <?php
                $query2 = "SELECT * FROM `product` WHERE Product_id = '$Product_id[$i]'";
                $result2 = mysqli_query($conn, $query2);
                $row2 = mysqli_fetch_assoc($result2); //hien thi len form
              ?>
              <tr>
                <td style="padding: 3px; text-align: center;"><?php echo  $i ?> </td>
                <td class="container__table-description"><?php echo $Product_id[$i] ?></td>
                <td class="container__table-description container__table-sub-description"><?php echo $row2['Description'] ?></td>
                <td style="padding: 3px; text-align: center;"><?php echo  $Number[$i] ?></td>
                <td class="container__table-description">
                                  <?php 
                                      $Price_droppedd = floatval($row2['Price_dropped']); 
                                      $Numberr = floatval($Number[$i]);
                                          if($Numberr === 0){
                                          echo "nothing";
                                           }else
                                    echo number_format(($Price_droppedd * $Numberr),2) . ' đ';
                                                                    ?>
                </td>
                <td style="padding: 3px; text-align: center;"><?php echo $Order_id[$i] ?></td>
                <td class="container__table-description"><?php echo $Order_date[$i] ?> </td>
                <td style="padding: 3px; text-align: center;"><?php echo $Customer_id[$i] ?></td>
                <td class="container__table-description"><?php echo  $row['Customer_name'] ?></td>
                <td class="container__table-description"><?php echo '0'.$row['Customer_phonenumber']?></td>
                <td class="container__table-description"><?php echo $row['Customer_address']?></td>
                <td class="container__table-description-btn">
                    <a  class="container__table-description--btn" href="adm_order_update.php?sid=<?php echo $Order_id[$i] ?>">Sửa</a>
                    <a  class="container__table-description--btn" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng ?');" href="adm_order_delete.php?id=<?php echo $Order_id[$i] ?>">Xóa</a>
                </td>
              </tr>
              <?php
                }
              ?>     
            </tbody>
          </table>
          <button class="btn" style="margin: 10px 10px 0 0; text-align: center;">
            <a href="adm_order_delete.php?cid=<?php echo $cid ?>" >Gửi hàng</a>
          </button>
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
