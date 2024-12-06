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
    <link rel="stylesheet" href="css/food_manage.css">
</head>

<body>
    <div>
        <?php
        session_start();
        if (isset($_GET['storeid'])) {
        $id = $_GET['storeid'];
        $sql_query = "SELECT * FROM `store` WHERE `id` = '$id'";
        $result = mysqli_query($conn, $sql_query);
        $row = mysqli_fetch_assoc($result);
        }else{header("Location: res_list.php");
        }

        $store_query = "SELECT * FROM `store` WHERE `id`='" . $row["id"] . "'";
        $storeresult = mysqli_query($conn, $store_query);
        $row_Recstore = mysqli_fetch_assoc($storeresult);
        
        echo "<table style='width: 80%; text-align: center;'>";
        echo "<tr><td style='font-size: 24px;'>店家名稱：</td>";
        echo "<td style='font-size: 24px;'>" . $row_Recstore["storeName"] . "</td>";  
        echo "<td style='font-size: 24px;'>營業時間：</td>";
        echo "<td style='font-size: 24px;'>" . $row_Recstore["#"] . "</td></tr>";
        
        echo "<tr><td style='font-size: 24px;'>店家電話：</td>";
        echo "<td style='font-size: 24px;'>" . $row_Recstore["storePhoneNumber"] . "</td>";
        echo "<td style='font-size: 24px;'>店家地址：</td>";
        echo "<td style='font-size: 24px;'>" . $row_Recstore["storeAddress"] . "</td></tr>";
        echo "</table>";
        ?>
        <hr>
        <h2>菜單</h2>
        <hr>
        <!--內容-->
        <div class="container">
            <?php
            require_once("database.php");
            session_start();

            $sql_query = "SELECT `foodid`,`foodimage`,`foodname`,`foodprice` FROM `food`";
            $result = mysqli_query($conn, $sql_query);
            $num_rows = mysqli_num_rows($result);
            $counter = 0;
            echo "<div class='rowfood'>";
            while ($rowfood = mysqli_fetch_assoc($result)) {
                if ($counter > 0 && $counter % 3 == 0) {
                    echo "</div><div class='rowfood'>";
                }
                echo "<a href='menu.php?storeid=" . $row["id"] . "&foodid=" . $rowfood["foodid"] . "'>";
                echo "<div class='col panel panel-default col-md-4'>";
                echo "<div class='panel-heading'><img src='foodimg/" . $rowfood["foodimage"] . "' style='width:300px; height:200px;' /></div>";
                echo "<table class='table'>";
                echo "<th>餐點名稱 : " . $rowfood["foodname"] . "</th>";
                echo "<th>";
                echo "<th>價錢 : " . $rowfood["foodprice"] . "</th>";
                echo "</th>";
                echo "</table></div></a>";
                $counter++;
            }
            echo "</div>";
            ?>
        </div>
    </div>
    
    </div>
    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>