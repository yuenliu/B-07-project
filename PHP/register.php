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
                    <li class="nav-item"><a href="home.html">首頁</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a href="contact.html">聯絡管理員</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> 登入</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="forms-section">
        <h1 class="section-title">註冊</h1>
        <div class="forms">
            <?php
            if (isset($_POST["c_submit"])) {
                $identity = "consumer";
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
                        mysqli_stmt_bind_param($stmt, "sssssss", $identity,$name, $gender, $account, $email, $phoneNumber, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>註冊成功！請到登入頁面登入。.</div>";
                    } else {
                        die("發生了一些錯誤！請洽管理員。");
                    }
                }
            } elseif (isset($_POST["s_submit"])) {
                $identity = "store";
                $account = $_POST["s_account"];
                $storeName = $_POST["storeName"];
                $st_name = $_POST["st_name"];
                $phoneNumber = $_POST["s_phoneNumber"];
                $email = $_POST["s_email"];
                $storeNumber = $_POST["storePhoneNumber"];
                $address = $_POST["storeAddress"];
                $password = $_POST["psw"];
                $passwordRepeat = $_POST["psw-repeat"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();

                if (
                    empty($account) or empty($storeName) or empty($st_name) or empty($phoneNumber) or empty($email)
                    or empty($storeNumber) or empty($address) or empty($password) or empty($passwordRepeat)
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
                $sql = "SELECT * FROM `store` WHERE `E-mail` = '$email'";
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

                    $sql = "INSERT INTO `member` (`identity`,`storeName`, `name`, `phoneNumber`, `E-mail`, `account`, `storePhoneNumber`, `storeAddress`, `password`) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sssssssss", $identity, $storeName, $st_name, $phoneNumber, $email, $account, $storeNumber, $address, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>註冊成功！請到登入頁面登入。</div>";
                    } else {
                        die("發生了一些錯誤！請洽管理員。");
                    }
                }
            }
            ?>
            <div class="form-wrapper is-active">
                <button type="button" class="switcher switcher-login">
                    消費者
                    <span class="underline"></span>
                </button>
                <form class="form form-login" action="register.php" method="post">
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
                            <label for="account"><b>帳號</b></label>
                            <input type="text" placeholder="輸入帳號" name="account" id="account" required>
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
                    <button type="submit" class="btn-signup" value="Register" name="c_submit">註冊</button>
                </form>
            </div>
            <div class="form-wrapper">
                <button type="button" class="switcher switcher-signup">
                    店家
                    <span class="underline"></span>
                </button>
                <form class="form form-signup" action="register.php" method="post">
                    <fieldset>
                        <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                        <div class="input-block">
                            <label class="custom-control-label"> 店家名稱 </label>
                            <input name="storeName" id="storeName" type="text" class="form-control"
                                placeholder="請輸入店家名稱">
                        </div>

                        <div class="input-block">
                            <label class="custom-control-label"> 負責人姓名 </label>
                            <input name="st_name" id="st_name" type="text" class="form-control" placeholder="請輸入負責人姓名">
                        </div>
                        <div class="input-block">
                            <label class="custom-control-label"> 負責人手機號碼 </label>
                            <input name="s_phoneNumber" id="s_phoneNumber" type="text" class="form-control"
                                placeholder="例如 : 0912345678">
                        </div>

                        <div class="input-block">
                            <label class="custom-control-label"><b>帳號</b></label>
                            <input type="text" placeholder="輸入帳號" name="s_account" id="s_account" required>
                        </div>

                        <div class="input-block">
                            <label class="custom-control-label"> E-mail </label>
                            <input name="s_email" id="s_email" type="text" class="form-control" placeholder="請輸入E-mail">
                        </div>

                        <div class="input-block">
                            <label class="custom-control-label"> 店家電話 </label>
                            <input name="storePhoneNumber" id="storePhoneNumber" type="text" class="form-control"
                                placeholder="例如 : (02)1234-5678">
                        </div>

                        <div class="input-block">
                            <label class="custom-control-label"> 店家地址 </label>
                            <input name="storeAddress" id="storeAddress" type="text" class="form-control"
                                placeholder="請輸入店家地址">
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
                    <button type="submit" class="btn-signup" name="s_submit">註冊</button>
                </form>
            </div>
        </div>
    </section>
    <script src="js/register.js"></script>
</body>

</html>
