<?php
    //引入头部文件
    include 'header.php';
    //获取当前页的名字
    $pattern='/[a-z]+\.[a-z]+/';
    preg_match($pattern, $_SERVER['PHP_SELF'],$arr);
   
    $sqll="SELECT `nav_name` FROM nnd_nav WHERE nnd_url="."'$arr[0]'";
    
    $ress=mysqli_query($conn,$sqll);
    $pathurl=mysqli_fetch_assoc($ress);
   
    //每一页显示的数据
    $pagelimit = '5';
    //显示页码的数量
    $size='5';
    //查询总共的条数
    $sqls = "SELECT * FROM nnd_info";  
    //获取长度
    $count=$conn->query($sqls)->num_rows;

    //获得页码的长度
    $pagecount=ceil($count/$pagelimit);
    //获取页码
    if(!empty($_GET['id']) && isset($_GET['id'])){
        $page = $_GET['id'];
         if($page>$pagecount ||$page<0){
          die("非法访问");
         }
    }else{
         $page = '1';
    }


    $cc=page($page,$count,$size,$pagecount);
    
    
    //偏移量
    $n = ($page - 1) * $pagelimit;
    $sql='SELECT * FROM nnd_info  limit '."$n,"."$pagelimit";
    $result=mysqli_query($conn,$sql);
    while ($res=mysqli_fetch_assoc($result)) {
      $info[]=$res;
    }

    //内容文件
    include './views/news_center.html';

    //页脚
    include 'footer.php';
?>