
<?php
    session_start();

    // Hủy tất cả biến session
    // $_SESSION = array();

    // //  hủy hoàn toàn session,  xóa session cookie.
    // // Lưu ý: Điều này sẽ hủy session, không chỉ dữ liệu session!
    // if (ini_get("session.use_cookies")) {
    //     $params = session_get_cookie_params();
    //     setcookie(session_name(), '', time() - 42000,
    //         $params["path"], $params["domain"],
    //         $params["secure"], $params["httponly"]
    //     );
    // }

    // // Cuối cùng, hủy session
    session_destroy();

    // Chuyển hướng người dùng về trang đăng nhập
    header("Location: index.php");
    exit;
?>