 <?php
    include 'header.php';
    if(isset($_GET['type'])&&!empty($_GET['type'])){
        //获取类型id
        $tyid=$_GET['type'];
        //在分页查询分类id
        //每一页显示的数据
        $pagelimit = '3';
        //每一页显示页码的条数
         $size='5';
         //查询总共的条数
        $sqls = "SELECT * FROM nnd_info WHERE info_type=".$tyid;
        //获取长度
        $count=$conn->query($sqls)->num_rows;
        //获得页码的长度
        $pagecount=ceil($count/$pagelimit);
        //获取分页的页码
        if(isset($_GET['typeid'])&&!empty($_GET['typeid'])){
          $typage=$_GET['typeid'];
        }else{
          $typage=1;
        }
        $bb="type=".$tyid."&typeid";
        $cc=page($typage,$count, $size,$pagecount,$bb);
        //偏移量
        $n = ($typage - 1) * $pagelimit;
        $sql="SELECT * FROM nnd_info WHERE info_type=".$tyid . "  limit "."$n,"."$pagelimit";
        $result=mysqli_query($conn,$sql);
        while ($res=mysqli_fetch_assoc($result)) {
          $types[]=$res;
        }
    }else{
     
        //每一页显示的数据
        $pagelimit = '3';

        //每一页显示页码的条数
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
        $cc=page($page,$count,$size,$pagecount,'id');
        //偏移量
        $n = ($page - 1) * $pagelimit;
        $sql='SELECT * FROM nnd_info  limit '."$n,"."$pagelimit";
        
        $result=mysqli_query($conn,$sql);
        while ($res=mysqli_fetch_assoc($result)) {
          $types[]=$res;
        }
    }
   

    //删除数据
    if(isset($_GET['del'])&&!empty($_GET['del'])){
        if(isset($_GET['type'])&& !empty($_GET['type'])){
                $type="?type=".$_GET['type'];
        }else{
            $type="";
        }
        //查询数据单个数据
        $sqls = 'SELECT * FROM nnd_info WHERE info_id='.$_GET['del'];
        $infos = find($sqls);
        $sql = 'DELETE  FROM nnd_info WHERE `info_id`='.$_GET['del'];
        $res = del($sql);
        if($res['code']==1){
            //删除本地图片
            $infoimg = explode('/',$infos['info_img']);
            $infoimgpath='./'.$infoimg[4].'/'.$infoimg[5];
            if(is_file( $infoimgpath)){
                unlink($infoimgpath);
            }
            //删除本地缩略图
            $localthumb = explode('/',$infos['info_thumb']);
            $localthumbpath='./'.$localthumb[4].'/'.$localthumb[5].'/'.$localthumb[6];
            if(is_file($localthumbpath)){
                unlink($localthumbpath);
            }

          echo "<script> alert('删除成功');window.location.href='info.php{$type}';</script>";
      }else{
           echo "<script> alert('删除失败')</script>";
      }
    }


    //批量删除
    if(isset($_POST['idarr']) && !empty($_POST['idarr'])){
        $id_arr=rtrim(implode($_POST['idarr'],','),',');
        $sql="DELETE FROM info_id WHERE `info_id`  IN ({$id_arr})";
        echo $sql;
        exit;
        $res=del($sql);


    }
   

   

 ?>
  <!-- End: Sidebar -->   

  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">资讯管理</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">资讯列表</div>
                  <a href="infoadd.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加文章</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                   <h2 class="panel-body-title">
                    <?php 
                       if(!isset($_GET['type'])){
                          echo "所有咨询";
                       }else{
                         if($_GET['type']==1){
                            echo "新闻";
                         }else{
                             echo "公告";
                         }
                       }

                    ?>
                    </h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                         <th class="text-center">图片</th>
                        <th>标题</th>
                        <th>内容</th>
                        
                        <th>添加时间</th>
                        <th width="200">操作</th>
                      </tr>

                   
                    <?php if(count($types)>0){ foreach($types as $v){ ?>
                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="<?php echo $v['info_id'] ?>" name="idarr[]" class="cbox"></td>
<!--                          <td><img src="thumb.php?imgs=--><?php //echo $v['info_img'] ?><!--"   /></td>-->
                           <td><img src="<?php  echo $v['info_thumb'] ?>" /></td>
                        <td><?php echo $v['info_title'] ?></td>
                        <td  ><?php echo mb_substr($v['info_content'], 0,90) ?></td>

                        <td width="100" > <?php  echo  date('Y-m-d H:i:s',$v['info_time'])?></td>
                        <td>
                          <div class="btn-group">
                            <a href="infoedit.php?infoid=<?php echo $v['info_id']; ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="<?php echo geturl().'del='.$v['info_id']; ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        
                        </td>
                      </tr>
                      <?php } ?>
                      <?php }else{ ?>

                        <tr class="success">
                          <?php echo "数据记录为空" ?>
                        </tr>

                      <?php } ?>

                     <!--  <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td>再谈互联网给传统金融带来的颠覆</td>
                        <td>2015-01-10</td>
                        <td>
                          <div class="btn-group">
                            <a href="article_edit.html" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="#" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        
                        </td>
                      </tr>
                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td>再谈互联网给传统金融带来的颠覆</td>
                        <td>2015-01-10</td>
                        <td>
                          <div class="btn-group">
                            <a href="article_edit.html" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="#" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        
                        </td>
                      </tr> -->
                  </table>
                  
                  <div class="pull-left">
                  	<button type="submit" class="btn btn-default btn-gradient pull-right delall"><span class="glyphicons glyphicon-trash"></span></button>
                  </div>
                  
                  <!-- <div class="pull-right">
                    <ul class="pagination" id="paginator-example">
                      <li><a href="#">&lt;</a></li>
                      <li><a href="#">&lt;&lt;</a></li>
                      <li><a href="#">1</a></li>
                      <li class="active"><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">&gt;</a></li>
                      <li><a href="#">&gt;&gt;</a></li>
                    </ul>
                  </div> -->
                  <?php echo $cc;?>
                  
                </div>
                </form>
              </div>
          </div>
        </div>
    </div>
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --> 

</body>
</html>