<?php
session_start();
include 'db_cn.php'; // 連接資料庫

if (isset($_POST['btn_login'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $log_query = "SELECT * FROM users WHERE user_id='$id' AND user_pass='$password' LIMIT 1";
    $log_query_run = mysqli_query($con, $log_query);

    if (mysqli_num_rows($log_query_run) > 0) {
        $row = mysqli_fetch_assoc($log_query_run);
        $_SESSION['auth_role'] = $row['user_role'];
        $_SESSION['auth_user'] = [
            'user_id' => $row['user_id'],
            'user_role' => $row['user_role'],
            'user_name' => $row['user_name']
        ];
        header('Location: index.php');
    } else {
        $_SESSION['status'] = "帳號或密碼錯誤!";
        header('Location: login.php');
    }
}
?>
