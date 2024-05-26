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
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-inverse fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand text-white">文大線上點餐系統</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item active"><a href="home.html">首頁</a></li>
                    <li class="nav-item"><a href="search.html">尋找餐廳</a></li>
                    <li class="nav-item"><a href="contact.html">連絡站長</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="notify.html"><span class="glyphicon glyphicon-bell"></span> 通知</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="forms-section">
        <h1 class="section-title">註冊</h1>
        <?php
        if (isset($_POST["submit"])) {
            $name = $_POST["name"];
            $gender = $_POST["gender"];
            $email = $_POST["email"];
            $phoneNumber = $_POST["phoneNumber"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["psw-repeat"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($name) or empty($email) or empty($password) or empty($passwordRepeat)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 charactes long");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM `consumer` WHERE `E-mail` = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "Email already exists!");
            }
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {

                $sql = "INSERT INTO `consumer` (`姓名`, `性別`, `E-mail`, `電話號碼`, `密碼`) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sssss", $name, $gender, $email, $phoneNumber, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                } else {
                    die("你在衝三小啦");
                }
            }


        }
        ?>
        <div class="forms">
            <div class="form-wrapper is-active">
                <button type="button" class="switcher switcher-login">
                    消費者
                    <span class="underline"></span>
                </button>
                <form class="form form-login" action="test.php" method="post">
                    <fieldset>
                        <legend>Please, enter your email and password for login.</legend>
                        <div class="input-block">
                            <label> 姓名 </label>
                            <input name="name" id="name" type="text" class="form-control" placeholder="請輸入名字">
                        </div>

                        <div class="input-block">
                            <label> 性別 </label>
                            <select name="gender" id="gender" class="custom-select">
                                <option selected>性別</option>
                                <option value="男生">男生</option>
                                <option value="女生">女生</option>
                            </select>
                            <br>
                        </div>
                        <div class="input-block">
                            <label for="email"><b>Email</b></label>
                            <input type="text" placeholder="輸入您的Email" name="email" id="email" required>
                        </div>
                        <div class="input-block">
                            <label class="custom-control-label"> 電話 </label>
                            <input type="text" placeholder="例如 : 0912345678" name="phoneNumber" id="phoneNumber"
                                required>
                        </div>
                        <div class="input-block">
                            <label for="psw"><b>密碼</b></label>
                            <input type="password" placeholder="輸入密碼" name="password" id="password" required>
                        </div>
                        <div class="input-block">
                            <label for="psw-repeat"><b>確認密碼</b></label>
                            <input type="password" placeholder="確認密碼" name="psw-repeat" id="psw-repeat" required>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn-signup" value="Register" name="submit">註冊</button>
                </form>
            </div>
            <div class="form-wrapper">
                <button type="button" class="switcher switcher-signup">
                    店家
                    <span class="underline"></span>
                </button>
                <form class="form form-signup">
                    <fieldset>
                        <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                        <div class="input-block">
                            <label class="custom-control-label"> 店家名稱 </label>
                            <input name="store" id="store" type="text" class="form-control" placeholder="請輸入店家名稱">
                        </div>

                        <div class="input-block">
                            <label class="custom-control-label"> 負責人姓名 </label>
                            <input name="st-name" id="st-name" type="text" class="form-control" placeholder="請輸入負責人姓名">
                        </div>
                        <div class="input-block">
                            <label class="custom-control-label"> 負責人手機號碼 </label>
                            <input name="phone" id="phone" type="text" class="form-control"
                                placeholder="例如 : 0912345678">
                        </div>

                        <div class="input-block">
                            <label class="custom-control-label"> 帳號 </label>
                            <input name="account" id="account" type="text" class="form-control" placeholder="請輸入帳號">
                        </div>

                        <div class="input-block">
                            <label class="custom-control-label"> E-mail </label>
                            <input name="email" id="email" type="text" class="form-control" placeholder="請輸入E-mail">
                        </div>

                        <div class="input-block">
                            <label class="custom-control-label"> 店家電話 </label>
                            <input name="call" id="call" type="text" class="form-control"
                                placeholder="例如 : 02-1234-5678">
                        </div>

                        <div class="input-block">
                            <label class="custom-control-label"> 店家地址 </label>
                            <input name="address" id="address" type="text" class="form-control" placeholder="請輸入店家地址">
                        </div>

                        <div class="input-block">
                            <label for="psw"><b>密碼</b></label>
                            <input type="password" placeholder="輸入密碼" name="psw" id="psw" required>
                        </div>

                        <div class="input-block">
                            <label for="psw-repeat"><b>確認密碼</b></label>
                            <input type="password" placeholder="確認密碼" name="psw-repeat" id="psw-repeat" required>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn-signup">註冊</button>
                </form>
            </div>
        </div>
    </section>
    <script src="js/register.js"></script>
</body>

</html>
