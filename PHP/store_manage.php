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
    <div class="col-sm-2 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>
                    <?php
                    require_once("database.php");
                    session_start();
                    $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                    $RecMember = mysqli_query($conn, $query_RecMember);
                    $row_Recmember = mysqli_fetch_assoc($RecMember);
                    if (
                        $row_Recmember["identity"] == "consumer" ||
                        $row_Recmember["identity"] == "root"
                    ) {
                        header("Location: member_center.php");
                    }
                    if ($row_Recmember["identity"] == "store") {
                        echo "店家管理";
                    }
                    ?>
                </h1>
            </div>
            <div class="panel-body">
                <?php
                $store_query = "SELECT * FROM `store` WHERE `member_id`='" . $row_Recmember["id"] . "'";
                $storeresult = mysqli_query($conn, $store_query);
                $row_Recstore = mysqli_fetch_assoc($storeresult);
                echo "<p>店家名稱：<strong>";
                echo $row_Recstore["storeName"];
                echo "</strong></p>";
                echo "<p style='color:red;'>如果店家名稱沒有顯示出來，表示您沒有設定。";
                ?>
                <br>
                <p align="center">
                    <?php
                    if($row_Recstore["online_state"]==false){
                        echo "<p><a href='store_online.php'> 點我上線 </a></p>";
                    }else{
                        echo "<p><a href='store_offline.php'> 點我離線 </a></p>";
                    }
                    echo "<p><a href='store_qrcode.php'> 店家QRcode </a></p>";
                    echo "<p><a href='food_manage.php'> 餐點管理 </a></p>";
                    echo "<p><a href='business_hours.php'> 營業時間設定 </a></p>";
                    ?>
                </p>
            </div>
        </div>
    </div>
</body>
