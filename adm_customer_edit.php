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
    $Customer_id = $_POST["id"];
    $Customer_name = $_POST["Customer_name"];
    $Customer_phonenumber = $_POST["Customer_phonenumber"];
    $Customer_email = $_POST["Customer_email"];
    $Customer_address = $_POST["Customer_address"];


    if($Customer_name == "" ||  $Customer_phonenumber == "" || $Customer_email == ""|| $Customer_address == "")
    {
        echo "bạn chưa điền đủ thông tin";
    }else{
        // Câu truy vấn thêm dữ liệu được lưu vào biến $sql_insert_hangxs
        $sql_insert_hangxs= "UPDATE `customer` 
        SET `Customer_name`='$Customer_name',`Customer_phonenumber`='$Customer_phonenumber',`Customer_address`='$Customer_address'
        WHERE `Customer_id` = '$Customer_id'";
            //echo $sql_insert_hangxs; die;
            // THực hiện truy vấn
        mysqli_query($conn,$sql_insert_hangxs);	 
        header('Location: adm_customer_list.php');
    }

?>
