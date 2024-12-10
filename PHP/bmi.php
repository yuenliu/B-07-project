<?php
include("navbar.php");
session_start();
require_once("login_check.php");
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bmi = "";
    $suggestion = "";
    $date = $_POST['date'];

    // Validate input values
    if (is_numeric($weight) && is_numeric($height) && $height > 0) {
        // Calculate BMI
        $bmi = $weight / ($height * $height);

        // Get member ID from the session
        $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
        $RecMember = mysqli_query($conn, $query_RecMember);
        $row_Recmember = mysqli_fetch_assoc($RecMember);
        $member_id = $row_Recmember["id"];

        // Insert data into the database
        $sql = "INSERT INTO `bmi` (`member_id`, `height`, `weight`, `bmi`, `date`) 
                VALUES ('$member_id', '$height', '$weight', '$bmi', '$date')";
        if (mysqli_query($conn, $sql)) {
            // Successfully inserted data
            // Do nothing for now or maybe show a success message
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        // Determine the health suggestion based on BMI value
        if ($bmi < 18.5) {
            $suggestion = "您的BMI值過低，建議增重。";
        } elseif ($bmi >= 18.5 && $bmi < 24) {
            $suggestion = "您的BMI值正常，保持健康飲食和運動。";
        } elseif ($bmi >= 24 && $bmi < 27) {
            $suggestion = "您的BMI值過高，屬於過重，建議減重。";
        } elseif ($bmi >= 27 && $bmi < 30) {
            $suggestion = "您的BMI值過高，屬於輕度肥胖,建議減重。";
        } elseif ($bmi >= 30 && $bmi < 35) {
            $suggestion = "您的BMI值過高，屬於中度肥胖,建議減重。";
        } else {
            $suggestion = "您的BMI值超高，屬於重度肥胖,建議進一步減重並諮詢醫生。";
        }
    } else {
        echo "<h3>請確保體重和身高是有效的數字。</h3>";
    }
    // Close connection after all operations
    $conn->close();
}
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
                        <h2>身體質量指數 BMI 計算器 &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp<a href="bmi_h.php" >  查看歷史紀錄</a></h2>
                    </div>
                    <div class="panel-body">
                        <h3>公式 : 體重(kg) / 身高(m)的平方</h3>
                        <hr>
                        <form method="post" action="bmi.php">
                            <label for="height">身高 (公尺):</label>
                            <input type="text" name="height" id="height" required>
                            <br>
                            <label for="weight">體重 (公斤):</label>
                            <input type="text" name="weight" id="weight" required>
                            <br><br>
                            <label for="date">日期:</label>
                            <input type="date" name="date" required><br><br>
                            <input type="submit" value="計算BMI">
                            <input type="button" value="返回" onclick="window.history.back();" style="background-color: #b1b3b2">
                        </form>

                        <?php
                        if (isset($bmi) && $bmi !== "") {
                            echo "<h2>BMI結果: " . number_format($bmi, 2) . "</h2>";
                            echo "<hr>";
                            echo "<h3>建議 : </h3>";
                            echo "<h4><b>$suggestion</b></h4>";
                        }
                        ?>
                        <hr>
                        <h3>參考標準 : </h3>
                        <h3>過輕(BMI<18.5)、健康體重(18.5≦BMI<24)、過重(24≦BMI<27)、輕度肥胖(27≦BMI<30)、中度肥胖(30≦BMI<35)及重度肥胖(BMI≧35)。</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
