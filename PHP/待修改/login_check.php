<?php 
  //檢查是否已登入，若未登入則導回首頁
  if(!isset($_SESSION["account"]) || ($_SESSION["account"]=="")) {
    header("Location: index.php");
  }
?>