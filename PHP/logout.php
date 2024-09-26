<?php
session_start();
unset($_COOKIE["account"]); 
unset($_COOKIE["password"]);
unset($_SESSION["account"]);
header("Location: login.php");
?>