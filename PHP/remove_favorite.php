<?php
require_once("database.php");
session_start();

if (isset($_GET['storeid'])) {
    $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
    $RecMember = mysqli_query($conn,$query_RecMember);
    $row_Recmember = mysqli_fetch_assoc($RecMember);
    $member_id = $row_Recmember["id"];

    $storeid = $_GET['storeid'];

    // 执行删除操作
    $sql_delete = "DELETE FROM `favorites` WHERE `member_id` = '$member_id' AND `store_id` = '$storeid'";

    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('取消收藏成功'); window.location.href='res_list.php';</script>";
    } else {
        echo "<script>alert('取消收藏失敗'); window.location.href='res_list.php';</script>";
    } 
} 
   mysqli_close($conn);
?>