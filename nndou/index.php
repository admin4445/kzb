<?php

   
  //引入头部文件
  include 'header.php';
  include 'banner.php';


  //查询服务类型
   $sql='SELECT * FROM nnd_serv_type';
   $results=mysqli_query($conn,$sql);
   while ($ser_info=mysqli_fetch_assoc($results)) {
          $sertype[]=$ser_info;
   }
   
   
   //查询作品展示
   $sql3='SELECT * FROM nnd_cases   order by case_id   DESC limit 6';
   $slog=mysqli_query($conn,$sql3);
   while ($sloginfo=mysqli_fetch_assoc($slog)) {
          $sloginfos[]=$sloginfo;
   }
   
   //公司发展史
   $sql4='SELECT * FROM nnd_about  WHERE about_tpye=1';
   $info=mysqli_query($conn,$sql4);
   while ($infos=mysqli_fetch_assoc($info)) {
          $soures[]=$infos;
   }
  
  //内容文件 
  include './views/index.html';
  //引入页脚
  include 'footer.php';
 
 

?>