<?php
require_once("database.php");
session_start();
$query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
$RecMember = mysqli_query($conn, $query_RecMember);
$row_Recmember = mysqli_fetch_assoc($RecMember);

if (isset($_GET["order_id"])) {
    $order_id = $_GET["order_id"];

    if ($row_Recmember["identity"] == "consumer") {
        $member_id = $row_Recmember["id"];
        $query_order = "SELECT * FROM `food_order` WHERE `member_id` = '$member_id' AND `order_id` = '$order_id'";
        $Recorder = mysqli_query($conn, $query_order);
        if (mysqli_num_rows($Recorder) == 0) {
            echo "<script>alert('沒有相關訂單可取消'); window.location.href='order.php';</script>";
        } else {
            $sql_update = "UPDATE `food_order` SET `order_state` = ? WHERE `order_id` = '$order_id' AND `member_id` = '$member_id' ";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql_update);
            $order_state = 5;
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "s", $order_state);
                mysqli_stmt_execute($stmt);
                echo "<script>alert('訂單已取消'); window.location.href='order.php';</script>";
            } else {
                die("發生了一些錯誤！請洽管理員。");
            }
        }
    }
    if ($row_Recmember["identity"] == "store") {

    }
} else {
    header("Location: order.php");
}
?>