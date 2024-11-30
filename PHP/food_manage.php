<?php
    include("navbar.php");
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

    <link rel="stylesheet" href="css/food_manage.css">

</head>

<body>
    <div class="row">
                <div class="caption" style="display: flex; justify-content: center; align-items: center; width: 100%;">
                    <p style="margin: 0 20px;">
                        <a href="food_upload.php" class="btn btn-success btn-lg">
                            <b><font size="6">新增餐點</font></b>
                        </a>
                    </p>
                    <p style="margin: 0 20px;">
                        <a href="food_upload.php" class="btn btn-info btn-lg">
                            <b><font size="6">編輯餐點</font></b>
                        </a>
                    </p>          
                </div>
    </div><!-- end nested row 3a -->
    <?php
    require_once("database.php");
    $select_db = @mysqli_select_db($conn, "food");
    $sql_query = "SELECT `foodimage`,`foodname`,`fooddetail`,`foodprice`,`foodcalorie` FROM `food`";
    $result = mysqli_query($conn, $sql_query);

    echo "<h2>餐點列表</h2>";
    echo "
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 25px;
        }
        th, td {
            border: 2px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 300px;
            height: 200px;
            object-fit: cover;
        }
    </style>
    ";

    echo "<table>";
    echo "<th>餐點圖片(僅供參考)</th>";
    echo "<th>餐點名稱</th>";
    echo "<th>餐點介紹</th>";
    echo "<th>餐點價錢</th>";
    
    echo "<th>餐點卡路里</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_row($result)) {
        echo "<tr>";
        for ($j = 0; $j < mysqli_num_fields($result); $j++){
            if ($j==0)
            echo"<td><img style='width:300px; height=200px;' src='foodimg/".$row[$j]."'/></td>";
            else
            echo"<td>".$row[$j]."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    mysqli_close($conn);
    ?>
</body>
</html>
