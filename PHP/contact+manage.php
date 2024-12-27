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
    $select_db = @mysqli_select_db($conn, "contact");
    $sql_query = "SELECT `id`,`name`,`E-mail`,`subject` FROM `contact`";
    $result = mysqli_query($conn, $sql_query);

    //印consumer表
    echo "<h2 class='col-sm-offset-2'>管理投訴</h2>";
    echo "<table border = '1' class='col-sm-offset-2'><tr align='center'>";
    echo "<th>id</th>";
    echo "<th>姓名</th>";
    echo "<th>E-mail</th>";
    echo "<th>內容</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_row($result)) {
        echo "<tr>";
        for ($j = 0; $j < mysqli_num_fields($result); $j++) {
            echo "<td>" . $row[$j] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    mysqli_close($conn);
    ?>
</body>

</html>
