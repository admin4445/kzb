<?php

  //引入头部文件
  include 'header.php';
  //获取当前页的名字
  $pattern='/[a-z]+\.[a-z]+/';
  preg_match($pattern, $_SERVER['PHP_SELF'],$arr);
  $sqll="SELECT `nav_name` FROM nnd_nav WHERE nnd_url="."'$arr[0]'";
  $ress=mysqli_query($conn,$sqll);
  $pathurl=mysqli_fetch_assoc($ress);
  include 'banner.php';
  if(!empty($_GET['id'])&&isset($_GET['id'])){
     $id=$_GET['id'];
  }else{
  	$id=1;

  }
   //查询当前分类的名字
   $casesql='SELECT `case_type_name1` FROM nnd_case_type WHERE case_type_id='.$id;
   $caseurl=mysqli_query($conn,$casesql);
   $casepath=mysqli_fetch_assoc($caseurl);
  //查询分类
  $sql='SELECT * FROM nnd_case_type';
  $info=mysqli_query($conn,$sql);
  while ($res=mysqli_fetch_assoc($info)) {
       $casetype[]=$res;
   }
   //查询所在类的信息
	$sqls='SELECT * FROM nnd_cases WHERE case_type='.$id;
	$infos=mysqli_query($conn,$sqls);
	while ($ress=mysqli_fetch_assoc($infos)) {
	   $casetypes[]=$ress;
	}
	if(!isset($casetypes)){
		$casetypes="";
	}
    
  //内容文件
  include './views/show.html';
  //引入页脚
  include 'footer.php';
 
  
?>