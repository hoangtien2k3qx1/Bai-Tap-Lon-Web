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
    $Product_id = $_POST['id'];
    $Number = $_POST['number'];

    $sql_select_item ="SELECT * FROM `cart` WHERE Product_id = '$Product_id'";


    //thuc hien truy van
    $result = mysqli_query($conn, $sql_select_item);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result); //hien thi len form

    if($count == 1){
        $quantity = $row['Number'];
        $sum_quantity = $quantity + $Number;
        $sql_update_hang="UPDATE `cart` SET `Number`='$sum_quantity' WHERE `Product_id`='$Product_id'";
        $result_se_hang=mysqli_query($conn,$sql_update_hang);
        header('Location: cart.php');
    } else{
        $query = "Select * From product Where Product_id = $Product_id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);


        $Cart_id =  $row['Product_id'];
        $Cart_discription =  $row['Description'];
        $Cart_price_dropped =  $row['Price_dropped'];
        $Cart_img =  $row['Product_img'];
    
        echo $query2 = "INSERT INTO `cart`(`Product_id`, `Description`, `Product_img`, `Price_dropped`,`Number`) 
        VALUES ('$Cart_id','$Cart_discription','$Cart_img','$Cart_price_dropped','$Number')";
        mysqli_query($conn,$query2 );
        header('Location: cart.php');
    }	
?>