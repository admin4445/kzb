<?php 
	//引入头部文件
	include 'header.php';

	  //内容文件
	if(!empty($_GET['id']) && isset($_GET['id'])){
		$sql="SELECT * FROM nnd_info WHERE info_id =".$_GET['id'];
		$result=mysqli_query($conn,$sql);
		$newsinfo=mysqli_fetch_assoc($result);
	}else{
		die('非法访问');
	}
	//内容文件
	include './views/info.html';
	//引入页脚
	include 'footer.php';

?>