<?php
include("navbar.php");
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/register2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container-register100">
        <div class="registerform">
            <?php
            if (isset($_POST["submit"])) {
                $identity = $_POST["identity"];
                $account = $_POST["account"];
                $name = $_POST["name"];
                $gender = $_POST["gender"];
                $email = $_POST["email"];
                $phoneNumber = $_POST["phoneNumber"];
                $password = $_POST["password"];
                $passwordRepeat = $_POST["psw-repeat"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();

                if (
                    empty($name) or empty($gender) or empty($email)
                    or empty($phoneNumber) or empty($password) or empty($passwordRepeat)
                ) {
                    array_push($errors, "所有表格均需填入資料。");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email格式錯誤。");
                }
                if (strlen($password) < 8) {
                    array_push($errors, "密碼長度需大於8。");
                }
                if ($password !== $passwordRepeat) {
                    array_push($errors, "兩組密碼不一致。");
                }
                require_once "database.php";
                $sql = "SELECT * FROM `member` WHERE `account` = '$account'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    array_push($errors, "帳號已存在！");
                }
                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    $sql = "INSERT INTO `member` (`identity`,`name`, `gender`, `account`, `E-mail`, `phoneNumber`, `password`) VALUES (?,?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sssssss", $identity, $name, $gender, $account, $email, $phoneNumber, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>註冊成功！請到登入頁面登入。.</div>";
                    } else {
                        die("發生了一些錯誤！請洽管理員。");
                    }
                }
            } ?>
            *如果是店家註冊請使用負責人資料註冊一隻帳號即可。
            <form action="register2.php" method="post">
                <div class="input-block">
                    <label> 姓名 </label>
                    <input name="name" id="name" type="text" placeholder="請輸入名字">
                </div>

                <div class="input-block">
                    <label> 性別 </label>
                    <select name="gender" id="gender" class="custom-select">
                        <option selected>請選擇</option>
                        <option value="男生">男生</option>
                        <option value="女生">女生</option>
                    </select>
                    <br>
                </div>
                <div class="input-block">
                    <label> 身分 </label>
                    <select name="identity" id="identity" class="custom-select">
                        <option selected>請選擇
                        </option>
                        <option value="consumer">消費者</option>
                        <option value="store">店家</option>
                    </select>
                    <br>
                </div>
                <div class="input-block">
                    <label for="account"><b>帳號</b></label>
                    <input type="text" placeholder="輸入帳號" name="account" id="account" required>
                </div>
                <div class="input-block">
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="輸入您的Email" name="email" id="email" required>
                </div>
                <div class="input-block">
                    <label class="custom-control-label"> 手機號碼 </label>
                    <input type="text" placeholder="例如 : 0912345678" name="phoneNumber" id="phoneNumber" required>
                </div>
                <div class="input-block">
                    <label for="psw"><b>密碼</b></label>
                    <input type="password" placeholder="輸入密碼" name="password" id="password" required>
                </div>
                <div class="input-block">
                    <label for="psw-repeat"><b>確認密碼</b></label>
                    <input type="password" placeholder="確認密碼" name="psw-repeat" id="psw-repeat" required>
                </div>
                <button type="submit" class="btn-signup" value="Register" name="submit">註冊</button>
            </form>
        </div>
    </div>
</body>
