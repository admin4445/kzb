<?php
 //轮播图控制页面
  $url=basename($_SERVER['SCRIPT_FILENAME']);
  if($url=='banner.php'){
  	 die('非法访问');
  }

    //当前url
    $current_url = basename($_SERVER['REQUEST_URI']);
    if($current_url == '') $current_url = 'index.php';
    $reg = '/\?/';
    if(preg_match($reg,$current_url)){
        $current_url = preg_split($reg, $current_url);
        $current_url = $current_url[0];
    }


  $sql='SELECT * FROM nnd_banner as a,nnd_bantype as b WHERE a.ban_type = b.btype_id AND b.btype_add='." '$current_url'";
  $rsult=mysqli_query($conn,$sql);

  while ( $res=mysqli_fetch_assoc($rsult)) {
  	  $banner[]=$res;
  }

  if(count($banner)==null){
      $sql='SELECT * FROM nnd_banner as a,nnd_bantype as b WHERE a.ban_type = b.btype_id AND b.btype_add='." 'index.php'";
      $rsult=mysqli_query($conn,$sql);

      while ( $res=mysqli_fetch_assoc($rsult)) {
          $banner[]=$res;
      }
  }


 
  //banner
  include './views/banner.html';

?>