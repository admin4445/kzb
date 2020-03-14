<?php
	//引入头部文件
	include 'header.php';
	include 'banner.php';
    //内容文件
	if(!empty($_GET['id']) && isset($_GET['id'])){

		
		//查询当前案例的信息
		$sql="SELECT * FROM nnd_cases WHERE case_id =".$_GET['id'];
		$result=mysqli_query($conn,$sql);
		$newinfo=mysqli_fetch_assoc($result);

		//查询当前分类的名字
		$casesql='SELECT `case_type_name1` FROM nnd_case_type WHERE case_type_id='.$newinfo['case_type'];
		$caseurl=mysqli_query($conn,$casesql);
		$casepath=mysqli_fetch_assoc($caseurl);
		
	}else{
		die('非法访问');
	}
include './views/show_info.html';
//引入页脚
include 'footer.php';


?>