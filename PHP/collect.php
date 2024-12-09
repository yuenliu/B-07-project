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

    <!-- 內容 -->
    <div class="container">
        <h2>我的收藏餐廳</h2>
        <?php
        session_start();
        $sql_query = "SELECT `id`,`storeName`,`online_state`,`store_image` FROM `store`";
        $result = mysqli_query($conn, $sql_query);
        $num_rows = mysqli_num_rows($result);
        $counter = 0;

        $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
        $RecMember = mysqli_query($conn, $query_RecMember);
        $row_Recmember = mysqli_fetch_assoc($RecMember);
        $member_id = $row_Recmember["id"];

        $sql_query_favorites = "SELECT s.id, s.storeName, s.online_state, s.store_image FROM `store` s JOIN `favorites` f ON s.id = f.store_id WHERE f.member_id = $member_id";
        $result = mysqli_query($conn, $sql_query_favorites);
        if (mysqli_num_rows($result) > 0) {
            $counter = 0;
            echo "<div class='row'>";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($counter > 0 && $counter % 3 == 0) {
                    echo "</div><div class='row'>";
                }
                $store_id = $row['id']; // Display the store information 
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
                echo "<th><a href='remove_favorite.php?storeid=" . $store_id . "' class='btn btn-danger'>取消收藏</a></th>";
                echo "</table></div>";
                $counter++;
            }
            echo "</div>";
        } else {
            echo "<p>您還沒有收藏任何店家。</p>";
        }
        ;
        ?>

    </div>

    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>

</html>
