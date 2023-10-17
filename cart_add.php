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
    $sql_select_hangsx = "SELECT `Customer_id` FROM `customer` WHERE `Customer_name` = '$Customer_name' AND `Customer_phonenumber` = '$Customer_phonenumber' AND `Customer_email` = '$Customer_email'";
	$result_se_hang=mysqli_query($conn,$sql_select_hangsx);
	$tong_bg=mysqli_num_rows($result_se_hang);// dem so ban ghi
    if($Customer_name == "" ||  $Customer_phonenumber == "" || $Customer_email == "" || $Customer_address == "")
    {
        echo "bạn chưa điền đủ thông tin";
    }else if($tong_bg > 0){
        $sql_select_hangsx="SELECT * FROM `cart`";
        $result_se_hang=mysqli_query($conn,$sql_select_hangsx);
        $tong_bg=mysqli_num_rows($result_se_hang);// dem so ban ghi o bang cart
        
        $stt=0;
        while($row=mysqli_fetch_object($result_se_hang)){
            //Lay Product_id va Number
            $stt++;
            $Product_id[$stt] = $row-> Product_id;
            $Number[$stt] = $row-> Number;
            
            //lay Customer_id 
            $sql_select_hangsx = "SELECT `Customer_id` FROM `customer` WHERE `Customer_name` = '$Customer_name' AND `Customer_phonenumber` = '$Customer_phonenumber' AND `Customer_email` = '$Customer_email'";

            $result = mysqli_query($conn, $sql_select_hangsx);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $Customer_id = $row['Customer_id'];
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }

            //Lay Order_date
            $Order_date=date("Y").date("m").date("d").date("H").date("i").date("s");

            //Them du lieu vao bang Order
            $sql_insert_hangxs="INSERT INTO `orders`
            (`Order_id`, `Order_date`, `Customer_id`, `Product_id`, `Number`) 
            VALUES ( NULL,'$Order_date','$Customer_id','$Product_id[$stt] ','$Number[$stt]')";
            // THực hiện truy vấn
            mysqli_query($conn,$sql_insert_hangxs);
        }
        mysqli_query($conn,"DELETE FROM `cart`");
    }
    else{
        //Them customer
        $sql_insert_hangxs="INSERT INTO `customer`
        (`Customer_id`, `Customer_name`, `Customer_phonenumber`, `Customer_email`, `Customer_address`) 
        VALUES ( NULL,'$Customer_name','$Customer_phonenumber','$Customer_email ','$Customer_address')";
        // THực hiện truy vấn
        mysqli_query($conn,$sql_insert_hangxs);


        $sql_select_hangsx="SELECT * FROM `cart`";
        $result_se_hang=mysqli_query($conn,$sql_select_hangsx);
        $tong_bg=mysqli_num_rows($result_se_hang);// dem so ban ghi o bang cart
        
        $stt=0;
        while($row=mysqli_fetch_object($result_se_hang)){
            //Lay Product_id va Number
            $stt++;
            $Product_id[$stt] = $row-> Product_id;
            $Number[$stt] = $row-> Number;
            
            //lay Customer_id 
            $sql_select_hangsx = "SELECT `Customer_id` FROM `customer` 
            WHERE `Customer_name` = '$Customer_name' AND `Customer_phonenumber` = '$Customer_phonenumber' AND `Customer_email` = '$Customer_email'";

            $result = mysqli_query($conn, $sql_select_hangsx);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $Customer_id = $row['Customer_id'];
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }

            //Lay Order_date
            $Order_date=date("Y").date("m").date("d").date("H").date("i").date("s");

            //Them du lieu vao bang Order
            $sql_insert_hangxs="INSERT INTO `orders`
            (`Order_id`, `Order_date`, `Customer_id`, `Product_id`, `Number`) 
            VALUES ( NULL,'$Order_date','$Customer_id','$Product_id[$stt] ','$Number[$stt]')";
            // THực hiện truy vấn
            mysqli_query($conn,$sql_insert_hangxs);
        }
        mysqli_query($conn,"DELETE FROM `cart`");
    }
    header('Location: cart.php');
?>
