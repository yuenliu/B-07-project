<?php
require_once("database.php");
session_start();
$query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
$RecMember = mysqli_query($conn, $query_RecMember);
$row_Recmember = mysqli_fetch_assoc($RecMember);

$sql_cart = "SELECT * FROM `cart` WHERE `member_id`='" . $row_Recmember["id"] . "'";
$RecCart = mysqli_query($conn, $sql_cart);

$member_id = $row_Recmember["id"];
$dateTime = new DateTime("now", new DateTimeZone('Asia/Taipei'));
$day = $dateTime->format("Y-m-d");
$time = $dateTime->format("H:i:s");

while ($rowCart = mysqli_fetch_assoc($RecCart)) {
    $food_id = $rowCart["food_id"];
    $sql_query = "SELECT * FROM `food` WHERE `food_id` = '$food_id'";
    $result = mysqli_query($conn, $sql_query);
    $row_food = mysqli_fetch_assoc($result);
    $store_id = $row_food["store_id"];
    $quantity = $rowCart["quantity"];
    $remark = $rowCart["remark"];

    //新增至訂單
    $sql = "INSERT INTO `food_order` (`member_id`, `store_id`, `food_id`, `quantity`, `remark`,`day`,`time`) VALUES (?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
    if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $member_id, $store_id, $food_id, $quantity, $remark, $day, $time);
        mysqli_stmt_execute($stmt);
        echo "";
    } else {
        die("發生了一些錯誤！請洽管理員。");
    }

    //新增完把購物車內的資料刪掉
    $sql_delete = "DELETE FROM `cart` WHERE `food_id` = '$food_id' AND `member_id` = '$member_id'";
    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('餐點已刪除'); window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('刪除餐點失敗'); window.location.href='cart.php';</script>";
    }
}
