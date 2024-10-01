<?php
    include("navbar.php");
    session_start();
    require_once("login_check.php");
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="中國文化大學113年畢業專題製作，組別B-07">
    <title>文大線上點餐系統</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/member_center.css">
</head>

<body>
        <!--內容-->
        <div class="col-sm-4 col-sm-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>會員中心</h1></div>
                <div class="panel-body">
                <?php
                require_once("database.php");
                session_start();
                //查詢登入會員資料
                $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                $RecMember = mysqli_query($conn,$query_RecMember);
                $row_Recmember = mysqli_fetch_assoc($RecMember);
                
                if ($row_Recmember["identity"] == "consumer") {
                    echo "<p><h2>會員名稱：<strong>";
                    echo $row_Recmember["name"];
                    echo "</strong></p>";
                } else if ($row_Recmember["identity"] == "store") {
                    echo "<p>店家名稱：<strong>";
                    echo $row_Recmember["name"];
                    echo "</strong></p>";
                } else if ($row_Recmember["identity"] == "root") {
                    echo "<p>管理員歡迎回來!</p>";
                }
                ?>
                <br>
                <p align="center">
                <a href="member_updateform.php"> 修改會員資料 </a>
                <br><br>

                <a href="member_change_password.php"> 修改會員密碼 </a>
                <br><br>
                <a href="logout.php"> 登出系統 </a><br>
                </p>
                </div>
                </div>
            </div>
        </div>
    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>