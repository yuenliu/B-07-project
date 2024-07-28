<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>首頁</title>
</head>
<body>
    <?php if (isset($_SESSION['auth_role'])): ?>
        <?php if ($_SESSION['auth_role'] == 'admin'): ?>
            <!-- 管理員導航欄 -->
            <nav>
                <ul>
                    <li><a href="admin_dashboard.php">管理員儀表板</a></li>
                    <li><a href="logout.php">登出</a></li>
                </ul>
            </nav>
        <?php elseif ($_SESSION['auth_role'] == 'user'): ?>
            <!-- 一般使用者導航欄 -->
            <nav>
                <ul>
                    <li><a href="user_dashboard.php">使用者儀表板</a></li>
                    <li><a href="logout.php">登出</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    <?php else: ?>
        <!-- 未登入使用者導航欄 -->
        <nav>
            <ul>
                <li><a href="login.php">登入</a></li>
                <li><a href="register.php">註冊</a></li>
            </ul>
        </nav>
    <?php endif; ?>
</body>
</html>
