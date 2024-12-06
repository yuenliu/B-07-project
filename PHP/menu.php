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
</head>

<body>
    <div>
        <?php include("navbar.php"); ?>
        <div class="container">
            <?php
            session_start();
            if (isset($_GET['storeid'])) {
                $id = $_GET['storeid'];
                $sql_query = "SELECT * FROM `store` WHERE `id` = '$id'";
                $result = mysqli_query($conn, $sql_query);
                $row = mysqli_fetch_assoc($result);
            } else {
                header("Location: res_list.php");
            }

            $store_query = "SELECT * FROM `store` WHERE `id`='" . $row["id"] . "'";
            $storeresult = mysqli_query($conn, $store_query);
            $row_Recstore = mysqli_fetch_assoc($storeresult);

            echo "<h1><b>" . $row_Recstore["storeName"] . "</b></h1>";
            echo "<h3>店家電話：" . $row_Recstore["storePhoneNumber"] . "</h3>";
            echo "<h3>店家地址：" . $row_Recstore["storeAddress"] . "</h3>";
            echo "<h3>營業時間：</h3>";

            $business_sql = "SELECT * FROM `business_hours` WHERE `store_id`='" . $row["id"] . "'";
            $storeresult = mysqli_query($conn, $business_sql);
            $row_business = mysqli_fetch_assoc($storeresult);
            if ($row_business["weekdays"] == true) {
                $weekdays = "休假";
            } else {
                $weekdays = $row_business["weekdays_open"] . "~" . $row_business["weekdays_close"];
            }
            if ($row_business["holidays"] == true) {
                $holidays = "休假";
            } else {
                $holidays = $row_business["holiday_open"] . "~" . $row_business["holiday_close"];
            }
            echo "<h4>平日：" . $weekdays . "</h4>";
            echo "<h4>假日：" . $holidays . "</h4>";
            if ($row_business["special_time"] !== null) {
                echo "<h4>其他：" . $row_business["special_time"] . "<h4>";
            }
            if ($row_business["vacation_open"] == true) {
                echo "<h4 style='color: red;'>寒暑假不營業<h4>";
            }
            ?>
            <hr>
            <?php
            $store_id = $row_Recstore["id"];
            $sql_query = "SELECT `food_id`,`food_image`,`food_name`,`food_price` FROM `food` WHERE `store_id` = $store_id ";
            $result = mysqli_query($conn, $sql_query);
            $num_rows = mysqli_num_rows($result);
            $counter = 0;
            echo "<div class='rowfood'>";
            while ($rowfood = mysqli_fetch_assoc($result)) {
                if ($counter > 0 && $counter % 3 == 0) {
                    echo "</div><div class='rowfood'>";
                }
                echo "<a href='menu.php?storeid=" . $row["id"] . "&foodid=" . $rowfood["food_id"] . "'>";
                echo "<div class='col panel panel-default col-md-4'>";
                echo "<div class='panel-heading'><img src='foodimg/" . $rowfood["food_image"] . "' style='width:300px; height:200px;' /></div>";
                echo "<table class='table'>";
                echo "<th>餐點名稱 : " . $rowfood["food_name"] . "</th>";
                echo "<th>";
                echo "<th>價錢 : " . $rowfood["food_price"] . "</th>";
                echo "</th>";
                echo "</table></div></a>";
                $counter++;
            }
            echo "</div>";
            ?>
        </div>
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
