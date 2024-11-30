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
    <script language="javascript">
        function checkForm(){
            if(document.food.fileToUpload.value ==""){
                alert("請上傳餐點圖片");
                document.food.fileToUpload.focus();
                return false;
            }
            if(document.food.foodname.value ==""){
                alert("請輸入餐點名稱");
                document.food.foodname.focus();
                return false;
            }
            if(document.food.foodprice.value ==""){
                alert("請輸入餐點價格");
                document.food.foodprice.focus();
                return false;
            }
            if(document.food.fooddetail.value ==""){
                alert("請輸入餐點介紹");
                document.food.fooddetail.focus();
                return false;
            }
            if(document.food.foodcalorie.value ==""){
                alert("請輸入卡路里");
                document.food.foodcalorie.focus();
                return false;
            }
            return confirm('確定送出嗎?');
        }
    </script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
  <div class="panel-body">
  <?php
  require_once("database.php");

  if (isset($_POST['submit'])) {
    // 獲取檔案資訊
    $file_name = $_FILES['fileToUpload']['name'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $target_dir = "foodimg/";
    $target_file = $target_dir . basename($file_name);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // 檢查圖片檔案是否合法（確保是圖片格式）
    $check = getimagesize($file_tmp);
    if ($check === false) {
      echo "<p style='color:red; text-align:center;'>檔案不是有效的圖片。";
    } else {
      // 獲取表單欄位值
      $foodname = mysqli_real_escape_string($conn, $_POST['foodname']);
      $foodprice = mysqli_real_escape_string($conn, $_POST['foodprice']);
      $fooddetail = mysqli_real_escape_string($conn, $_POST['fooddetail']);
      $foodcalorie = mysqli_real_escape_string($conn, $_POST['foodcalorie']);

      // 檢查檔案是否已經存在
      if (file_exists($target_file)) {
        echo "<p style='color:red;text-align:center;'>檔案已經存在。";
      } else {
        // 檢查檔案大小和檔案類型
        if ($file_size > 4097152 || !in_array($imageFileType, ['png', 'jpg'])) {
          echo "<p style='color:red;text-align:center;'>檔案大小限制為 4MB，檔案類型必須為 PNG 或 JPG。";
        } else {
          // 若通過所有檢查，移動檔案到目標資料夾
          if (move_uploaded_file($file_tmp, $target_file)) {
            // 設定食物圖片檔名
            $foodimage = $file_name;

            // 使用準備語句防止 SQL 注入
            $sql = "INSERT INTO `food` (`foodname`, `foodimage`, `foodprice`, `fooddetail`, `foodcalorie`) 
                    VALUES (?, ?, ?, ?, ?)";

            // 準備語句
            if ($stmt = mysqli_prepare($conn, $sql)) {
              // 綁定參數
              mysqli_stmt_bind_param($stmt, "sssss", $foodname, $foodimage, $foodprice, $fooddetail, $foodcalorie);
              
              // 執行查詢
              if (mysqli_stmt_execute($stmt)) {
                // 成功後跳轉到 upload.php
                header('Location: food_manage.php');
                exit;
              } else {
                echo "<p style='color:red;text-align:center;'>資料庫插入失敗！";
              }

              // 關閉準備語句
              mysqli_stmt_close($stmt);
            }
          } else {
            echo "<p style='color:red;text-align:center;'>上傳檔案發生錯誤！";
          }
        }
      }
    }
  }
?>
</div>
<div>
  <table width="800" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr valign="top">
      <td width="600">  
        <form action="food_upload.php" name="food" method="post" enctype="multipart/form-data" onsubmit="return checkForm();">
          <font size="5">餐點圖片:</font>
          <input type="file" name="fileToUpload" id="fileToUpload"><br>
          <font size="5">餐點名稱:</font>
          <input type="text" name="foodname" id="foodname"><br>
          <font size="5">餐點價格:</font>
          <input type="text" name="foodprice" id="foodprice"><br>
          <font size="5">餐點介紹:</font>
          <textarea name="fooddetail"></textarea><br>
          <font size="5">餐點卡路里:</font>
          <input type="text" name="foodcalorie" id="foodcalorie"><br>
          <br>
          <input type="submit" value="上傳" name="submit">
          
          <input style="font-size: 20px;" type="button" value="回上一頁" name="button" onclick="window.history.back();">
          
        </form>
      </td>
    </tr>
  </table>
</div>
    
</body>
</html>
