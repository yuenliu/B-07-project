<?php
      header("Content-Type: text/html; charset=utf-8");
      require_once("database.php");
      session_start();

      if(isset($_SESSION["account"]) && ($_SESSION["account"]!="")){
        header("Location: login.php");
      }

      if(isset($_POST["account"]) && ($_POST["password"])){
        $sql = "select * from `consumer` where `account`='".$_POST["account"]."'";
        $RecLogin = mysql_query($sql);

        $row_RecLogin = mysql_fetch_assoc($RecLogin);
        $account = $row_RecLogin["account"];
        $password = $row_RecLogin["password"];

        if($_POST["password"]==$password){
          $_SESSION["account"]=$account;
          setcookie("account",$_POST["account"],time()+2*60*60);
          setcookie("password",$_POST["password"],time()+2*60*60);
          header("Location: member_center.php");
        }else{
          die("登入失敗！");
        }
      }
    ?>
