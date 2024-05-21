<head>
<meta charset="utf-8">
<title>傳送表單方式為POST</title>
</head>
<!--接收表單的網頁-->

<?php
$store=$_POST["store"];
echo "<h1>Hello! Welcome 店家".$store."!</h1><br>".
    "店家名稱是：".$_POST["store"]."<br>".
    "負責人姓名是：".$_POST["st-name"]."<br>".
    "負責人手機號碼是：".$_POST["phone"]."<br>".
    "店家電話是：".$_POST["call"]."<br>".
    "店家地址是：".$_POST["address"]."<br>".
    "您的E-mail是：".$_POST["email"]."<br>".
    "您的密碼是：".$_POST["psw"]."<br>".
    "確認密碼：".$_POST["psw-repeat"]."<br>";
?>
