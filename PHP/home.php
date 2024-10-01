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
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <div>
        <!--內容-->
        <div class="container">
            <header class="bgimage">
                <div class="container">
                    <h1 align="center">歡迎使用文大線上點餐系統</b></h1>
                </div>
            </header>
            <div class="clearfix visible-xs visible-lg"></div>
            <div class="row">
                <div class="col-lg-6 col-xs-8">
                    <div class="thumbnail">
                        <div class="caption">
                            <p align="center"><a href="login.php" class="btn btn-info btn-lg"><b>
                                        <font size="6">登入</a></font></b></p>
                        </div>
                    </div>
                </div>
                <div class="clearfix visible-md visible-xs"></div>
                <div class="col-lg-6 col-xs-8">
                    <div class="thumbnail">
                        <div class="caption">
                            <p align="center"><a href="register.php" class="btn btn-info btn-lg"><b>
                                        <font size="6">註冊</a></font></b></p>
                        </div>
                    </div>
                </div>
            </div><!-- end nested row 3a -->
        </div>

        <!--底部-->
        <footer class="fixed-bottom text-center text-lg-start">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                中國文化大學畢業專題製作B-07組
            </div>
        </footer>
    </div>
    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>