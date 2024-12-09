<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="中國文化大學113年畢業專題製作，組別B-07">
    <title>文大線上點餐系統</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div>
        <?php include("navbar.php"); ?>
        <div class="container">
            <?php
            if (isset($_POST["add_to_cart"])) {
                $foodid = $_POST["foodid"];
                $remark = $_POST["remark"];
                $quantity = $_POST["quantity"];

                session_start();
                $sql_query = "SELECT * FROM `member` WHERE `account` = '" . $_SESSION["account"] . "'";
                $result = mysqli_query($conn, $sql_query);
                $row = mysqli_fetch_assoc($result);
                $member_id = $row["id"];

                $sql_cart = "SELECT * FROM `cart` WHERE `food_id` = '$foodid' AND `member_id` = '$member_id' ";
                $cart_result = mysqli_query($conn, $sql_cart);
                if (mysqli_num_rows($cart_result) == 0) {
                    $sql = "INSERT INTO `cart` (`member_id`, `food_id`, `quantity`, `remark`) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "ssss", $member_id, $foodid, $quantity, $remark);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>加入成功！</div>";
                    } else {
                        die("發生了一些錯誤！請洽管理員。");
                    }
                } else {
                    $row_cart = mysqli_fetch_assoc($cart_result);
                    $new_qty = $row_cart["quantity"] + $quantity;
                    $sql_update = "UPDATE `cart` SET `quantity` = ?, `remark` = ? WHERE `food_id` = '$foodid' AND `member_id` = '$member_id' ";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql_update);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "ss", $new_qty, $remark);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>追加成功！</div>";
                    } else {
                        die("發生了一些錯誤！請洽管理員。");
                    }
                }
            }
            session_start();
            if (isset($_GET['storeid'])) {
                $id = $_GET['storeid'];
                $sql_query = "SELECT * FROM `store` WHERE `id` = '$id'";
                $result = mysqli_query($conn, $sql_query);
                $row = mysqli_fetch_assoc($result);
            } else {
                header("Location: res_list.php");
            }

            $store_query = "SELECT * FROM `store` WHERE `id`='" . $row["id"] . "'";
            $storeresult = mysqli_query($conn, $store_query);
            $row_Recstore = mysqli_fetch_assoc($storeresult);

            echo "<h1><b>" . $row_Recstore["storeName"] . "</b></h1>";
            echo "<h3>店家電話：" . $row_Recstore["storePhoneNumber"] . "</h3>";
            echo "<h3>店家地址：" . $row_Recstore["storeAddress"] . "</h3>";
            echo "<h3>營業時間：</h3>";

            $business_sql = "SELECT * FROM `business_hours` WHERE `store_id`='" . $row["id"] . "'";
            $storeresult = mysqli_query($conn, $business_sql);
            $row_business = mysqli_fetch_assoc($storeresult);
            if ($row_business["weekdays"] == true) {
                $weekdays = "休假";
            } else {
                $weekdays = $row_business["weekdays_open"] . "~" . $row_business["weekdays_close"];
            }
            if ($row_business["holidays"] == true) {
                $holidays = "休假";
            } else {
                $holidays = $row_business["holiday_open"] . "~" . $row_business["holiday_close"];
            }
            echo "<h4>平日：" . $weekdays . "</h4>";
            echo "<h4>假日：" . $holidays . "</h4>";
            if ($row_business["special_time"] !== null) {
                echo "<h4>其他：" . $row_business["special_time"] . "<h4>";
            }
            if ($row_business["vacation_open"] == true) {
                echo "<h4 style='color: red;'>寒暑假不營業<h4>";
            }
            ?>
            <hr>
            <?php
            $store_id = $row_Recstore["id"];
            $sql_query = "SELECT `food_id`,`food_image`,`food_name`,`food_price` FROM `food` WHERE `store_id` = $store_id ";
            $result = mysqli_query($conn, $sql_query);
            $num_rows = mysqli_num_rows($result);
            $counter = 0;
            echo "<div class='rowfood'>";
            while ($rowfood = mysqli_fetch_assoc($result)) {
                if ($counter > 0 && $counter % 3 == 0) {
                    echo "</div><div class='rowfood'>";
                }
                echo "<div class='col panel panel-default col-md-4'>";
                echo "<div class='panel-heading'><img src='foodimg/" . $rowfood["food_image"] . "' style='width:300px; height:200px;' /></div>";
                echo "<table class='table'>";
                echo "<th>餐點名稱 : " . $rowfood["food_name"] . "</th>";
                echo "<th>";
                echo "<th>價錢 : " . $rowfood["food_price"] . "</th>";
                echo "</th>";
                echo "<th><button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#foodid_" . $rowfood["food_id"] . "'>查看詳情</button></th>";
                echo "</table></div>";
                $counter++;
            }
            echo "</div>";
            $sql_query = "SELECT `food_id`,`food_image`,`food_name`,`food_price` FROM `food` WHERE `store_id` = $store_id ";
            $result = mysqli_query($conn, $sql_query);
            echo "<div class='rowmodal'>";
            while ($rowfood = mysqli_fetch_assoc($result)) {
                echo "<div class='modal fade' id='foodid_" . $rowfood["food_id"] . "' role='dialog'>";
                echo "<div class='modal-dialog'>
                        <!-- Modal content-->
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h4 class='modal-title'>確認內容</h4>
                            </div>
                        <form action='menu.php?storeid=" . $store_id . "' method='post'><div class='modal-body'>";
                echo "<input type='hidden' name='foodid' value=" . $rowfood["food_id"] . ">";
                echo "<p>餐點名稱：" . $rowfood["food_name"] . "</p>";
                echo "<p>餐點介紹：" . $rowfood["food_detail"] . "</p>";
                echo "<label>數量</label><input type='number' name='quantity' value='1' min='1' max='50'><br>";
                echo "<label>備註</label><input type='text' name='remark'>";
                echo "<p class='right'>單價：" . $rowfood["food_price"] . "$</p>";
                echo "</div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-warning' data-dismiss='modal'>返回</button>
                  <input type='submit' class='btn btn-success' name='add_to_cart' value='加入購物車'>
                        </div></form>
                    </div>
                    </div>
                    </div>
                    </div>";
            }
            echo "</div>";
            ?>
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
