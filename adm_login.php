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
    // lay dulieu tu form dangnhap
    $User = $_POST["user"];
    $Password = $_POST["password"];

    //trich xuat du lieu nhap bang ham 
    $Input_user = mysqli_real_escape_string($conn, $User);
    $Input_pass = mysqli_real_escape_string($conn, $Password);

   echo  $sql = "SELECT * FROM `account` WHERE User = '$Input_user' and Password = '$Input_pass'";
   

    $result = mysqli_query($conn, $sql);

    // tắt hiển thị lỗi
    ini_set('display_errors', '0');

    $count = mysqli_num_rows($result);
    // $row = mysqli_fetch_assoc($result); //hien thi len form

    if($count == 1){
        session_start();
        $_SESSION['User_name'] = $User;
        header('Location: adm_productadd.php');
    } else{
        header('Location: login.php');
    }
?>
