<?php
session_start();
require_once("login_check.php");
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="中國文化大學113年畢業專題製作，組別B-07">
    <title>文大線上點餐系統</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
"></script>
    <link rel="stylesheet" href="css/member_center.css">
</head>

</html>

<body>
    <?php
    include("navbar.php");
    ?>
    
    <aside class="col-lg-1">
        <ul class="nav nav-pills nav-stacked">
            <li><a href="member_change_password.php">修改密碼</a></li>
        </ul>
    </aside>
    <div class="col-sm-6 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">儀錶板</div>
            <div class="panel-body">
                <?php
                require_once("database.php");
                session_start();
                //查詢登入會員資料
                $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                $RecMember = mysqli_query($conn, $query_RecMember);
                $row_Recmember = mysqli_fetch_assoc($RecMember);

                if ($row_Recmember["identity"] == "consumer") {
                    echo "<p>會員名稱：<strong>";
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
            </div>
        </div>
    </div>
</body>
