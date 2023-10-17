<?php 
  session_start();
  if(!isset($_SESSION['User_name'])) {
    header("Location: login.php");
  }
?>
<?php
    $Customer_id = $_GET['cid'];
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

    $sql_delete_customer="DELETE FROM `customer` WHERE `Customer_id`='$Customer_id'";
	$result_se_customer=mysqli_query($conn,$sql_delete_customer);

    $sql_delete_customer="DELETE FROM `orders` WHERE `Customer_id`='$Customer_id'";
	$result_se_customer=mysqli_query($conn,$sql_delete_customer);
    header('Location: adm_customer_list.php');
	
?>
