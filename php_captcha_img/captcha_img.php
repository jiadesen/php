<?php

session_start(); //注：使用session(会话控制)，必须将session_start()方法放在程序最顶部，然后在该脚本里就可以使用SESSION来保存数据了
//定义物料库，并定义每个物料对应的值，这种验证属于看图识物验证，类似于12306官网的图片验证
//举一反三，视频验证码将物料库中的物料改为对应的视频即可
$table = array(
  'pic0' => '狗',
  'pic1' => '猫',
  'pic2' => '鱼',
  'pic3' => '鸟',
);
$index = rand(0, 3); //生成0-3的随机数
$value = $table['pic' . $index]; //取出对应的随机值
$_SESSION['authcode'] = $value; //将值存入SESSION

$filename = dirname(__FILE__) . '\\pic' . $index . '.png'; //找到文件
$contents = file_get_contents($filename); //取出物料对应的值

ob_clean(); //清除缓冲区(这里可以省略)
header('content-type:image/jpg'); //输出内容之前设置
echo $contents; //输出图片内容
