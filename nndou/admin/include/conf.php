<?php
   /*数据库的配置*/
	//地址
	define('LOCALHOST', 'localhost');
	//用户名
	define('USER_NAME', 'nndou');
	//密码
	define('PASS', '123456');
	//数据库
	define('DATABASES', 'nndou');
    //存储图片的路径
	$pattern='/\/[a-z]+/';
	preg_match($pattern,$_SERVER['PHP_SELF'],$arr);
	$imgs='http://'.$_SERVER['HTTP_HOST'].$arr[0];
	
	
	define('IMGPATH', $imgs);
 


?>