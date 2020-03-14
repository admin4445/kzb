 <?php
        include 'header.php';


         //删除数据
         if(isset($_GET['del'])&&!empty($_GET['del'])){
             //查询数据单个数据
             $sqls = 'SELECT * FROM nnd_case_type WHERE case_type_id='.$_GET['del'];
             $infos = find($sqls);
             $sql = 'DELETE  FROM nnd_case_type WHERE `case_type_id`='.$_GET['del'];
             $res = del($sql);
             if($res['code']==1){
                 //删除本地图片
                 $infoimg = explode('/',$infos['case_type_thumb']);
                 $infoimgpath='./'.$infoimg[4].'/'.$infoimg[5];
                 unlink($infoimgpath);
                 echo "<script> alert('删除成功');window.location.href='casetype_list.php';</script>";
             }else{
                 echo "<script> alert('删除失败')</script>";
             }
        }else{
             //每一页显示的数据
             $pagelimit = '5';
             //每一页显示页码的条数
             $size = '5';
             //查询总共的条数
             $sqls = "SELECT * FROM nnd_case_type";
             //获取长度
             $count = $conn->query($sqls)->num_rows;
             //获得页码的长度
             $pagecount = ceil($count / $pagelimit);
             //获取页码
             if (!empty($_GET['type_id']) && isset($_GET['type_id'])) {
                 $page = $_GET['type_id'];
                 if ($page > $pagecount || $page < 0) {
                     die("非法访问");
                 }
             } else {
                 $page = '1';
             }
             $cc = page($page, $count, $size, $pagecount, 'type_id');
             //偏移量
             $n = ($page - 1) * $pagelimit;
             $sql = 'SELECT * FROM nnd_case_type' . ' LIMIT ' . "$n," . "$pagelimit";
             $result = mysqli_query($conn, $sql);
             while ($res = mysqli_fetch_assoc($result)) {
                 $types[] = $res;
             }

        }




 ?>
  <!-- End: Sidebar -->   

  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">解决方案类型</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">解决方案类型</div>
                  <a href="casetype_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加类型</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">解决方案类型</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                          <th>图片</th>
                          <th>名称</th>
                          <th>标题</th>
                          <th width="200">操作</th>
                      </tr>
                        <?php  foreach($types as $v){ ?>
                            <tr class="success">
                            <td class="text-center"><input type="checkbox" value="<?php echo $v['case_type_id'] ?>" name="idarr[]" class="cbox"></td>
                                <td> <img src="thumb.php?imgs=<?php echo $v['case_type_thumb'] ?>" /></td>
                                <td><?php echo $v['case_type_name1'] ?></td>
                                <td><?php echo $v['case_type_name2'] ?></td>

                                <td>
                                <div class="btn-group">
                                <a href="casetype_edit.php?edit=<?php echo $v['case_type_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                                <a onclick="return confirm('确定要删除吗？');" href="casetype_list.php?del=<?php echo $v['case_type_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                                </div>

                                </td>
                            </tr>
                      <?php } ?>
                  </table>
                  
                  <div class="pull-left">
                  	<button type="submit" class="btn btn-default btn-gradient pull-right delall"><span class="glyphicons glyphicon-trash"></span></button>
                  </div>
                  
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