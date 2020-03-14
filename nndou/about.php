<?php

   //引入头部文件
   include 'header.php';
   include 'banner.php';

   //查询公司新闻
   $sql='SELECT * FROM nnd_about WHERE about_tpye=2';
   $result=mysqli_query($conn,$sql);
   while ($res=mysqli_fetch_assoc($result)) {
   	  $info[]=$res;
   }

  //座右铭
   $sqls='SELECT * FROM nnd_slogan';
   $res=mysqli_query($conn,$sqls);
   while ( $rs=mysqli_fetch_assoc($res)) {
        $slogan[]=$rs;
   }

  //内容文件
  include './views/about.html';
  //引入页脚
  include 'footer.php';
   
?>