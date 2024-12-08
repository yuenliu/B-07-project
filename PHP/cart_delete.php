<?php
require_once("database.php");
session_start();
$query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
$RecMember = mysqli_query($conn, $query_RecMember);
$row_Recmember = mysqli_fetch_assoc($RecMember);

$sql_cart = "SELECT * FROM `cart` WHERE `member_id`='" . $row_Recmember["id"] . "'";
$RecCart = mysqli_query($conn, $sql_cart);
$rowCart = mysqli_fetch_assoc($RecCart);

$member_id = $row_Recmember["id"];
if(isset($_GET["food_id"])){
    $food_id = $_GET["food_id"];
    if($_GET["food_id"] == "all"){
        $sql_delete = "DELETE FROM `cart` WHERE `member_id` = '$member_id'";
        if (mysqli_query($conn, $sql_delete)) {
            echo "<script>alert('購物車已清空'); window.location.href='cart.php';</script>";
        } else {
            echo "<script>alert('刪除餐點失敗'); window.location.href='cart.php';</script>";
        }
    }else{;
        $sql_delete = "DELETE FROM `cart` WHERE `food_id` = '$food_id' AND `member_id` = '$member_id'";
        if (mysqli_query($conn, $sql_delete)) {
            echo "<script>alert('餐點已刪除'); window.location.href='cart.php';</script>";
        } else {
            echo "<script>alert('刪除餐點失敗'); window.location.href='cart.php';</script>";
        }
    }
}else{
    header("Location: cart.php");
}
?>
