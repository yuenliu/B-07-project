<?php
require_once("database.php");
session_start();

if (isset($_GET['storeid'])) {
    $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
    $RecMember = mysqli_query($conn,$query_RecMember);
    $row_Recmember = mysqli_fetch_assoc($RecMember);
    $member_id = $row_Recmember["id"];

    $store_id = $_GET['storeid'];
    
    // 插入收藏記錄
    $sql = "INSERT INTO `favorites` (`member_id`, `store_id`) VALUES (?,?)";
    $stmt = mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

    if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt, "ss", $member_id, $store_id);
        mysqli_stmt_execute($stmt);
        echo "<div class='alert alert-success'>加入收藏</div>";
    } else {
        die("發生了一些錯誤！請洽管理員。");
    
    // 跳轉回餐廳頁面
    header("Location: res_list.php");
    }
}
?>