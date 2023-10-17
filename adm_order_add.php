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
    // Lấy dữ liệu từ from adm_product_add.html
    $Customer_name = $_POST["Name"];
    $Customer_phonenumber = $_POST["Phonenumber"];
    $Customer_email = $_POST["Email"];
    $Customer_address = $_POST["Address"];
    $Product_id = $_POST["Product_id"];
    $Number = $_POST["Number"];


    $sql_select_hangsx = "SELECT `Customer_id` FROM `customer` 
    WHERE `Customer_name` = '$Customer_name' AND `Customer_phonenumber` = '$Customer_phonenumber' AND `Customer_email` = '$Customer_email'";
    
    $result_se_hang=mysqli_query($conn,$sql_select_hangsx);
    $tong_bg=mysqli_num_rows($result_se_hang);// dem so ban ghi

    // $result = mysqli_query($conn, $sql_select_hangsx);
    $row = mysqli_fetch_assoc($result_se_hang);
    $Customer_id = $row['Customer_id'];

    if($Customer_name == "" ||  $Customer_phonenumber == "" || $Customer_email == "" || $Customer_address == "")
    {
        echo "bạn chưa điền đủ thông tin";
    }else if($tong_bg > 0){
       
            //Lay Order_date
            $Order_date=date("Y").date("m").date("d").date("H").date("i").date("s");

            //Them du lieu vao bang Order
            $sql_insert_hangxs="INSERT INTO `orders`
            (`Order_id`, `Order_date`, `Customer_id`, `Product_id`, `Number`) 
            VALUES ( NULL,'$Order_date','$Customer_id','$Product_id','$Number')";
            // THực hiện truy vấn
            mysqli_query($conn,$sql_insert_hangxs);
        
    }
    else{
        //Them customer
        $sql_insert_hangxs="INSERT INTO `customer`
        (`Customer_id`, `Customer_name`, `Customer_phonenumber`, `Customer_email`, `Customer_address`) 
        VALUES ( NULL,'$Customer_name','$Customer_phonenumber','$Customer_email ','$Customer_address')";
        // THực hiện truy vấn
        mysqli_query($conn,$sql_insert_hangxs);


        $sql_select_hangsx = "SELECT `Customer_id` FROM `customer` 
        WHERE `Customer_name` = '$Customer_name' AND `Customer_phonenumber` = '$Customer_phonenumber' AND `Customer_email` = '$Customer_email'";

        $result = mysqli_query($conn, $sql_select_hangsx);
        $row = mysqli_fetch_assoc($result);
        $Customer_id = $row['Customer_id'];


                    //Lay Order_date
        $Order_date=date("Y").date("m").date("d").date("H").date("i").date("s");

                    //Them du lieu vao bang Order
        $sql_insert_hangxs="INSERT INTO `orders`
          (`Order_id`, `Order_date`, `Customer_id`, `Product_id`, `Number`) 
        VALUES ( NULL,'$Order_date','$Customer_id','$Product_id','$Number')";
                    // THực hiện truy vấn
        mysqli_query($conn,$sql_insert_hangxs);
    }
    header('Location: adm_orderadd.php');
?>
