<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="Description" content="中國文化大學113年畢業專題製作，組別B-07">
    <title>文大線上點餐系統</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/member_center.css">
</head>
<body>
    <?php
    include("navbar.php");

    session_start();
    if (isset($_POST["change"])) {
        $old_password = $_POST["old-password"];
        $password = $_POST["new-password"];
        $passwordRepeat = $_POST["confirm-password"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $errors = array();

        if (
            empty($_POST["old-password"]) or empty($_POST["new-password"]) or empty($_POST["confirm-password"])
        ) {
            array_push($errors, "所有表格均需填入資料。");
        }
        if (strlen($password) < 8) {
            array_push($errors, "新密碼長度需大於8。");
        }
        if ($password !== $passwordRepeat) {
            array_push($errors, "兩組密碼不一致。");
        }
        $sql = "SELECT * FROM `member` WHERE `account` = '$account'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if (password_verify($old_password, $user["password"])) {
            array_push($errors, "舊密碼不一致。");
        }
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            $sql = "UPDATE `member` SET `password`='{$passwordHash}' WHERE `account`='{$_SESSION['account']}'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                unset($_SESSION["account"]);
                header("Location: login.php");
            } else {
                echo '密碼修改失敗！';
            }
        }
    }
    ?>

    <div class="col-sm-4 col-sm-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading"><b><font size="10" face="標楷體" color="#0000FF"><p align="center">修改會員密碼</font></div>
            <div class="panel-body">
                <form action="member_change_password.php" method="POST">
                    <p align="center"><font size="5"><b><strong>舊密碼</strong>
                    <input type="password" name="old-password"><br>
                    <p align="center"><b><strong>新密碼</strong>
                    <input type="password" name="new-password"><br>
                    <p align="center"><b><strong>確認密碼</strong>
                    <input type="password" name="confirm-password"><br><br>
                    <input type="submit" name="change" value="確認修改">
                    <input type="reset" name="reset" value="重設資料">
                </form>
            </div>
        </div>
    </div>

    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html> 
