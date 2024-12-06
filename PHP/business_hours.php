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
</head>


<body>
    <div>
        <!--topbar-->
        <?php
        include("navbar.php");

        if (isset($_POST["submit"])) {
            $weekdays_open = $_POST["weekdays_open"];
            $weekdays_close = $_POST["weekdays_close"];
            $weekdays = $_POST["weekdays"];
            $holiday_open = $_POST["holiday_open"];
            $holiday_close = $_POST["holiday_close"];
            $holidays = $_POST["holidays"];
            $special_time = $_POST["special_time"];
            $vacation_open = $_POST["vacation_open"];

            $errors = array();
            if ((empty($weekdays_open) || empty($weekdays_close)) && $weekdays == false) {
                array_push($errors, "平日營業未設定。");
            }
            if ((empty($holiday_open) || empty($holiday_close)) && $holidays == false) {
                array_push($errors, "假日營業未設定。");
            }
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                session_start();
                $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                $RecMember = mysqli_query($conn, $query_RecMember);
                $row_Recmember = mysqli_fetch_assoc($RecMember);
                $store_query = "SELECT * FROM `store` WHERE `member_id`='" . $row_Recmember["id"] . "'";
                $storeresult = mysqli_query($conn, $store_query);
                $row_Recstore = mysqli_fetch_assoc($storeresult);

                $store_id = $row_Recstore["id"];
                $sql = "SELECT * FROM `business_hours` WHERE `store_id` = $store_id";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 0) {
                    $sql = "INSERT INTO `business_hours` (`store_id`,`weekdays_open`, `weekdays_close`, `weekdays`,`holiday_open`,`holiday_close`,`holidays`,`vacation_open`,`special_time`) VALUES (?,?, ?, ?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param(
                            $stmt,
                            "sssssssss",
                            $store_id,
                            $weekdays_open,
                            $weekdays_close,
                            $weekdays,
                            $holiday_open,
                            $holiday_close,
                            $holidays,
                            $vacation_open,
                            $special_time
                        );
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>設定成功！</div>";
                    } else {
                        die("發生了一些錯誤！請洽管理員。");
                    }
                } else {
                    $sql_update = "UPDATE `business_hours` SET `weekdays_open` = '$weekdays_open', `weekdays_close` = '$weekdays_close'
                        , `weekdays` = '$weekdays', `holiday_open` = '$holiday_open',
                        `holiday_close` = '$holiday_close', `holidays` = '$holidays',
                         `vacation_open` = '$vacation_open', `special_time` = '$special_time' WHERE `store_id` = '$store_id'";

                    mysqli_query($conn, $sql_update);
                    echo "<div class='alert alert-success'>更改成功！</div>";
                }

            }
        }
        $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
        $RecMember = mysqli_query($conn, $query_RecMember);
        $row_Recmember = mysqli_fetch_assoc($RecMember);
        $store_query = "SELECT * FROM `store` WHERE `member_id`='" . $row_Recmember["id"] . "'";
        $storeresult = mysqli_query($conn, $store_query);
        $row_Recstore = mysqli_fetch_assoc($storeresult);
        $query_business = "SELECT * FROM `business_hours` WHERE `store_id` = '" . $row_Recstore["id"] . "'";
        $RecBusiness = mysqli_query($conn, $query_business);
        $row_RecBusiness = mysqli_fetch_assoc($RecBusiness);
        ?>
        <!--內容-->
        <div class="container">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>營業時間設定</p>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                                <form action="business_hours.php" method="POST">
                                    <tr>
                                        <th>平日</th>
                                        <th><label>開始營業</label><input type="time" name="weekdays_open" value=<?php if ($row_RecBusiness["weekdays_open"])
                                            echo $row_RecBusiness["weekdays_open"];
                                        else
                                            echo "07:00" ?>></th>
                                            <th><label>結束營業</label><input type="time" name="weekdays_close" value=<?php if ($row_RecBusiness["weekdays_close"])
                                            echo $row_RecBusiness["weekdays_close"];
                                        else
                                            echo "17:00" ?>></th>
                                            <th><label> 休假 </label>
                                                <select name="weekdays" id="weekdays">
                                                    <option selected>請選擇</option>
                                                    <option value="1" <?php if($row_RecBusiness["weekdays"]==true) echo "selected"?>>是</option>
                                                    <option value="0" <?php if($row_RecBusiness["weekdays"]==false) echo "selected"?>>否</option>
                                                </select>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>假日</th>
                                            <th><label>開始營業</label><input type="time" name="holiday_open" value=<?php if ($row_RecBusiness["holiday_open"])
                                            echo $row_RecBusiness["holiday_open"];
                                        else
                                            echo "07:00" ?>>
                                            </th>
                                            <th><label>結束營業</label><input type="time" name="holiday_close" value=<?php if ($row_RecBusiness["holiday_close"])
                                            echo $row_RecBusiness["holiday_close"];
                                        else
                                            echo "07:00" ?>>
                                            </th>
                                            <th><label> 休假 </label>
                                                <select name="holidays" id="holidays">
                                                    <option selected>請選擇</option>
                                                    <option value="1" <?php if($row_RecBusiness["holidays"]==true) echo "selected"?>>是</option>
                                                    <option value="0" <?php if($row_RecBusiness["holidays"]==false) echo "selected"?>>否</option>
                                                </select>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th><label for="special_time">特殊</label></th>
                                            <th><input type="text" name="special_time"></th>
                                        </tr>
                                        <tr>
                                            <th><label> 寒暑假不營業 </label>
                                                <select name="vacation_open" id="vacation_open">
                                                    <option selected>請選擇</option>
                                                    <option value="1" <?php if($row_RecBusiness["vacation_open"]==true) echo "selected"?>>是</option>
                                                    <option value="0" <?php if($row_RecBusiness["vacation_open"]==false) echo "selected"?>>否</option>
                                                </select>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th><input type="submit" name="submit"></th>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--底部-->
        <footer class="fixed-bottom text-center text-lg-start">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                中國文化大學畢業專題製作B-07組
            </div>
        </footer>
        </div>
        <!-- javascript -->
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>

    </html>
