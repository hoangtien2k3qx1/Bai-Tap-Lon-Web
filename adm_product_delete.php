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
    $Product_id = $_GET['id'];
    $sql_delete_hang="DELETE FROM `product` WHERE `Product_id`='$Product_id'";
	$result_se_hang=mysqli_query($conn,$sql_delete_hang);
    header('Location: adm_product_list.php');
	
?>
