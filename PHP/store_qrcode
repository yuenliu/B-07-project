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
    <?php
    include("navbar.php");
    include('phpqrcode/qrlib.php');

    if (isset($_SESSION["account"])) {
        $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
        $RecMember = mysqli_query($conn, $query_RecMember);
        $row_Recmember = mysqli_fetch_assoc($RecMember);
        $store_query = "SELECT * FROM `store` WHERE `member_id`='" . $row_Recmember["id"] . "'";
        $storeresult = mysqli_query($conn, $store_query);
        $row_Recstore = mysqli_fetch_assoc($storeresult);

        $store_id = $row_Recstore["id"];
        $store_name = $row_Recstore["storeName"];

        $ip = getHostByName(getHostName());

        $url = 'http://' . $ip . "/menu.php?storeid=" . $store_id; // 根據store_id生成對應的網址
    
        // 設定QR碼文件保存位置 
        $qr_code_file = 'store_qrcode/qrcode_store_' . $store_id . '.png';
        // 生成QR碼，並保存為PNG文件 
        QRcode::png($url, $qr_code_file, QR_ECLEVEL_L, 4);

        echo '<img id="qrcode" src="' . $qr_code_file . '" alt="QR Code">';
        echo '<p id="storeName" style="display:none;">' . $store_name . '</p>';// 隱藏的店家名稱元素
    } else {
        header("Location: login.php");
    }
    ?>

    <!-- HTML 按鈕用於列印 QR 碼 -->
    <button onclick="printQRCode()">列印 QR 碼</button>

    <!-- JavaScript 用於列印 -->
    <script>
        function printQRCode() {
            var qrCodeSrc = document.getElementById('qrcode').src;
            var storeName = document.getElementById('storeName').innerText;
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>列印 QR 碼</title><meta charset="utf-8"></head><body><br>');
            printWindow.document.write('<h1 style="text-align:center">' + storeName + '</h1>');
            printWindow.document.write('<img src="' + qrCodeSrc + '"style="width:296px;height:296px;text-align:center;">');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        } 
    </script>
</body>

</html>
