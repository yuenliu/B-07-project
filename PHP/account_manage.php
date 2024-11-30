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
    <link rel="stylesheet" href="css/account_manage.css">

</head>

<body>
    <?php
    include("navbar.php");
    $select_db = @mysqli_select_db($conn, "member");
    $sql_query = "SELECT `id`,`account`,`gender`,`name`,`phoneNumber`,`E-mail` FROM `member` where `identity`='consumer'";
    $result = mysqli_query($conn, $sql_query);

    //印consumer表
    echo "<h2 class='col-sm-offset-2'>顧客列表</h2>";
    echo "<table border = '1' class='col-sm-offset-2'><tr align='center'>";
    echo "<th>id</th>";
    echo "<th>帳號</th>";
    echo "<th>性別</th>";
    echo "<th>姓名</th>";
    echo "<th>電話</th>";
    echo "<th>E-mail</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_row($result)) {
        echo "<tr>";
        for ($j = 0; $j < mysqli_num_fields($result); $j++) {
            echo "<td>" . $row[$j] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    //印店家表
    $sql_query = "SELECT `id`,`account`,`name`,`phoneNumber`,`E-mail` FROM `member` where `identity`='store'";
    $result = mysqli_query($conn, $sql_query);
    $store_query = "SELECT `id`,`member_id`,`storeName`,`storeAddress`,`storePhoneNumber` FROM `store`";
    $storeresult = mysqli_query($conn, $store_query);

    echo "<h2 class='col-sm-offset-2'>店家列表</h2>";
    echo "<table border = '1' class='col-sm-offset-2'><tr align='center'>";

    echo "<th>id</th>";
    echo "<th>帳號</th>";
    echo "<th>負責人姓名</th>";
    echo "<th>負責人電話</th>";
    echo "<th>負責人E-mail</th>";
    echo "<th>店家ID</th>";
    echo "<th>店家名稱</th>";
    echo "<th>店家電話</th>";
    echo "<th>店家地址</th>";
    echo "</tr>";
    $storerow = mysqli_fetch_row($storeresult);
    while ($row = mysqli_fetch_row($result)) {
        echo "<tr>";
        for ($j = 0; $j < mysqli_num_fields($result); $j++) {
            echo "<td>" . $row[$j] . "</td>";
        } // 在每次迴圈中重新初始化 $storerow 
        $store_query = "SELECT `id`,`storeName`,`storeAddress`,`storePhoneNumber` FROM `store` WHERE `member_id`='" . $row[0] . "'";
        $storeresult = mysqli_query($conn, $store_query);
        $storerow = mysqli_fetch_row($storeresult);
        if ($storerow) {
            for ($j = 0; $j < mysqli_num_fields($storeresult); $j++) {
                echo "<td>" . $storerow[$j] . "</td>";
            }
        } else {
            echo "<td colspan='4'>無店家資料</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    mysqli_close($conn);
    ?>
</body>

</html>