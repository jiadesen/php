<?php
if (isset($_REQUEST['authcode'])) {
  session_start();
  //strtolower方法将用户的输入全部转换为小写，再比较
  if (strtolower($_REQUEST['authcode']) == $_SESSION['authcode']) {
    echo '<font color="#00c">输入正确</font>';
  } else {
    echo '<font color="#c00"><b>输入错误</b></font>';
  }
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>确认验证码</title>
</head>
<body>
<form method="post" action="./form.php">
  <p>验证码图片：<img border="1" src="./captcha.php?r=<?php echo rand() ?>" width="100px" height="30px" alt=""></p>

  <p>请输入图片中的内容：<input type="text" name="authcode" value=""></p>
  <p><input type="submit" value="提交" style="padding:6px 20px;"></p>
</form>
</body>
</html>
