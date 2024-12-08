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
    <div>
        <?php
        include("navbar.php");
        ?>
        <div class="container">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>購物車</h2>
                    </div>
                    <div class="panel-body">
                        <?php
                        $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                        $RecMember = mysqli_query($conn, $query_RecMember);
                        $row_Recmember = mysqli_fetch_assoc($RecMember);
                        $sql_cart = "SELECT * FROM `cart` WHERE `member_id`='" . $row_Recmember["id"] . "'";
                        $RecCart = mysqli_query($conn, $sql_cart);

                        if (mysqli_num_rows($RecCart) == 0) {
                            echo "<h3>購物車空空的喔～快去瀏覽商家吧！</h3>";
                        } else {
                            echo "<table border='1'><tr align='center'>
                            <th>餐點名稱</th>
                                <th>店家</th>
                                <th>價格</th>
                                <th>數量</th>
                                <th>備註</th>
                                <th>修改</th>
                            </tr>";
                            $total_price = 0;
                            while($rowCart = mysqli_fetch_assoc($RecCart)){
                                $query_food = "SELECT * FROM `food` WHERE `food_id` = '".$rowCart["food_id"]."'";
                                $food = mysqli_query($conn,$query_food);
                                $Rec_food = mysqli_fetch_assoc($food);

                                $query_store = "SELECT * FROM `store` WHERE `id` = '".$Rec_food["store_id"]."'";
                                $store = mysqli_query($conn,$query_store);
                                $Rec_store = mysqli_fetch_assoc($store);

                                echo "<tr>";
                                echo "<td>".$Rec_food["food_name"]."</td>";
                                echo "<td>".$Rec_store["storeName"]."</td>";
                                echo "<td>".$Rec_food["food_price"]."</td>";
                                echo "<td>".$rowCart["quantity"]."</td>";
                                echo "<td><input type='text' value=".$rowCart["remark"]."></td>";
                                echo "<td><a href='cart_delete.php?food_id=".$Rec_food["food_id"]."' class='btn btn-danger'>刪除</a></td>";

                                echo "</tr>";
                                $total_price += $Rec_food["food_price"] * $rowCart["quantity"];
                            }
                            echo "</table><hr>";
                            echo "<p align='right'>總金額：".$total_price."$</p>";
                            echo "<hr>
                        <p align='right'>
                            <a href='cart_delete.php?food_id=all' class='btn btn-danger'>清空購物車</a>
                            <a href='cart_submit.php' class='btn btn-primary'>提交訂單</a>
                        </p>";
                        }
                        ?>
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
