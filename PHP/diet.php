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
</head>

<body>
    <div class="container">
    <div class="row"><h4 align='center'>營養學家Nichola Ludlam-Raine說：「健康的飲食是一種均衡飲食，因此要包含以下五種食物中的所有食物。」</h4>
        <h3 align='center'><b>水果和蔬菜、纖維及雜糧、蛋白質、含鈣的乳製品健康脂肪</b></h3>
        <hr>
                <div class="col-lg-16 col-xs-18">
                    <div class="caption">
                        <p align="center">
                            <a href="add_meal.php" class="btn btn-primary btn-lg" style="width: 350px; height: 90px;">
                                <b><font size="10">新增飲食紀錄</font></b>
                            </a>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="col-lg-16 col-xs-18">
                    <div class="caption">
                        <p align="center">
                            <a href="view_food.php" class="btn btn-primary btn-lg" style="width: 350px; height: 90px;">
                                <b><font size="10">我的飲食紀錄</font></b>
                            </a>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="col-lg-16 col-xs-18">
                    <div class="caption">
                        <p align="center">
                            <a href="health_analysis.php" class="btn btn-success btn-lg" style="width: 350px; height: 90px;">
                                <b><font size="10">營養分析</font></b>
                            </a>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="col-lg-16 col-xs-18">
                    <div class="caption">
                        <p align="center">
                            <a href="bmi.php" class="btn btn-info btn-lg" style="width: 350px; height: 70px;">
                                <b><font size="6">身體質量指數 (BMI)</font></b>
                            </a>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="col-lg-16 col-xs-18">
                    <div class="caption">
                        <p align="center">
                            <a href="bmr.php" class="btn btn-info btn-lg" style="width: 350px; height: 70px;">
                                <b><font size="6">基礎代謝率 (BMR) </font></b>
                            </a>
                        </p>
                    </div>
                </div>
                <hr>
    </div><!-- end nested row 3a -->
</div>
</body>
</html>
