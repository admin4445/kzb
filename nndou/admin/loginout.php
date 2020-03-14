<?php

   //引用函数库
   include './include/function.php';
    session_start();
	//最后登录的时间
	$time=time();
	$ip=$_SERVER["REMOTE_ADDR"];
	$name=$_SESSION['username'];
	$conn=db_conn();
	$sql="UPDATE nnd_admin SET `admin_last_login` = '$time',`admin_login_ip` ='$ip' WHERE `admin_name`= '$name'";
	$res=mysqli_query($conn,$sql);
	if($res){
		session_destroy();

	}else{ 
		session_destroy();
	}

  echo "<script> alert('注销用户');window.location.href='login.php'</script>";
 
  die;

?>