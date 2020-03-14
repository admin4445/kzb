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
            $sqls = "SELECT * FROM nnd_banner as a ,nnd_bantype as b WHERE a.ban_type=b.btype_id AND a.ban_type=".$tyid;
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
            $sql="SELECT * FROM nnd_banner as a ,nnd_bantype as b WHERE a.ban_type=b.btype_id AND a.ban_type=".$tyid . "  limit "."$n,"."$pagelimit";
            $result=mysqli_query($conn,$sql);
            while ($res=mysqli_fetch_assoc($result)) {
              $baninfo[]=$res;
            }
        }else{

          //分页查询
          //每一页显示的数据
          $pagelimit = '5';
          //每一页显示页码的条数
           $size='5';
          //查询总共的条数
          $sqls = "SELECT * FROM nnd_banner as a ,nnd_bantype as b WHERE a.ban_type=b.btype_id;";
          //获取长度
          $count=$conn->query($sqls)->num_rows;
          //获得页码的长度
          $pagecount=ceil($count/$pagelimit);
          //获取页码
          if(!empty($_GET['ban_page_id']) && isset($_GET['ban_page_id'])){
              $page = $_GET['ban_id'];
               if($page>$pagecount ||$page<0){
                die("非法访问");
               }
          }else{
               $page = '1';
          }
          //偏移量
          $n = ($page - 1) * $pagelimit;
          $sql='SELECT * FROM nnd_banner as a ,nnd_bantype as b WHERE a.ban_type=b.btype_id  limit '."$n,"."$pagelimit";
          $result=mysqli_query($conn,$sql);
          while ($res=mysqli_fetch_assoc($result)) {
            $baninfo[]=$res;
          }

        }


          

        
      /*删除操作********************************************************************/

      if(!empty($_GET['del'])&&isset($_GET['del'])){
        //获取get方式提交的数据
        $id=$_GET['del'];
        //查询单个数据
        $sqls="SELECT * FROM nnd_banner ban_id=$id";
        $baninfo=find($sqls);
        //删除数据的sql
        $sql="DELETE FROM nnd_banner WHERE ban_id=$id";
        //调取封装的函数中的删除数据的方法 ，返回的是数据的类型是布尔值 true或false
        $res=del($sql);
        if($res['code']==1){
        //删除本地图片
        $infoimg = explode('/',$baninfo['ban_url']);
        $infoimgpath='./'.$infoimg[4].'/'.$infoimg[5];
        unlink($infoimgpath);
        echo "<script> alert('删除成功');window.location.href='banner_list.php';</script>";
        }else{
        echo "<script> alert('删除失败')</script>";
        }

      }







  ?>
  <!-- End: Sidebar -->   

  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">轮播图管理</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">轮播图列表</div>
                  <a href="banner_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加轮播图</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">轮播图</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th class="text-center">名称</th>
                        <th class="text-center">轮播图</th>
                        <th class="text-center">隶属于</th>
                        <th width="200">操作</th>
                      </tr>

                      <?php if(count($baninfo)>0){foreach($baninfo as $v){ ?>
                    	<tr class="success">
                        <td class="text-center"><input type="checkbox" value="<?php echo $v['ban_id'] ?>" name="idarr[]" class="cbox"></td>
                        <td class="text-center"> <?php echo $v['ban_name'] ?></td>
                        <td width="300" height="150px"><img src='<?php echo $v['ban_url'] ?>' width="300" height="150px" /></td>
                        <td class="text-center"><?php echo $v['btype_name'] ?></td>
                        <td>
		                      <div class="btn-group">
		                        <a href="banner_edit.php?edit=<?php echo $v['ban_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
		                        <a onclick="return confirm('确定要删除吗？');" href="banner_list.php?del=<?php echo $v['ban_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
		                      </div>
                        
                        </td>
                      </tr>
                      <?php }?>
                      <?php }else{ echo "暂无数据";} ?>
                      <!-- <tr class="success">
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

                  <?php echo $cc ;?>
                  
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