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
    <?php include("navbar.php");

    if (isset($_GET["order_id"])) {
        $order_id = $_GET["order_id"];

        $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
        $RecMember = mysqli_query($conn, $query_RecMember);
        $row_Recmember = mysqli_fetch_assoc($RecMember);
        $member_id = $row_Recmember["id"];
        $query_order = "SELECT * FROM `food_order` WHERE `member_id` = '$member_id' AND `order_id` = '$order_id'";
        $Recorder = mysqli_query($conn, $query_order);
        $row_order = mysqli_fetch_assoc($Recorder);
        if (mysqli_num_rows($Recorder) == 0) {
            echo "<script>alert('沒有相關訂單可編輯'); window.location.href='order.php';</script>";
        }

        if (isset($_POST["order_edit"])) {
            $new_qty = $_POST["new_qty"];
            $new_remark = $_POST["new_remark"];

            $sql_update = "UPDATE `food_order` SET `quantity` = ?, `remark`= ? WHERE `order_id` = '$order_id' AND `member_id` = '$member_id' ";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql_update);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "ss", $new_qty, $new_remark);
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo "<script>alert('更改成功'); window.location.href='order.php';</script>";
                } else {
                    echo "<script>alert('更改失敗，可能沒有修改任何內容'); window.location.href='order.php';</script>";
                }
            } else {
                die("發生了一些錯誤！請洽管理員。");
            }
        }
        $query_food = "SELECT * FROM `food` WHERE `food_id` = '" . $row_order["food_id"] . "'";
        $food = mysqli_query($conn, $query_food);
        $Rec_food = mysqli_fetch_assoc($food);
        $query_store = "SELECT * FROM `store` WHERE `id` = '" . $Rec_food["store_id"] . "'";
        $store = mysqli_query($conn, $query_store);
        $Rec_store = mysqli_fetch_assoc($store);
    } else {
        header("Location: order.php");
    }
    ?>
    <div>
        <div class="container">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>訂單管理</h2>
                    </div>
                    <div class="panel-body">
                        <form action="order_edit.php?order_id=<?php echo $row_order["order_id"] ?>" method="post">
                            <label>品名</label>
                            <input type="text" value="<?php echo $Rec_food["food_name"] ?>" disabled> <br>
                            <label>製作店家</label>
                            <input type="text" value="<?php echo $Rec_store["storeName"] ?>" disabled><br>
                            <label>數量</label>
                            <input type="number" name="new_qty" value="<?php echo $row_order["quantity"] ?>" min="1"
                                max="50"><br>
                            <label>備註</label>
                            <input type="text" name="new_remark" value=""><br>
                            <input type="submit" name="order_edit" value="更改">
                        </form>
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