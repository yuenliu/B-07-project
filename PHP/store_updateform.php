<?php
include("navbar.php");
?>

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
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">修改店家資料</div>
            <?php
            session_start();
            //查詢登入會員資料
            $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
            $RecMember = mysqli_query($conn, $query_RecMember);
            $row_Recmember = mysqli_fetch_assoc($RecMember);
            $query_RecStore = "SELECT * FROM `store` WHERE `member_id`='" . $row_Recmember["id"] . "'";
            $result_RecStore = mysqli_query($conn, $query_RecStore);
            if (mysqli_num_rows($result_RecStore) == 0) {
                echo "<div class='panel-body'><p style='color: red;'>初次註冊店家帳號，請先填寫店家資訊。</p></div>";
            }

            if (isset($_POST["change"])){
                $storeName = $_POST["storeName"];
                $storeAddress = $_POST["storeAddress"];
                $storePhoneNumber = $_POST["storePhoneNumber"];

                $errors = array();

                if (
                    empty($storeName) or empty($storeAddress) or empty($storePhoneNumber)
                ) {
                    array_push($errors, "所有表格均需填入資料。");
                }
                require_once "database.php";
                $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                $RecMember = mysqli_query($conn, $query_RecMember);
                $row_Recmember = mysqli_fetch_assoc($RecMember);
                $sql = "SELECT * FROM `store`";
                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    $sql = "INSERT INTO `store` (`member_id`,`storeName`, `storeAddress`, `storePhoneNumber`) VALUES (?,?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    $id = $row_Recmember["id"];
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "ssss", $id, $storeName, $storeAddress, $storePhoneNumber);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>更改成功！</div>";
                    } else {
                        die("發生了一些錯誤！請洽管理員。");
                    }
                }
            }
            ?>
            <div class="panel-body">
                <form action="store_updateform.php" method="POST">
                    <p><strong>店家名稱</strong></p>
                    <input type="text" name="storeName"><br>
                    <p><strong>店家地址</strong></p>
                    <input type="text" name="storeAddress"><br>
                    <p><strong>店家電話</strong></p>
                    <input type="text" name="storePhoneNumber"><br>
                    <input type="submit" name="change" value="確認修改">
                </form>
            </div>
        </div>
    </div>
</body>