<?php 
  require_once("connMysql.php");
  session_start();
  //查詢登入會員資料
  $sql = "SELECT * FROM member WHERE account='".$_SESSION["account"]."'";
  $record = mysql_query($sql);
  $row = mysql_fetch_assoc($record);
?>
<div align="center">
  <p>會員名稱：<strong><?php echo $row["account"];?></strong></p>
  <p align="center">
    <a href="member_center.php">會員中心</a><br>
    <a href="member_update_form.php">修改會員資料</a><br>
    <a href="member_change_password_form.php">修改會員密碼</a><br>
    <a href="member_delete.php">刪除會員帳號</a><br>
    <a href="logout.php">登出系統</a><br>
  </p>
</div>