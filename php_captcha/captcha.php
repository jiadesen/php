<?php

session_start(); //注：使用session(会话控制)，必须将session_start()方法放在程序最顶部，然后在该脚本里就可以使用SESSION来保存数据了

//定义画布
$image = imagecreatetruecolor(100, 30);
//设置背景颜色
$bgcolor = imagecolorallocate($image, 200, 200, 200); //该方法默认输出黑色背景

imagefill($image, 0, 0, $bgcolor); //将$bgcolor的颜色铺到创建的画布$image上，从左上角开始填充(0,0)

//循环生成随机数字
//for ($i = 0; $i < 4; $i++) {
//  $fontsize = 6; //字体大小
////  $fontcolor = imagecolorallocate($image, 0, 0, 0); //生成字体的颜色
//  $fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120)); //生成字体的颜色(随机颜色)
//  $fontcontent = rand(0, 9); //rand方法随机生成0-9中的一个数字
//  //定义绘制起点坐标(防止位置重合)
//  $x = ($i * 100 / 4) + rand(5, 10);
//  $y = rand(5, 10);
//  //开始绘制
//  imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
//}

//声名变量在服务器端保存每次生成的验证码，用于用户输入验证
$captch_code = '';
//循环生成随机数字和字母
for ($i = 0; $i < 4; $i++) {
  $fontsize = 6; //字体大小
//  $fontcolor = imagecolorallocate($image, 0, 0, 0); //生成字体的颜色
  $fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120)); //生成字体的颜色(随机颜色)
  $fontcontent = rand(0, 9); //rand方法随机生成0-9中的一个数字

  $data = 'abcdefghigkmnpqrstuvwxy3456789'; //定义字典
  $fontcontent = substr($data, rand(0, strlen($data)), 1); //字符串切割

  //每当生成一个新字符就将该字符拼接到$captch_code中
  $captch_code .= $fontcontent;

  //定义绘制起点坐标(防止位置重合)
  $x = ($i * 100 / 4) + rand(5, 10);
  $y = rand(5, 10);
  //开始绘制
  imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
}
//将随机生成的验证码保存到 $_SESSION 的 authcode 变量中
$_SESSION['authcode'] = $captch_code;

//设置背景干扰元素-点(模拟200个杂色点)
for ($i = 0; $i < 200; $i++) {
  $pointcolor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
  imagesetpixel($image, rand(1, 99), rand(1, 29), $pointcolor); //imagesetpixel方法将点画到画布上
}

//设置背景干扰元素-线(3条干扰线即可)
for ($i = 0; $i < 3; $i++) {
  $linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
  imageline($image, rand(1, 99), rand(1, 29), rand(1, 99), rand(1, 29), $linecolor); //imageline方法将线绘制到画布上
}

header('content-type: image/png');
imagepng($image);

//end
imagedestroy($image); //好习惯，使用完就销毁
