<?php
include("navbar.php");
session_start();
require_once("login_check.php");
?>

<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="css/account_manage.css">
</head>

<body>
    <div>
        <div class="container">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>我的飲食紀錄</h2>
                    </div>
                    <div class="panel-body">
                        <?php
                        // Retrieve the member details based on the session account
                        $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                        $RecMember = mysqli_query($conn, $query_RecMember);
                        $row_Recmember = mysqli_fetch_assoc($RecMember);

                        // Retrieve the meal records for the member
                        $sql_meal = "SELECT * FROM `meals` WHERE `member_id`='" . $row_Recmember["id"] . "'";
                        $RecMeal = mysqli_query($conn, $sql_meal);

                        $sql_order = "SELECT * FROM `food_order` WHERE `order_state` = 3 AND `member_id`='" . $row_Recmember["id"] . "'";
                        $Recorder = mysqli_query($conn, $sql_order);

                        // Check if there are no meal records
                        if (mysqli_num_rows($RecMeal) == 0 && mysqli_num_rows($Recorder) == 0) {
                            echo "<h3>尚未有飲食或訂單紀錄！</h3>";
                        } else {
                            // Start the table and display the column headers
                            echo "<table class='table table-bordered'>
                                <h3>食物熱量計算方式：蛋白質+脂肪+碳水化合物＝總卡路里</h3>
                                <h3>·1克蛋白質 = 4卡路里<br>
                                    ·1克脂肪 = 9卡路里<br>
                                    ·1克碳水化合物 = 4卡路里
                                </h3>
                                <hr>
                                <h3> 手動輸入</h3>
                                    <tr align='center'>
                                        <th>餐點名稱</th>
                                        <th>蛋白質</th>
                                        <th>脂肪</th>
                                        <th>碳水化合物</th>
                                        <th>熱量</th>
                                        <th>日期</th>
                                    </tr>";

                            // Variable to store total calories
                            $total_calorie = 0;
                            if (mysqli_num_rows($RecMeal) == 0) {
                                echo "<tr><td colspan='6'><h3>尚未有飲食紀錄！</h3></td></tr>";
                            } else {

                                // Loop through each meal record and display the data
                                while ($rowMeal = mysqli_fetch_assoc($RecMeal)) {
                                    $calorie = 0;
                                    $calorie = ($rowMeal["protein"] * 4) + ($rowMeal["fat"] * 9) + ($rowMeal["carbs"] * 4);
                                    echo "<tr align='center'>
                                        <td>" . $rowMeal["meal_name"] . "</td>
                                        <td>" . $rowMeal["protein"] . "</td>
                                        <td>" . $rowMeal["fat"] . "</td>
                                        <td>" . $rowMeal["carbs"] . "</td>
                                        <td>" . $calorie . "</td>
                                        <td>" . $rowMeal["meal_date"] . "</td>
                                    </tr>";

                                    // Calculate total calories for the meal
                                    $total_calorie += ($rowMeal["protein"] * 4) + ($rowMeal["fat"] * 9) + ($rowMeal["carbs"] * 4);
                                }
                            }
                            echo "</table>";
                            echo "<hr>
                                <table class='table table-bordered'><h3> 訂單</h3>
                                    <tr align='center'>
                                        <th>店家名稱</th>
                                        <th>餐點名稱</th>
                                        <th>蛋白質</th>
                                        <th>脂肪</th>
                                        <th>碳水化合物</th>
                                        <th>熱量</th>
                                        <th>日期</th>
                                    </tr>";
                            if (mysqli_num_rows($Recorder) == 0) {
                                echo "<tr><td colspan='7'><h3>尚未有飲食紀錄！</h3></td></tr>";
                            } else {

                                while ($roworder = mysqli_fetch_assoc($Recorder)) {
                                    $calorie = 0;
                                    $store_query = "SELECT * FROM `store` WHERE `id`='" . $roworder["store_id"] . "'";
                                    $storeresult = mysqli_query($conn, $store_query);
                                    $row_Recstore = mysqli_fetch_assoc($storeresult);

                                    $sql_query = "SELECT `food_name`, `food_protein`, `food_fat`, `food_carbs`, `food_calorie` FROM `food` WHERE `food_id`='" . $roworder["food_id"] . "'";
                                    $result = mysqli_query($conn, $sql_query);
                                    $row_food = mysqli_fetch_assoc($result);
                                    echo "<tr align='center'>
                                        <td>" . $row_Recstore["storeName"] . "</td>
                                        <td>" . $row_food["food_name"] . "</td>
                                        <td>" . $row_food["food_protein"] . "</td>
                                        <td>" . $row_food["food_fat"] . "</td>
                                        <td>" . $row_food["food_carbs"] . "</td>
                                        <td>" . $row_food["food_calorie"] . "</td>
                                        <td>" . $roworder["day"] . "</td>
                                    </tr>";

                                    // Calculate total calories for the meal
                                    $total_calorie += $row_food["food_calorie"];
                                }
                            }
                            // Close the table and display the total calorie count
                            echo "</table>";
                            echo "<h2 align='center'>總熱量：" . $total_calorie . " 卡</h2>";
                            echo "<hr>";
                            echo "<h3>參考標準 : </h3>";
                            echo "<h3>過輕(BMI<18.5)、健康體重(18.5≦BMI<24)、過重(24≦BMI<27)、輕度肥胖(27≦BMI<30)、中度肥胖(30≦BMI<35)及重度肥胖(BMI≧35)。</h3>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
