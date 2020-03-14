 <?php

 $url=basename($_SERVER['SCRIPT_FILENAME']);
  if($url=='header.php'){
  	 die('非法访问');
  }
//加载配置文件
include './include/config.php';
//加载函数库
include './include/function.php';
//连接数据库
// 创建连接
$conn=mysqli_connect(LOCALHOST,USER_NAME,PASS);
if(!$conn){
	die('数据库连接失败'.mysqli_connect_error());
}

//选择数据库
mysqli_select_db($conn,DATABASES);
//设置数据库编码
mysqli_set_charset($conn,'utf8');
$sql='SELECT * FROM nnd_nav';
$result=mysqli_query($conn,$sql);
while ($res=mysqli_fetch_assoc($result)) {
	  $navinfo[]=$res;
}

//头部文件
include './views/header.html';

define(ASSESS, TRUE);



?>