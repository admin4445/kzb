 <?php 
    include 'header.php';
    
    
   /*删除操作********************************************************************/

      if(!empty($_GET['typeid'])&&isset($_GET['typeid'])){
          //获取get方式提交的数据
          $id=$_GET['typeid'];
          //删除数据的sql
          $sql="DELETE FROM nnd_info_type WHERE info_type_id=$id";
          //调取封装的函数中的删除数据的方法 ，返回的是数据的类型是布尔值 true或false
          $res=del($sql);
          if($res['code']==1){


              echo "<script> alert('删除成功');window.location.href='infotype_list.php';</script>";
          }else{
              echo "<script> alert('删除失败')</script>";
          }

      }else{
          //分页查询
          //每一页显示的数据
          $pagelimit = '5';

          //每一页显示页码的条数
           $size='5';
          //查询总共的条数
          $sqls = "SELECT * FROM nnd_info_type";  
          //获取长度
          $count=$conn->query($sqls)->num_rows;
          //获得页码的长度
          $pagecount=ceil($count/$pagelimit);
          //获取页码
          if(!empty($_GET['type_id']) && isset($_GET['type_id'])){
              $page = $_GET['type_id'];
               if($page>$pagecount ||$page<0){
                die("非法访问");
               }

          }else{
               $page = '1';
          }
          $cc=page($page,$count,$size,$pagecount,'type_id');
          //偏移量
          $n = ($page - 1) * $pagelimit;
          $sql='SELECT * FROM nnd_info_type  limit '."$n,"."$pagelimit";
          
          $result=mysqli_query($conn,$sql);
          while ($res=mysqli_fetch_assoc($result)) {
            $types[]=$res;
          }

      }


  ?>
  <!-- End: Sidebar -->   

  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">资讯分类管理</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">分类列表</div>
                  <a href="infotype_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加分类</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">资讯类型</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>编号</th>
                        <th>类型名称</th>
                        <th>添加时间</th>
                        <th width="200">操作</th>
                      </tr>
                       <?php foreach ($types as $value){ ?>

                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value=" <?php echo $value['info_type_id']?>" name="idarr[]" class="cbox"></td>
                        <td><?php echo  $value['info_type_id'] ?></td>
                        <td><?php echo $value['info_type_name'] ?></td>
                         <td><?php echo  date('Y-m-d H:i:s',$value['info_type_time']) ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="infotype_edit.php?typeid=<?php echo  $value['info_type_id'];  ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="infotype_list.php?typeid=<?php echo  $value['info_type_id'];  ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        
                        </td>
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
                  <?php echo $cc; ?>
                  
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