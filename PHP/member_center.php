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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/login1.css">
</head>

</html>

<body>
    <nav class="navbar navbar-inverse fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand text-white">文大線上點餐系統</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="home.html">首頁</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="contact.html"> 聯絡管理員</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> 登出</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <h1>測試畫面，你看到這頁就表示你登入成功了</h1>
    <?php
    require_once("database.php");
    session_start();
    //查詢登入會員資料
    $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
    $RecMember = mysqli_query($conn,$query_RecMember);
    $row_Recmember = mysqli_fetch_assoc($RecMember);
    ?>
    <p>會員名稱：<strong><?php echo $row_Recmember["account"]; ?></strong></p>
</body>