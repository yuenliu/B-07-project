<?php
require_once("database.php");
session_start();
$query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
$RecMember = mysqli_query($conn, $query_RecMember);
$row_Recmember = mysqli_fetch_assoc($RecMember);

if (isset($_GET["member_id"])) {
    $member_id = $_GET["member_id"];
    if ($row_Recmember["identity"] == "root") {
        $query_RecMember = "SELECT * FROM `member` WHERE `id`='$member_id'";
        $RecMember = mysqli_query($conn, $query_RecMember);
        $row_Recmember = mysqli_fetch_assoc($RecMember);
        if (mysqli_num_rows($RecMember) == 0) {
            echo "<script>alert('沒有相關帳號可以重設密碼'); window.location.href='login.php';</script>";
        } else {
            $password = "123123123";
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql_update = "UPDATE `member` SET `password` = ? WHERE `id` = '$member_id'";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql_update);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "s", $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<script>alert('密碼已重設，請通知使用者登入後盡速更改密碼'); window.location.href='account_manage.php';</script>";
            } else {
                die("發生了一些錯誤！請看程式。");
            }
        }
    }
} else {
    header("Location: login.php");
}
?>
