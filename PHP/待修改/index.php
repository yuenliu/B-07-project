<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員管理系統 - 首頁</title>
<?php if(isset($_GET["loginFail"])) { ?>
  <script language="javascript">
    alert("登入失敗，請重新登入");
  </script>
<?php } ?>
</head>
<body>
<table width="250" border="1" align="center">
  <tr valign="top">
    <td align="center">
      <p>會員管理系統</p>
      <form name="form1" method="post" action="login.php">
        <p>帳號：<br>
          <input name="account" type="text" value="<?php echo $_COOKIE["account"];?>">
        </p>
        <p>密碼：<br>
          <input name="password" type="password" value="<?php echo $_COOKIE["password"];?>">
        </p>
        <p><input name="rememberme" type="checkbox" value="true" checked>記住我的帳號密碼。</p>
        <p align="center">
          <input type="submit" name="login" value="登入">
        </p>
      </form>
      <p><a href="member_join_form.php">馬上申請會員</a></p>
    </td>
  </tr>
</table>
</body>
</html>