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
</head>

<body>
<div>
        <div class="container">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>營養分析</h2>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="health_analysis.php">
                            <label for="start_date">起始日期:</label>
                            <input type="date" id="start_date" name="start_date" required>
                            <label for="end_date">結束日期:</label>
                            <input type="date" id="end_date" name="end_date" required>
                            <button type="submit" name="submit">查詢</button>
                        </form>
                    <?php
                        if (isset($_POST['submit'])) {
                    // 取得用戶選擇的日期範圍
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];

                            if ($start_date && $end_date) {
                                $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                                $RecMember = mysqli_query($conn, $query_RecMember);
                                $row_Recmember = mysqli_fetch_assoc($RecMember);

                                $sql_meal = "SELECT * FROM `meals` WHERE `member_id`='" . $row_Recmember["id"] . "' 
                                             AND `meal_date` BETWEEN '$start_date' AND '$end_date'";
                                $RecMeal = mysqli_query($conn, $sql_meal);

                                if (mysqli_num_rows($RecMeal) == 0) {
                                    echo "<h3>在所選日期範圍內，尚未有飲食紀錄！</h3>";
                                } else {
                                    // 初始化總攝取量變數
                                    $total_protein = 0;
                                    $total_carbs = 0;
                                    $total_fat = 0;

                                    echo "<table class='table table-bordered'>";
                                    echo "<thead><tr><th>餐點名稱</th><th>蛋白質 (克)</th><th>碳水化合物 (克)</th><th>脂肪 (克)</th><th>熱量</th><th>日期</th></tr></thead>";
                                    echo "<tbody>";

                                    // 迴圈顯示符合條件的飲食紀錄
                                    while ($rowMeal = mysqli_fetch_assoc($RecMeal)) {
                                        $calorie = 0;
                                        $calorie = ($rowMeal["protein"] * 4) + ($rowMeal["fat"] * 9) + ($rowMeal["carbs"] * 4);
                                        echo "<tr>";
                                        echo "<td>" . $rowMeal["meal_name"] . "</td>";
                                        echo "<td>" . $rowMeal["protein"] . "</td>"; 
                                        echo "<td>" . $rowMeal["fat"] . "</td>";
                                        echo "<td>" . $rowMeal["carbs"] . "</td>";
                                        echo "<td>" . $calorie . "</td>";
                                        echo "<td>" . $rowMeal["meal_date"] . "</td>";
                                        echo "</tr>";

                                        // 累加總攝取量
                                        $total_protein += $rowMeal["protein"];
                                        $total_carbs += $rowMeal["carbs"];
                                        $total_fat += $rowMeal["fat"];
                                    }

                                    echo "</tbody></table>";

                                    // 顯示總攝取量
                                    echo "<h3>所選日期範圍內的飲食總攝取:</h3>";
                                    echo "<ul>";
                                    echo "<li>蛋白質: " . $total_protein . " 克</li>";
                                    echo "<li>碳水化合物: " . $total_carbs . " 克</li>";
                                    echo "<li>脂肪: " . $total_fat . " 克</li>";
                                    echo "</ul>";
                                }
                            } else {
                                echo "<h3>請選擇有效的日期範圍。</h3>";
                            }
                            echo "<hr>";
                            echo "<h3>參考標準 : </h3>";
                            echo "<h3>1. 「脂肪」 建議攝取量 : 總熱量的 20% 到 35% 。
                            <br>
                            2. 「蛋白質」 建議攝取量 : 佔總熱量的 10% 到 35% 。
                            <br>
                            3. 「碳水化合物」 建議攝取量 : 佔總熱量的 45% 到 65% 。
                            </h3>";
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
