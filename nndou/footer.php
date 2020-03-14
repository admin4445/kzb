<?php

$url=basename($_SERVER['SCRIPT_FILENAME']);
  if($url=='footer.php'){
  	 die('非法访问');
  }
//查询页脚信息
$sql='SELECT * FROM nnd_conf';
$result=mysqli_query($conn,$sql);
$footerinfo=mysqli_fetch_assoc($result);



//加载页脚
include './views/footer.html';

mysqli_close($conn);
?>