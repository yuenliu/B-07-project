<?php
    include("navbar.php");
    session_start();
    require_once("login_check.php");
    require_once("database.php");

    // 获取 foodid
    if (isset($_GET['foodid'])) {
        $foodid = $_GET['foodid'];

        // 执行删除操作
        $sql_delete = "DELETE FROM `food` WHERE `foodid` = '$foodid'";

        if (mysqli_query($conn, $sql_delete)) {
            echo "<script>alert('餐點已刪除'); window.location.href='food_manage.php';</script>";
        } else {
            echo "<script>alert('刪除餐點失敗'); window.location.href='food_manage.php';</script>";
        }
    } else {
        echo "<script>alert('無效的餐點ID'); window.location.href='food_manage.php';</script>";
    }
    mysqli_close($conn);
?>
