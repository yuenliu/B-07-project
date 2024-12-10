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
                        <h2>BMR 歷史紀錄</h2>
                    </div>
                    <div class="panel-body">
                        <?php
                        $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                        $RecMember = mysqli_query($conn, $query_RecMember);
                        $row_Recmember = mysqli_fetch_assoc($RecMember);

                        $sql_bmr = "SELECT * FROM `bmr` WHERE `member_id`='" . $row_Recmember["id"] . "'";
                        $RecBmr = mysqli_query($conn, $sql_bmr);

                        if (mysqli_num_rows($RecBmr) == 0) {
                            echo "<h3>尚無BMR紀錄！</h3>";
                        } else {
                            echo "<table border='1'><tr align='center'>
                            <th>填寫日期</th>
                                <th>性別</th>
                                <th>年齡</th>
                                <th>身高(cm)</th>
                                <th>體重(kg)</th>
                                <th>活動水平</th>
                                <th>BMR</th>
                                <th>TDEE</th>
                            </tr>";
                            while($rowBmr = mysqli_fetch_assoc($RecBmr)){
                                $query_bmr = "SELECT * FROM `bmr` WHERE `id` = '".$rowBmr["id"]."'";
                                $bmr = mysqli_query($conn,$query_bmr);
                                $Rec_bmr = mysqli_fetch_assoc($bmr);

                                echo "<tr>";
                                echo "<td>".$Rec_bmr["date"]."</td>";
                                echo "<td>".$Rec_bmr["gender"]."</td>";
                                echo "<td>".$Rec_bmr["age"]."</td>";
                                echo "<td>".$Rec_bmr["height"]."</td>";
                                echo "<td>".$Rec_bmr["weight"]."</td>";
                                echo "<td>".$Rec_bmr["activity_level"]."</td>";
                                echo "<td>".$Rec_bmr["bmr"]."</td>";
                                echo "<td>".$Rec_bmr["tdee"]."</td>";
                                echo "</tr>";

                            }
                            echo "</table><hr>";;
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