<?php
    header("Content-Type: text/html; charset=utf-8");
    require_once("database.php");
    session_start();

    require_once("login_check.php");
    $redirect_url="member_center.php";

    

    $sql = "UPDATE `member` SET 
    `name`='" . $_POST["name"] . "',
    `phoneNumber`='" . $_POST["phoneNumber"] . "',
    `storePhoneNumber`='" . $_POST["storePhoneNumber"] . "',
    `storeName`='" . $_POST["storeName"] . "',
    `storeAddress`='" . $_POST["storeAddress"] . "',
    `E-mail`='" . $_POST["email"] . "' 
    WHERE `account`='" . $_SESSION["account"] . "'";

    mysqli_query($conn,$sql);

    header("Location: $redirect_url");
?>