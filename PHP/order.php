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
    <link rel="stylesheet" href="css/account_manage.css">
</head>

<body>
    <?php
    include("navbar.php");
    ?>

    <div>
        <div class="container">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>訂單管理</h2>
                    </div>
                    <div class="panel-body">
                        <table border="1">
                            <tbody>
                                <?php
                                $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                                $RecMember = mysqli_query($conn, $query_RecMember);
                                $row_Recmember = mysqli_fetch_assoc($RecMember);

                                $member_id = $row_Recmember["id"];
                                if ($row_Recmember["identity"] == "consumer") {
                                    $query_order = "SELECT * FROM `food_order` WHERE `member_id` = '$member_id'";
                                    $Recorder = mysqli_query($conn, $query_order);
                                    if (mysqli_num_rows($Recorder) == 0) {
                                        echo "<h3>訂單空空的喔～快去瀏覽商家吧！</h3>";
                                    } else {
                                        echo "<tr align='center'>
                                            <th>訂單編號</th>
                                            <th>商品名稱</th>
                                            <th>製作商家</th>
                                            <th>數量</th>
                                            <th>總價</th>
                                            <th>備註</th>
                                            <th>建立時間</th>
                                            <th>修改/狀態</th>
                                            </tr>";
                                        while ($row_order = mysqli_fetch_assoc($Recorder)) {
                                            echo "<tr>";
                                            echo "<td>" . $row_order["order_id"] . "</td>";
                                            $query_food = "SELECT * FROM `food` WHERE `food_id` = '" . $row_order["food_id"] . "'";
                                            $food = mysqli_query($conn, $query_food);
                                            $Rec_food = mysqli_fetch_assoc($food);
                                            $query_store = "SELECT * FROM `store` WHERE `id` = '" . $Rec_food["store_id"] . "'";
                                            $store = mysqli_query($conn, $query_store);
                                            $Rec_store = mysqli_fetch_assoc($store);
                                            echo "<td>" . $Rec_food["food_name"] . "</td>";
                                            echo "<td>" . $Rec_store["storeName"] . "</td>";
                                            echo "<td>" . $row_order["quantity"] . "</td>";
                                            echo "<td>" . $row_order["quantity"] * $Rec_food["food_price"] . "</td>";
                                            echo "<td>" . $row_order["remark"] . "</td>";
                                            echo "<td>" . $row_order["day"] . " " . $row_order["time"] . "</td>";
                                            echo "<td>";
                                            switch ($row_order["order_state"]) {
                                                case 0:
                                                    echo "訂單已建立。<br><a href='order_edit.php?order_id=" . $row_order["order_id"] . "' class='btn btn-warning'>修改</a>
                                                        <a href='order_cancel.php?order_id=" . $row_order["order_id"] . "' class='btn btn-danger'>取消</a>";
                                                    break;
                                                case 1:
                                                    echo "店家製作中。";
                                                    break;
                                                case 2:
                                                    echo "請盡速領取餐點。<br><a href='order_edit.php?order_id=" . $row_order["order_id"] . "' class='btn btn-success'>確認領取</a>";
                                                    break;
                                                case 3:
                                                    echo "已領取。";
                                                    break;
                                                case 4:
                                                    echo "店家回報放鳥。";
                                                    break;
                                                case 5:
                                                    echo "訂單已被您取消。";
                                                    break;
                                                case 6:
                                                    echo "訂單已被店家取消。";
                                                    break;
                                                default:
                                                    echo "錯誤！";
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                                if ($row_Recmember["identity"] == "store") {
                                    $store_query = "SELECT * FROM `store` WHERE `member_id`='$member_id'";
                                    $storeresult = mysqli_query($conn, $store_query);
                                    $row_Recstore = mysqli_fetch_assoc($storeresult);
                                    $store_id = $row_Recstore["id"];
                                    $query_order = "SELECT * FROM `food_order` WHERE `store_id` = '$store_id'";
                                    $Recorder = mysqli_query($conn, $query_order);
                                    if (mysqli_num_rows($Recorder) == 0) {
                                        echo "<h3>訂單空空的喔～請等待顧客下單！</h3>";
                                    } else {
                                        echo "<tr align='center'>
                                            <th>訂單編號</th>
                                            <th>顧客姓名</th>
                                            <th>商品名稱</th>
                                            <th>數量</th>
                                            <th>總價</th>
                                            <th>備註</th>
                                            <th>建立時間</th>
                                            <th>修改/狀態</th>
                                            </tr>";
                                        while ($row_order = mysqli_fetch_assoc($Recorder)) {
                                            echo "<tr>";
                                            echo "<td>" . $row_order["order_id"] . "</td>";
                                            $query_food = "SELECT * FROM `food` WHERE `food_id` = '" . $row_order["food_id"] . "'";
                                            $food = mysqli_query($conn, $query_food);
                                            $Rec_food = mysqli_fetch_assoc($food);
                                            $query_orderm = "SELECT * FROM `member` WHERE `id` = '" . $row_order["member_id"] . "'";
                                            $orderm = mysqli_query($conn, $query_orderm);
                                            $Rec_orderm = mysqli_fetch_assoc($orderm);
                                            echo "<td>" . $Rec_food["food_name"] . "</td>";
                                            echo "<td>" . $Rec_orderm["name"] . "</td>";
                                            echo "<td>" . $row_order["quantity"] . "</td>";
                                            echo "<td>" . $row_order["quantity"] * $Rec_food["food_price"] . "</td>";
                                            echo "<td>" . $row_order["remark"] . "</td>";
                                            echo "<td>" . $row_order["day"] . " " . $row_order["time"] . "</td>";
                                            echo "<td>";
                                            switch ($row_order["order_state"]) {
                                                case 0:
                                                    echo "訂單已建立。<br><a href='order_edit.php?order_id=" . $row_order["order_id"] . "' class='btn btn-success'>接單製作</a>
                                                        <a href='order_cancel.php?order_id=" . $row_order["order_id"] . "' class='btn btn-danger'>取消</a>";
                                                    break;
                                                case 1:
                                                    echo "餐點製作中。<br><a href='order_edit.php?order_id=" . $row_order["order_id"] . "' class='btn btn-success'>通知取餐</a>
                                                        <a href='order_cancel.php?order_id=" . $row_order["order_id"] . "' class='btn btn-danger'>取消</a>";
                                                    break;
                                                case 2:
                                                    echo "已通知顧客取餐。<br><a href='order_edit.php?order_id=" . $row_order["order_id"] . "' class='btn btn-danger'>回報顧客放鳥</a>";
                                                    break;
                                                case 3:
                                                    echo "顧客已領取。";
                                                    break;
                                                case 4:
                                                    echo "已回報放鳥。";
                                                    break;
                                                case 5:
                                                    echo "訂單已被顧客取消。";
                                                    break;
                                                case 6:
                                                    echo "訂單已被您取消。";
                                                    break;
                                                default:
                                                    echo "錯誤！";
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                                if ($row_Recmember["identity"] == "root") {
                                    echo "測試用，現在是管理員身分";
                                }
                                ?>


</body>

</html>
