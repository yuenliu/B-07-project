<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "rootroot";
$dbName = "test";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("MySQL伺服器連結失敗!;");
}

?>