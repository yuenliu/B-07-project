<?php
    include("navbar.php");
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
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/register.css">

</head>

<body>
    <div>
        <?php
            if (isset($_POST["submit"])) {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $subject = $_POST["subject"];

                $errors = array();

                if (empty($name) or empty($email) or empty($subject)) {
                    array_push($errors, "所有表格均需填入資料。");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email格式錯誤。");
                }

                require_once "database.php";

                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    $sql = "INSERT INTO `contact` (`name`, `E-mail`, `subject`) VALUES (?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $subject);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>成功送出。</div>";
                    } else {
                        die("發生了一些錯誤！請洽管理員。");
                    }
            }

        ?>

        <!--內容-->
        <div class="container">
            <h1><span class="glyphicon glyphicon-envelope"></span> 聯絡管理員 ⬇️</h1>
            <div class="clearfix visible-xs visible-lg"></div>
            <div class="row">
                <div class="col-lg-6 col-xs-8">
                    <h3>電子信箱 ✉ : B0248059@ulive.pccu.edu.tw&nbsp;&nbsp;劉宇恩
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        B0210353@ulive.pccu.edu.tw&nbsp;&nbsp;黃俊嘉
                    </h3>
                </div>
                <div class="clearfix visible-md visible-xs"></div>
            </div><!-- end nested row 3a -->
            <form action="contact.php" method="POST">
                <label for="fname">姓名</label>
                <input type="text" id="name" name="name" placeholder="輸入姓名">

                <label for="lname">E-mail</label>
                <input type="text" id="email" name="email" placeholder="輸入email">

                <label for="subject">輸入問題</label>
                <textarea id="subject" name="subject" placeholder="請輸入您遇到的問題..." style="height:200px"></textarea>

                <input type="submit" value="送出" name="submit">

            </form>
        </div>

    </div>
    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>