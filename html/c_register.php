<head>
<meta charset="utf-8">
<title>傳送表單方式為POST</title>
</head>
<!--接收表單的網頁-->

<?php
$name=$_POST["name"];
echo "<h1>Hello! Welcome ".$name."!</h1><br>".
    "您的姓名是：".$_POST["name"]."<br>".
    "您的性別是：".$_POST["gender"]."<br>".
    "您來自於：".$_POST["city"]."<br>".
    "您的手機號碼是：".$_POST["phone"]."<br>".
    "您的E-mail是：".$_POST["email"]."<br>".
    "您的密碼是：".$_POST["psw"]."<br>".
    "確認密碼：".$_POST["psw-repeat"]."<br>";
?>
