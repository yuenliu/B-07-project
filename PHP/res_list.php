<?php
include("navbar.php");
session_start();
require_once("login_check.php");
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
</head>

<body>
    <div>
        <!--內容-->
        <div class="container">
            <?php
            session_start();
            $sql_query = "SELECT `id`,`storeName`,`online_state`,`store_image` FROM `store`";
            $result = mysqli_query($conn, $sql_query);
            $num_rows = mysqli_num_rows($result);
            $counter = 0;

            $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
            $RecMember = mysqli_query($conn,$query_RecMember);
            $row_Recmember = mysqli_fetch_assoc($RecMember);
            $member_id = $row_Recmember["id"];

            echo "<div class='row'>";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($counter > 0 && $counter % 3 == 0) {
                    echo "</div><div class='row'>";
                }
                $store_id = $row['id'];

                // 檢查該店家是否已被當前用戶收藏
                $check_favorite = "SELECT * FROM `favorites` WHERE `member_id` = $member_id AND `store_id` = $store_id";
                $favorite_result = mysqli_query($conn, $check_favorite);
                $is_favorite = mysqli_num_rows($favorite_result) > 0 ? true : false;

                echo "<a href='menu.php?storeid=" . $row["id"] . "'>";
                echo "<div class='col panel panel-default col-md-4'>";
                echo "<div class='panel-heading'><img src='storeimg/" . $row["store_image"] . "' style='width:320px; height:200px;' /></div></a>";
                echo "<table class='table'>";
                echo "<th>餐廳名稱 : " . $row["storeName"] . "</th>";
                echo "<th>";
                if (!$row["online_state"]) {
                    echo "非營業中";
                } else {
                    echo "營業中";
                }
                echo "</th>";
                echo "<th>";
                if ($is_favorite) {
                    echo "<th><a href='remove_favorite.php?storeid=" . $store_id . "' class='btn btn-danger'>取消收藏</a></th>";
                } else {
                    echo "<th><a href='add_favorite.php?storeid=" . $store_id . "' class='btn btn-success'>加入收藏</a></th>";
                }    
                echo "</th>";          
                echo "</table></div>";
                $counter++;
            }
            echo "</div>";
            ?>
        </div>
    </div>
    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
