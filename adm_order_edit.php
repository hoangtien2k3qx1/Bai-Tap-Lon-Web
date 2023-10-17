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
    $Product_id = $_POST["Product_id"];
    $Number = $_POST["Number"];
    $Order_id = $_POST["Order_id"];

    if($Product_id == "" ||  $Number == "" || $Order_id == "")
    {
        echo "bạn chưa điền đủ thông tin";
    }else{
            // Câu truy vấn thêm dữ liệu được lưu vào biến $sql_insert_hangxs
        $sql_insert_hangxs= "UPDATE `orders` 
        SET `Product_id`='$Product_id',`Number`='$Number'
         WHERE `Order_id` = '$Order_id'";
            //echo $sql_insert_hangxs; die;
            // THực hiện truy vấn
        mysqli_query($conn,$sql_insert_hangxs);	 
        header('Location: adm_orderlist.php');
    }

?>
