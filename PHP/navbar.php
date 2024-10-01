<nav class="navbar navbar-inverse fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand text-white">文大線上點餐系統</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a href="home.php">首頁</a></li>
                <?php
                require_once("database.php");
                session_start();
                //查詢登入會員資料
                $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                $RecMember = mysqli_query($conn, $query_RecMember);
                $row_Recmember = mysqli_fetch_assoc($RecMember);
                if ($row_Recmember["identity"] == "consumer") {
                    echo "<li class='nav-item'><a href='search.php'>尋找餐廳</a></li>
                    <li class='nav-item'><a href='collect.php'>我的收藏</a></li>
                    <li class='nav-item'><a href='order.php'>訂單管理</a></li>
                    <li class='nav-item'><a href='diet.php'>健康管理</a></li>";
                } else if ($row_Recmember["identity"] == "store") {
                    echo "<li class='nav-item'><a href='online.php'>上線狀態</a></li>
                    <li class='nav-item'><a href='meal.php'>餐點管理</a></li>
                    <li class='nav-item'><a href='store.php'>店家管理</a></li>";
                } else if ($row_Recmember["identity"] == "root") {
                    echo "<li class='nav-item'><a href='account_manage.php'>管理使用者帳號</a></li>
                    <li class='nav-item'><a href='#'>管理訂單</a></li>
                    <li class='nav-item'><a href='#'>客服專區</a></li>";
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                require_once("database.php");
                session_start();
                //查詢登入會員資料
                $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                $RecMember = mysqli_query($conn, $query_RecMember);
                $row_Recmember = mysqli_fetch_assoc($RecMember);
                if ($row_Recmember["identity"] == "consumer") {
                    echo "<li><a href='shopping_cart.php'> 購物車</a></li>";
                }
                ?>
                <li><a href="contact.php"> 聯絡管理員</a></li>
                <li><a href="question.php"> 常見問題</a></li>
                <?php
                require_once("database.php");
                session_start();
                //查詢登入會員資料
                $query_RecMember = "SELECT * FROM `member` WHERE `account`='" . $_SESSION["account"] . "'";
                $RecMember = mysqli_query($conn, $query_RecMember);
                $row_Recmember = mysqli_fetch_assoc($RecMember);
                if ($row_Recmember["identity"] == "consumer") {
                    echo "<li class='nav-item'><a href='member_center.php'>會員中心</a></li>";
                } else if($row_Recmember["identity"] == "store") {
                    echo "<li class='nav-item'><a href='store_center.php'>店家中心</a></li>";
                } 
                ?>
                <?php
                session_start();
                if (isset($_SESSION["account"])) {
                    echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> 登出</a></li>";
                } else {
                    echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> 登入</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>