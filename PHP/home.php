<?php
    include("navbar.php");
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
    <link rel="stylesheet" href="css/login.css">
    <style>
        marquee {
            font-size: 28px;  
            font-weight: bold;    
            color: #800;          
            font-family: 'Microsoft JhengHei', '微軟正黑體', sans-serif;
        }

        /* 小方塊公告樣式 */
        .announcement-box {
            width: 600px;
            padding: 20px;
            background-color: #f0f0f0;
            border: 1px solid #dcdcdc;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 20px;
            color: #333;
            margin: 20px auto;
            text-align: center;
        }

        .announcement-box p {
            margin: 0;
            padding: 0;
        }

        .announcement-box strong {
            color: #d9534f;
        }
    </style>
</head>

<body>
    <div>
        <marquee>歡迎來到文大線上點餐暨飲食健康管理系統 &nbsp; 尚未註冊的顧客、店家，麻煩請先註冊~ </marquee>
        
        <!-- 小方塊公告 -->
        <div class="announcement-box">
            <p><strong>最新公告!</strong></p>
            <p>系統建議使用Chrome瀏覽器。</p>
        </div>
        <!--內容-->
        <div class="container">
            <div class="clearfix visible-md visible-lg"></div>
            <div class="row">
                <div class="col-lg-16 col-xs-18">
                    <div class="caption">
                        <p align="center">
                            <a href="login.php" class="btn btn-warning btn-lg" style="width: 300px; height: 90px;">
                                <b><font size="10">登入</font></b>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="clearfix visible-md visible-lg"></div>
                <div class="col-lg-16 col-xs-18">
                    <div class="caption">
                        <p align="center">
                            <a href="register.php" class="btn btn-danger btn-lg" style="width: 300px; height: 90px;">
                                <b><font size="10">註冊</font></b>
                            </a>
                        </p>
                    </div>
                </div>
            </div><!-- end nested row 3a -->
        </div>
    </div>

    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
