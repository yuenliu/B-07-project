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
        ?>
        <!--內容-->
        <div class="container">
            <?php
            session_start();
            $sql_query = "SELECT `id`,`storeName`,`online_state`,`store_image` FROM `store`";
            $result = mysqli_query($conn, $sql_query);
            $num_rows = mysqli_num_rows($result);
            $counter = 0;
            echo "<div class='row'>";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($counter > 0 && $counter % 3 == 0) {
                    echo "</div><div class='row'>";
                }
                echo "<a href='res_list.php?storeid=" . $row["id"] . "'>";
                echo "<div class='col panel panel-default col-md-4'>";
                echo "<div class='panel-heading'><img src='storeimg/" . $row["store_image"] . "' style='width:300px; height:200px;' /></div></a>";
                echo "<table class='table'>";
                echo "<th>" . $row["storeName"] . "</th>";
                echo "<th>";
                if (!$row["online_state"]) {
                    echo "非營業中";
                } else {
                    echo "營業中";
                }
                echo "</th>";
                echo "</table></div>";
                $counter++;
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
