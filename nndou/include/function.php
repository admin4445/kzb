<?php
   include 'config.php';
    
	function db_conn(){
		// 创建连接
		$conn=mysqli_connect(LOCALHOST,USER_NAME,PASS);
		if(!$conn){
			die('数据库连接失败'.mysqli_connect_error());
		}

		//选择数据库
		mysqli_select_db($conn,DATABASES);
		//设置数据库编码
		mysqli_set_charset($conn,'utf8');
		return $conn;
	}

	
   /*
	*
      
   */
	//查询多条记录函数
	 function select_all($table,$ele='*',$condition=''){
	 	global $conn;
	 	$sql="SELECT {$ele} FROM {$table} {$condition}";
  		$rsult=mysqli_query($conn,$sql);
		while ($res=mysqli_fetch_assoc($rsult)) {
		  	 $info[]=$res;
		}
		return $info;

	}

	//查询一条记录
	function select_find($table,$condition=''){
		
	 	$sql="SELECT * FROM {$table}";
  		$rsult=mysqli_query($conn,$sql);
		while ($res=mysqli_fetch_assoc($rsult)) {
		  	 $info[]=$res;
		}
		return $info;

	}
	
	function dump($data){
        echo "<pre>";
        var_dump($data);
        echo "<pre>";
	}

     /*
		$current  integer  当前页码
		$count    integer  总共数据的条数
		$limit    integer  每页显示的的数据条数
		$size     integer   总共的页数
		
     */
	function page($current,$count,$limit,$size,$class='page'){
		$str='';
		//如果数据条数大于每页限制显示的条数，则分页
		if($count>$limit){
			$str.="<div class='{$class}'> <ul>";
            //首页
            if($current==1){
            	$str.="<li class='prev'>&lt;</li>";
            	$str.="<li class=''><a href='?id=1'>首页</a></li>";

            }else{
            	$str.="<li class='prev'><a href='?id=".($current-1)."'>&lt;</a></li>";
            	
            }

            if($current<=floor($limit/2)){
            	$start=1;
            	$end=$size>$limit ?$limit:$size;

            }else if($current>$size-floor($limit/2)){
            		//$start=$size-$limit+1;
            		$start=($size-$limit+1<1)?1:$size-$limit+1;
            		$end=$size;
            }else{
            	$start =$current-floor($limit/2);
            	$end=$current+floor($limit/2);
            }

            for($i=$start;$i<=$end;$i++){
            	if($i==$current){
            		$str.="<li class='active'><a>".$i."</a></li>";
            	}else{
            		$str.="<li><a href='?id={$i}' >".$i."</a></li>";
            	}
            	
            }

            //尾页
            if($current==$size){
            	$str.="<li class=''><a href='?id=".$size."'>尾页</a></li>";
            	$str.="<li class='next'>&gt;</li>";
            	
            }else{
            	$str.="<li class='prev'><a href='?id=".($current+1)."'>&gt;</a></li>";
            }


            




			$str.="</ul></div>";
		}else{
			return  '1123';
		}

		return $str;
	}
?>