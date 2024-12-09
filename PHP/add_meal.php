<?php
include("navbar.php");
session_start();
require_once("login_check.php");
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meal_name = $_POST['meal_name'];
    $protein = $_POST['protein'];
    $fat = $_POST['fat'];
    $carbs = $_POST['carbs'];
    $meal_date = $_POST['meal_date'];

    $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
    $RecMember = mysqli_query($conn,$query_RecMember);
    $row_Recmember = mysqli_fetch_assoc($RecMember);
    $member_id = $row_Recmember["id"];

    $sql = "INSERT INTO `meals` (`member_id`, `meal_name`, `protein`, `fat`, `carbs`, `meal_date`) 
            VALUES ('$member_id', '$meal_name', '$protein', '$fat', '$carbs', '$meal_date')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('飲食紀錄添加成功'); window.location.href='view_food.php';</script>";
    } else {
        echo "發生錯誤! " . $conn->error;
    }
}

$conn->close();
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
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .form-container {
            width: 60%;
        }
        .right-image {
            width: 300%;
            max-width: 800px;
            height: auto;

        }
    </style>
</head>

<body>
<div>
    <!--內容-->
    <div class="container">
        <div class="form-container">
            <h2>新增飲食紀錄</h2>
            <hr>
            <form action="add_meal.php" method="post">
                <label for="meal_name">餐點名稱:</label>
                <input type="text" name="meal_name" required><br><br>
                <label for="protein">蛋白質 (g):</label>
                <input type="number" name="protein" required><br><br>
                <label for="fat">脂肪 (g):</label>
                <input type="number" name="fat" required><br><br>
                <label for="carbs">碳水化合物 (g):</label>
                <input type="number" name="carbs" required><br><br>
                <label for="meal_date">日期:</label>
                <input type="date" name="meal_date" required><br><br>
                <button type="submit">提交</button>
                <input type="submit" value="返回" name="submit" onclick="window.history.back();" >
            </form>
        </div>
        <img src="img/diet.jpg" alt="健康飲食" class="right-image">
    </div>
</div>
</body>
</html>
