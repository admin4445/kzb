<?php

    include './include/function.php';

     session_start();

     //验证用户是否登录
     if(!(isset( $_SESSION['islogin'] ) && $_SESSION['islogin'] == 1)){
         echo "<script> alert('您未登录,请先登录')</script>";
         echo "<script> setTimeout(()=>{window.location.href='login.php'})</script>";
         die;
     }
    //连接数据库
    $conn=db_conn();
    //查询资讯类型
    $sql='SELECT * FROM nnd_info_type';
    $res=mysqli_query($conn,$sql);
    while ($rsult=mysqli_fetch_assoc($res)){
        $info[]=$rsult;
    }

    //查出轮播图分类
    $sql="SELECT * FROM nnd_bantype";
    $bannertype=type($sql);

    //查询所有方案分类
    $sql="SELECT * FROM nnd_serv_type";
    $servtype=type($sql);

    //查询案例分类
    $sql="SELECT * FROM nnd_case_type";
    $casetype=type($sql);

    //查询关于我们的分类
    $sql="SELECT * FROM nnd_about_type";
    $abouttype=type($sql);
    //当前url
    $current_url = basename($_SERVER['REQUEST_URI']);
    if($current_url == '') $current_url = 'index.php';
    $reg = '/\?/';
    if(preg_match($reg,$current_url)){
    $current_url = preg_split($reg, $current_url);
    $current_url = $current_url[0];
    }
    $type = isset($_GET) ? $_GET['type'] : '';


?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <title>CMS内容管理系统</title>
  <meta name="keywords" content="Admin">
  <meta name="description" content="Admin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Core CSS  -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/glyphicons.min.css">
  
  <link href="css/bootstrap-fileinput.css" rel="stylesheet">
  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="css/theme.css">
  <link rel="stylesheet" type="text/css" href="css/pages.css">
  <link rel="stylesheet" type="text/css" href="css/plugins.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">

  <!-- Boxed-Layout CSS -->
  <link rel="stylesheet" type="text/css" href="css/boxed.css">

  <!-- Demonstration CSS -->
  <link rel="stylesheet" type="text/css" href="css/demo.css">

  <!-- Your Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/custom.css">
  
  <!-- Core Javascript - via CDN --> 
  <script type="text/javascript" src="js/jquery.min.js"></script> 

  <script type="text/javascript" src="js/jquery-ui.min.js"></script> 
  <script type="text/javascript" src="js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="js/uniform.min.js"></script> 
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/custom.js"></script> 
</head>

<body>
<!-- Start: Header -->
<header class="navbar navbar-fixed-top" style="background-image: none; background-color: rgb(240, 240, 240);">
  <div class="pull-left"> <a class="navbar-brand" href="#">
    <div class="navbar-logo"><img src="images/logo.png" alt="logo"></div>
    </a> </div>
  <div class="pull-right header-btns">
    <a class="user"><span class="glyphicons glyphicon-user"></span> <?php echo $_SESSION['username'] ?></a>
    <a href="loginout.php" class="btn btn-default btn-gradient" type="button"><span class="glyphicons glyphicon-log-out"></span> 退出</a>
  </div>
</header>
<!-- End: Header -->

