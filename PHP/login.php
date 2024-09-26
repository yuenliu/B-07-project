<html>
<?php
session_start();
if (isset($_SESSION["account"]) || $_SESSION["account"] != "") {
    header("Location:member_center.php");
}
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
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <nav class="navbar navbar-inverse fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand text-white">文大線上點餐系統</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="home.html">首頁</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="contact.html"> 聯絡管理員</a></li>
                    <li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> 註冊</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <section id="content">
            <form action="login.php" method="post">
                <?php
                if (isset($_POST["login"])) {
                    $account = $_POST["account"];
                    $password = $_POST["password"];
                    require_once "database.php";
                    $sql = "SELECT * FROM `member` WHERE `account` = '$account'";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if ($user) {
                        if (password_verify($password, $user["password"])) {
                            session_start();
                            $_SESSION["account"] = $account;
                            //使用Cookie記錄登入資料
                            if (isset($_POST["remember"]) && ($_POST["remember"] == "true")) {
                                setcookie("account", $_POST["account"], time() + 2 * 60 * 60);
                                setcookie("password", $_POST["password"], time() + 2 * 60 * 60);
                            } else {
                                if (isset($_COOKIE["account"])) {
                                    setcookie("account", $_POST["account"], time() - 100);
                                    setcookie("password", $_POST["password"], time() - 100);
                                }
                            }
                            header("Location: member_center.php");
                        } else {
                            echo "<div class='alert alert-danger'>密碼錯誤</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>帳號不存在</div>";
                    }
                }
                ?>
                <h1>登入</h1>
                <div>
                    <input type="text" placeholder="帳號" required="" id="account" name="account" />
                </div>
                <div>
                    <input type="password" placeholder="請輸入密碼" required="" id="password" name="password" />
                </div>
                <div>
                    <input type="submit" value="登入" name="login" id="login">
                    <a href="forgetpsw.php">忘記密碼?</a>
                    <a href="register.php">尚未註冊</a>
                </div>

                <label>
                    <input type="checkbox" checked="checked" name="remember"> 記住我
                </label>
            </form><!-- form -->
        </section><!-- content -->
    </div>

    </div>
    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
