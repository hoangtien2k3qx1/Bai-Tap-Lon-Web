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
    $Produuct_id = $_POST['id'];
    // Lấy dữ liệu từ from adm_product_add.html
    $Product_name = $_POST["Product_Name"];
    $Brand = $_POST["Brand"];
    $product_type = $_POST["Product_Type"];
    $Description = $_POST["Product_Description"];
    $Price = $_POST["Product_Price"];
    $Price_dropped = $_POST["Product_Price_dropped"];
    $uploadDir_img_logo = "image/";
    if($Product_name == "" ||  $Brand == "" || $product_type == "" || $Description == "" || $Price == "" || $Price_dropped == "" || $uploadDir_img_logo == "")
    {
        echo "bạn chưa điền đủ thông tin";
    }else{
        //Lấy dữ liệu và đặt tên ảnh (time + name)
        $file_tmp = isset($_FILES['img_logo']['tmp_name']) ? $_FILES['img_logo']['tmp_name'] : ""; 
        $file_name = isset($_FILES['img_logo']['name']) ? $_FILES['img_logo']['name'] : ""; 
        $file_type = isset($_FILES['img_logo']['type']) ? $_FILES['img_logo']['type'] : ""; 
        $file_size = isset($_FILES['img_logo']['size']) ? $_FILES['img_logo']['size'] : ""; 
        $file_error = isset($_FILES['img_logo']['error']) ? $_FILES['img_logo']['error'] : "";
    
        $dmyhis=date("Y").date("m").date("d").date("H").date("i").date("s"); ///Lay gio cua he thong
        $file__name__=$dmyhis.$file_name;
        copy ( $file_tmp, $uploadDir_img_logo.$file__name__);
            // Câu truy vấn thêm dữ liệu được lưu vào biến $sql_insert_hangxs
        $sql_insert_hangxs="UPDATE `product` 
        SET `Product_name`='$Product_name',`Brand`='$Brand',
        `Type`='$product_type',`Description`='$Description',`Price`='$Price',`Price_dropped`='$Price_dropped',`Product_img`='$file__name__'
         WHERE `Product_id` = '$Produuct_id'";
            //echo $sql_insert_hangxs; die;
            // THực hiện truy vấn
        mysqli_query($conn,$sql_insert_hangxs);	 
        header('Location: adm_productadd.php');
    }

?>
