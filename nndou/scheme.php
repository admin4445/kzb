<?php

 //引入头部文件
  include 'header.php';

  //查询解决方案分类数据
  $sql='SELECT `serv_type_name`,`serv_type_id` FROM nnd_serv_type';
  $res=mysqli_query($conn,$sql);
  while ($ser_type=mysqli_fetch_assoc($res)) {
  	     $sertype[]=$ser_type;
  }
 
  //查询方案
  $sqls='SELECT * FROM nnd_service';
  $ress=mysqli_query($conn,$sqls);
  while ($sertypeinfo=mysqli_fetch_assoc($ress)) {
  	     $sertypeinfos[]=$sertypeinfo;
  }
  
 

  //内容文件
  include './views/solute.html';
  //引入页脚
  include 'footer.php';
 
?>