<?php
session_start();
if (isset($_POST["login"])) {
    $account = $_POST["account"];
    $password = $_POST["password"];
    require_once "database.php";
    $sql = "SELECT * FROM `member` WHERE `account` = '$account'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user) {
        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["account"] = $account;
            //使用Cookie記錄登入資料
            if (isset($_POST["remember"]) && ($_POST["remember"] == "true")) {
                setcookie("account", $_POST["account"], time() + 2 * 60 * 60);
                setcookie("password", $_POST["password"], time() + 2 * 60 * 60);
            } else {
                if (isset($_COOKIE["account"])) {
                    setcookie("account", $_POST["account"], time() - 100);
                    setcookie("password", $_POST["password"], time() - 100);
                }
            }
            header("Location: member_center.php");
        } else {
            echo "<div class='alert alert-danger'>密碼錯誤</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>帳號不存在</div>";
    }
}
?>