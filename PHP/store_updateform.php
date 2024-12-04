<?php
include("navbar.php");
?>

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
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">修改店家資料</div>
            <?php
            session_start();
            $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
            $RecMember = mysqli_query($conn, $query_RecMember);
            $row_Recmember = mysqli_fetch_assoc($RecMember);
            $query_RecStore = "SELECT * FROM `store` WHERE `member_id`='" . $row_Recmember["id"] . "'";
            $result_RecStore = mysqli_query($conn, $query_RecStore);
            $row_Recstore = mysqli_fetch_assoc($result_RecStore);
            if (mysqli_num_rows($result_RecStore) == 0) {
                echo "<div class='panel-body'><p style='color: red;'>初次註冊店家帳號，請先填寫店家資訊。</p></div>";
            }
            if (isset($_POST["change"])) {
                $file_name = $_FILES['storeimg']['name'];
                $file_tmp = $_FILES['storeimg']['tmp_name'];
                $file_size = $_FILES['storeimg']['size'];
                $target_dir = "storeimg/";
                $target_file = $target_dir . basename($file_name);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                if ($check === false) {
                    array_push($errors, "檔案不是有效的圖片。");
                }
                if (file_exists($target_file)) {
                    array_push($errors, "檔案已經存在。");
                }
                if ($file_size > 3 * 1024 * 1024 || !in_array($imageFileType, ['png', 'jpg'])) {
                    array_push($errors, "檔案大小限制為 3MB，檔案類型必須為 PNG 或 JPG。");
                }
                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    $storeName = $_POST["storeName"];
                    $storeAddress = $_POST["storeAddress"];
                    $storePhoneNumber = $_POST["storePhoneNumber"];
                    $store_image = $file_name;
                    $id = $row_Recstore["id"];

                    //先處理基本資料，圖片先管他去死
                    if (mysqli_num_rows($result_RecStore) == 0) {
                        $sql = "INSERT INTO `store` (`member_id`,`storeName`, `storeAddress`, `storePhoneNumber`) VALUES (?,?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                        $id = $row_Recmember["id"];
                        if ($prepareStmt) {
                            mysqli_stmt_bind_param($stmt, "sssss", $id, $storeName, $storeAddress, $storePhoneNumber, $file_name);
                            mysqli_stmt_execute($stmt);
                            echo "<div class='alert alert-success'>基本資料更改成功！</div>";
                        } else {
                            die("發生了一些錯誤！請洽管理員。");
                        }
                    } else {
                        $sql_update = "UPDATE `store` SET `storeName` = '$storeName', `storeAddress` = '$storeAddress'
                                , `storePhoneNumber` = '$storePhoneNumber' WHERE `id` = '$id'";
                        mysqli_query($conn, $sql_update);
                        echo "<div class='alert alert-success'>更改成功！</div>";
                    }

                    if (move_uploaded_file($file_tmp, $target_file)) {
                        $sql_update_image = "UPDATE `store` SET `store_image` = ? WHERE `id` = ?";
                        $stmt_image = mysqli_stmt_init($conn);
                        $prepareStmt_image = mysqli_stmt_prepare($stmt_image, $sql_update_image);
                        if ($prepareStmt_image) {
                            mysqli_stmt_bind_param($stmt_image, "si", $store_image, $id);
                            mysqli_stmt_execute($stmt_image);
                            echo "<div class='alert alert-success'>圖片更新成功！</div>";
                        } else {
                            echo "預備語句失敗: " . mysqli_stmt_error($stmt_image);
                        }
                    } else {
                        echo "<div class='alert alert-danger'>圖片未更新！</div>";
                    }
                }
            }
            ?>
            <div class="panel-body">
                <form action="store_updateform.php" method="POST" enctype="multipart/form-data">
                    <p><strong>店家封面</strong></p>
                    <input type="file" name="storeimg" id="storeimg" <?php if ($row_Recstore['store_image'])
                        echo "require" ?>><br>
                    <?php if ($row_Recstore['store_image']) { ?>
                        <img src="storeimg/<?php echo $row_Recstore['store_image']; ?>" alt="Current Image" width="300"
                            height="200">
                    <?php } ?>
                    <p><strong>店家名稱</strong></p>
                    <input <?php if ($row_Recstore["storeName"] != null)
                        echo "value=" . $row_Recstore["storeName"] ?>
                            type="text" name="storeName" required><br>
                        <p><strong>店家地址</strong></p>
                        <input <?php if ($row_Recstore["storeAddress"] != null)
                        echo "value=" . $row_Recstore["storeAddress"] ?> type="text" name="storeAddress" required><br>
                        <p><strong>店家電話</strong></p>
                        <input <?php if ($row_Recstore["storePhoneNumber"] != null)
                        echo "value=" . $row_Recstore["storePhoneNumber"] ?> type="text" name="storePhoneNumber" required><br>
                        <input type="submit" name="change" value="確認修改">
                    </form>
                </div>
            </div>
        </div>
    </body>