<!-- Start: Main -->
<div id="main"> 
    <!-- Start: Sidebar -->
  <aside id="sidebar" class="affix">
    <div id="sidebar-search">
    		<div class="sidebar-toggle"><span class="glyphicon glyphicon-resize-horizontal"></span></div>
    </div>
    <div id="sidebar-menu">
      <ul class="nav sidebar-nav">
        <li>
          <a href="index.php"><span class="glyphicons glyphicon-home"></span><span class="sidebar-title">后台首页</span></a>
        </li>

        <li class="<?php 
        if($current_url=='info.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php 
        if($current_url=='info.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">资讯管理</span><span class="caret"></span></a>
          <ul class="nav sub-nav" id="sideEight" style="">
             <li class="<?php if($type==''&&$current_url=='info.php'){ echo 'active';} ?>"><a href="info.php"><span class="glyphicons glyphicon-record"></span> 所有资讯</a></li>
             <?php foreach($info as $val){ ?>
            <li class="<?php 
              if($type==$val['info_type_id']){ 
                  echo 'active';
              }

            ?>"><a href="info.php?type=<?php echo $val['info_type_id']; ?>"><span class="glyphicons glyphicon-record"></span><?php echo $val['info_type_name']  ?></a></li>
             <?php } ?>
          </ul>
        </li>

        <li class="<?php 
        if($current_url=='infotype_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php 
        if($current_url=='infotype_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">资讯分类管理</span><span class="caret"></span></a>
          <ul class="nav sub-nav" id="sideEight" style="">
             <li class="<?php if($type==''&&$current_url=='infotype_list.php'){ echo 'active';} ?>"><a href="infotype_list.php"><span class="glyphicons glyphicon-record"></span> 分类列表</a></li>
            
          </ul>
        </li>

        <li class="<?php 
        if($current_url=='nav_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php 
        if($current_url=='nav_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">导航条管理</span><span class="caret"></span></a>
          <ul class="nav sub-nav" id="sideEight" style="">
             <li class="<?php if($type==''&&$current_url=='nav_list.php'){ echo 'active';} ?>"><a href="nav_list.php"><span class="glyphicons glyphicon-record"></span> 导航列表</a></li>
            
          </ul>
        </li>

        <li class="<?php 
        if($current_url=='banner_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php 
        if($current_url=='banner_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">轮播图管理</span><span class="caret"></span></a>
          <ul class="nav sub-nav" id="sideEight" style="">
             <li class="<?php if($type==''&&$current_url=='banner_list.php'){ echo 'active';} ?>"><a href="banner_list.php"><span class="glyphicons glyphicon-record"></span> 轮播图列表</a></li>
            
              <?php foreach($bannertype as $val){ ?>
            <li class="<?php 
              if($type==$val['btype_id']){ 
                  echo 'active';
              }

            ?>"><a href="banner_list.php?type=<?php echo $val['btype_id']; ?>"><span class="glyphicons glyphicon-record"></span><?php echo $val['btype_name']  ?></a></li>
             <?php } ?>


          </ul>
        </li>
         <li class="<?php 
          if($current_url=='bantype_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php 
          if($current_url=='bantype_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">轮播图分类管理</span><span class="caret"></span></a>
            <ul class="nav sub-nav" id="sideEight" style="">
               <li class="<?php if($type==''&&$current_url=='bantype_list.php'){ echo 'active';} ?>"><a href="bantype_list.php"><span class="glyphicons glyphicon-record"></span> 分类列表</a></li>
              
          </ul>
        </li>
          <li class="<?php
              if($current_url=='server_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
                  if($current_url=='server_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">解决方案</span><span class="caret"></span></a>
                  <ul class="nav sub-nav" id="sideEight" style="">
                      <li class="<?php if($type==''&&$current_url=='server_list.php'){ echo 'active';} ?>"><a href="server_list.php"><span class="glyphicons glyphicon-record"></span> 所有方案</a></li>
                      <?php foreach($servtype as $val){ ?>
                          <li class="<?php
                          if($type==$val['serv_type_id']){
                              echo 'active';
                          }
                          ?>"><a href="server_list.php?type=<?php echo $val['serv_type_id']; ?>"><span class="glyphicons glyphicon-record"></span><?php echo $val['serv_type_name']  ?></a></li>
                      <?php } ?>
                  </ul>
          </li>

          <li class="<?php
          if($current_url=='servtype_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='servtype_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">解决方案类型</span><span class="caret"></span></a>
              <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&&$current_url=='servtype_list.php'){ echo 'active';} ?>"><a href="servtype_list.php"><span class="glyphicons glyphicon-record"></span> 分类列表</a></li>

              </ul>
          </li>


          <li class="<?php
          if($current_url=='case_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='case_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">案例展示</span><span class="caret"></span></a>
              <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&&$current_url=='case_list.php'){ echo 'active';} ?>"><a href="case_list.php"><span class="glyphicons glyphicon-record"></span> 所有案例</a></li>
                  <?php foreach($casetype as $val){ ?>
                      <li class="<?php
                      if($type==$val['case_type_id']){
                          echo 'active';
                      }
                      ?>"><a href="case_list.php?type=<?php echo $val['case_type_id']; ?>"><span class="glyphicons glyphicon-record"></span><?php echo $val['case_type_name1']  ?></a></li>
                  <?php } ?>
              </ul>
          </li>

          <li class="<?php
          if($current_url=='casetype_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='casetype_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">案例分类</span><span class="caret"></span></a>
              <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&&$current_url=='casetype_list.php'){ echo 'active';} ?>"><a href="casetype_list.php"><span class="glyphicons glyphicon-record"></span> 案例分类列表</a></li>

              </ul>
          </li>

          <li class="<?php
          if($current_url=='about_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='about_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">关于我们</span><span class="caret"></span></a>
              <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&&$current_url=='about_list.php'){ echo 'active';} ?>"><a href="about_list.php"><span class="glyphicons glyphicon-record"></span> 所有信息</a></li>
                  <?php foreach($abouttype as $val){ ?>
                      <li class="<?php
                      if($type==$val['abo_type_id']){
                          echo 'active';
                      }
                      ?>"><a href="about_list.php?type=<?php echo $val['abo_type_id']; ?>"><span class="glyphicons glyphicon-record"></span><?php echo $val['abo_type_name']  ?></a></li>
                  <?php } ?>
              </ul>
          </li>

          <li class="<?php
          if($current_url=='abouttype_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='abouttype_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">关于我们分类</span><span class="caret"></span></a>
              <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&&$current_url=='abouttype_list.php'){ echo 'active';} ?>"><a href="abouttype_list.php"><span class="glyphicons glyphicon-record"></span> 关于我们分类列表</a></li>

              </ul>
          </li>

          <li class="<?php
          if($current_url=='conf_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='conf_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">网站配置</span><span class="caret"></span></a>
              <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&&$current_url=='conf_list.php'){ echo 'active';} ?>"><a href="conf_list.php"><span class="glyphicons glyphicon-record"></span> 网站配置列表</a></li>

              </ul>
          </li>





      </ul>
    </div>
  </aside>