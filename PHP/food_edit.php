<?php
    include("navbar.php");
    session_start();
    require_once("login_check.php");
    require_once("database.php");

    if (isset($_GET['foodid'])) {
        $foodid = $_GET['foodid'];
        $sql_query = "SELECT * FROM `food` WHERE `foodid` = '$foodid'";
        $result = mysqli_query($conn, $sql_query);
        $row = mysqli_fetch_assoc($result);
    }

    if (isset($_POST['submit'])) {
        $foodname = $_POST['foodname'];
        $fooddetail = $_POST['fooddetail'];
        $foodprice = $_POST['foodprice'];
        $foodcalorie = $_POST['foodcalorie'];
        $foodimage = $_FILES['foodimage']['name'];

        if ($foodimage) {
            move_uploaded_file($_FILES['foodimage']['tmp_name'], 'foodimg/'.$foodimage);
        }

        $sql_update = "UPDATE `food` SET `foodname` = '$foodname', `fooddetail` = '$fooddetail', `foodprice` = '$foodprice', `foodcalorie` = '$foodcalorie' WHERE `foodid` = '$foodid'";
        if ($foodimage) {
            $sql_update .= ", `foodimage` = '$foodimage'";
        }

        mysqli_query($conn, $sql_update);
        echo "<script>alert('餐點已更新'); window.location.href='food_manage.php';</script>";
    }

    mysqli_close($conn);
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
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <div class="container">
        <h2>編輯餐點</h2>
        <div>
          <table width="800" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr valign="top">
              <td width="600"> 
                <form action="food_edit.php?foodid=<?php echo $foodid; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <font size="5">餐點名稱:</font>
                        <input type="text" class="form-control" id="foodname" name="foodname" value="<?php echo $row['foodname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <font size="5">餐點價格:</font>
                        <input type="text" class="form-control" id="foodprice" name="foodprice" value="<?php echo $row['foodprice']; ?>" required>
                    </div>
                    <div class="form-group">
                        <font size="5">餐點介紹:</font>
                        <textarea class="form-control" id="fooddetail" name="fooddetail" rows="3" required><?php echo $row['fooddetail']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <font size="5">餐點卡路里:</font>
                        <input type="text" class="form-control" id="foodcalorie" name="foodcalorie" value="<?php echo $row['foodcalorie']; ?>" required>
                    </div>
                    <div class="form-group">
                        <font size="5">餐點圖片:</font>
                        <input type="file" class="form-control" id="foodimage" name="foodimage">
                        <?php if ($row['foodimage']) { ?>
                            <img src="foodimg/<?php echo $row['foodimage']; ?>" alt="Current Image" width="300" height="200">
                        <?php } ?>
                    </div>
                    <input type="submit" value="更新餐點" name="submit">
                    <input style="font-size: 20px;" type="button" value="回上一頁" name="button" onclick="window.history.back();">
                </form>
              </td>
            </tr>
          </table>
        </div>
    </div>
</body>
</html>