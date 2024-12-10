<?php
include("navbar.php");
session_start();
require_once("login_check.php");
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 取得使用者輸入的資料
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $activity_level = $_POST['activity_level'];
    $date = $_POST['date'];
    $tdee = "";
    $bmr = "";
    $suggestion = "";
    if (is_numeric($weight) && is_numeric($height) && $height > 0) {

        if ($gender == 'male') {
            $bmr = 66 + (13.75 * $weight) + (5 * $height) - (6.75 * $age);
        } else {
            $bmr = 655 + (9.56 * $weight) + (1.85 * $height) - (4.68 * $age);
        }
        $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
        $RecMember = mysqli_query($conn, $query_RecMember);
        $row_Recmember = mysqli_fetch_assoc($RecMember);
        $member_id = $row_Recmember["id"];

        switch ($activity_level) {
        case '久坐型': // 久坐型
            $tdee = $bmr * 1.2;
            break;
        case '輕度運動': // 輕度運動
            $tdee = $bmr * 1.375;
            break;
        case '中等運動': // 中等運動
            $tdee = $bmr * 1.55;
            break;
        case '高強度運動': // 高強度運動
            $tdee = $bmr * 1.725;
            break;
        case '非常高強度運動': // 非常高強度運動
            $tdee = $bmr * 1.9;
            break;
        default:
            $tdee = $bmr; // 無活動時
        }

        // Insert data into the database
        $sql = "INSERT INTO `bmr` (`member_id`, `gender`, `age`, `height`, `weight`, `bmr`, `activity_level`, `tdee`, `date`) 
            VALUES ('$member_id', '$gender', '$age', '$height', '$weight', '$bmr', '$activity_level', '$tdee', '$date')";
        if (mysqli_query($conn, $sql)) {
            // Successfully inserted data
            // Do nothing for now or maybe show a success message
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    // 根據 TDEE 來給出卡路里建議
        $calories_needed = "您的基礎代謝率 (BMR) 是「 $bmr 」大卡 <br> 您的每日總消耗卡路里（TDEE）大約是「 $tdee 」大卡。";

        if ($tdee < 2000) {
            $suggestion = "您可能需要增加您的卡路里攝入以維持正常的能量需求   。";
        } elseif ($tdee > 3000) {
           $suggestion = "您的活動量較大，請確保攝取足夠的卡路里以支持高強   度運動。";
        } else {
            $suggestion = "您的卡路里需求相對平衡，請保持健康的飲食。";
        }
    }
}else{
  echo "<h3>請確保體重和身高是有效的數字。</h3>";
    }
    // Close connection after all operations
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
    <link rel="stylesheet" href="css/account_manage.css">
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <div>
        <div class="container">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>基礎代謝率 BMR 計算器 &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp <a href="bmr_h.php" > 查看歷史紀錄</a></h2>
                    </div>
                    <div class="panel-body">
                    <h3>公式 : 男：66＋( 13.7*體重kg＋5*身高cm－6.8*年齡) <br>
                     &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; 女：655＋( 9.6*體重kg＋1.8*身高cm－4.7*年齡)</h3>
                    <form method="POST" action="bmr.php">
                        <label for="gender">性別:</label><br>
                        <input type="radio" name="gender" value="male"> 男
                        <input type="radio" name="gender" value="female"> 女<br><br>

                        <label for="age">年齡:</label><br>
                        <input type="number" name="age" required><br><br>

                        <label for="height">身高 (cm):</label><br>
                        <input type="number" name="height" required><br><br>

                        <label for="weight">體重 (kg):</label><br>
                        <input type="number" name="weight" required><br><br>

                        <label for="activity_level">活動水平:</label><br>
                        <select name="activity_level">
                            <option value="久坐型">久坐型 (很少或不運動)</option>
                            <option value="輕度運動">輕度運動 (輕度運動或每天散步)</option>
                            <option value="中等運動">中等運動 (每週中度運動3-5天)</option>
                            <option value="高強度運動">高強度運動 (每週高強度運動6-7天)</option>
                            <option value="非常高強度運動">非常高強度運動 (每天高強度訓練)</option>
                        </select><br><br>
                        <label for="date">日期:</label>
                        <input type="date" name="date" required><br><br>

                        <input type="submit" value="計算 BMR">
                        <input type="submit" value="返回" name="submit" onclick="window.history.back();" style="background-color: #b1b3b2">
                    </form>
                    <?php
                        if (isset($bmr) && $bmr !== "") {
                            echo "<h2>$calories_needed</h2>";
                            echo "<hr>";
                            echo "<h3>建議 : </h3>";
                            echo "<h4><b>$suggestion</b></h4>";
                        }
                    ?>
                    <hr>
                    <h3>參考標準 : </h3>
                    <h3>·男性基礎代謝率標準表：
                        <br>18~29歲：24大卡/公斤/日
                        <br>30~49歲：22.3大卡/公斤/日
                        <br>50歲以上：21.5大卡/公斤/日
                    </h3>
                    <h3>·女性基礎代謝率標準表：
                        <br>18~29歲：23.6大卡/公斤/日
                        <br>30~49歲：21.7大卡/公斤/日
                        <br>50歲以上：20.7大卡/公斤/日
                    </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
