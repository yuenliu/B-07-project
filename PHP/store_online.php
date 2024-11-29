<?php
require_once("database.php");
session_start();
$query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
$RecMember = mysqli_query($conn, $query_RecMember);
$row_Recmember = mysqli_fetch_assoc($RecMember);
$store_query = "SELECT * FROM `store` WHERE `member_id`='" . $row_Recmember["id"] . "'";
$storeresult = mysqli_query($conn, $store_query);
$row_Recstore = mysqli_fetch_assoc($storeresult);
if ($row_Recstore["online_state"] == false) {
    $sql = "UPDATE `store` SET `online_state`=true WHERE `member_id`='" . $row_Recmember["id"] . "' ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: store_manage.php");
    } else {
        echo '修改失敗！';
    }
}
?>