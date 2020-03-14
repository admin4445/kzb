 <?php
        include 'header.php';
         //查询解决方案的信息
         if(isset($_GET['type'])&&!empty($_GET['type'])){
             //获取类型id
             $tyid=$_GET['type'];
             //在分页查询分类id
             //每一页显示的数据
             $pagelimit = '3';
             //每一页显示页码的条数
             $size='5';
             //查询总共的条数
             $sqls = "SELECT * FROM nnd_service WHERE serv_type=".$tyid;
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
             $sql = 'SELECT a.*,b.serv_type_name FROM nnd_service as a,nnd_serv_type as b WHERE a.serv_type = b.serv_type_id and b.serv_type_id = '.$tyid . ' LIMIT ' . "$n," . "$pagelimit";
             $result=mysqli_query($conn,$sql);
             while ($res=mysqli_fetch_assoc($result)) {
                 $types[]=$res;
             }
         }else {
             //每一页显示的数据
             $pagelimit = '5';
             //每一页显示页码的条数
             $size = '5';
             //查询总共的条数
             $sqls = "SELECT a.*,b.serv_type_name FROM nnd_service as a,nnd_serv_type as b WHERE a.serv_type = b.serv_type_id";
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
             $sql = 'SELECT a.*,b.serv_type_name FROM nnd_service as a,nnd_serv_type as b WHERE a.serv_type = b.serv_type_id' . ' LIMIT ' . "$n," . "$pagelimit";
             $result = mysqli_query($conn, $sql);
             while ($res = mysqli_fetch_assoc($result)) {
                 $types[] = $res;
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
             $sqls = 'SELECT * FROM nnd_service WHERE serv_id='.$_GET['del'];
             $infos = find($sqls);
             $sql = 'DELETE  FROM nnd_service WHERE `serv_id`='.$_GET['del'];
             $res = del($sql);
             if($res['code']==1){
                 //删除本地图片
                 $infoimg = explode('/',$infos['serv_img']);
                 $infoimgpath='./'.$infoimg[4].'/'.$infoimg[5];
                 unlink($infoimgpath);
                 echo "<script> alert('删除成功');window.location.href='server_list.php{$type}';</script>";
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
        <li class="active">解决方案</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">解决方案列表</div>
                  <a href="server_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加方案</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">解决方案</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                          <th>图片</th>
                        <th>标题</th>
                          <th>子标题</th>
                        <th>描述</th>
                          <th>类型</th>
                        <th width="200">操作</th>
                      </tr>
                        <?php foreach($types as $v){ ?>
                    	<tr class="success">
                        <td class="text-center"><input type="checkbox" value="<?php echo $v['serv_id'] ?>" name="idarr[]" class="cbox"></td>
                            <td><img src="thumb.php?imgs=<?php echo $v['serv_img'] ?>" /></td>
                        <td><?php echo $v['serv_name'] ?></td>
                        <td><?php echo $v['serv_name1'] ?></td>
                            <td><?php echo mb_substr($v['serv_desc'],0,20) ?></td>
                            <td><?php echo $v['serv_type_name'] ?></td>
                        <td>
		                      <div class="btn-group">
		                        <a href="server_edit.php?edit=<?php echo $v['serv_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
		                        <a onclick="return confirm('确定要删除吗？');" href="<?php echo geturl().'del='.$v['serv_id']; ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
		                      </div>
                        
                        </td>
                      </tr>
                      <?php } ?>

                  </table>
                  
                  <div class="pull-left">
                  	<button type="submit" class="btn btn-default btn-gradient pull-right delall"><span class="glyphicons glyphicon-trash"></span></button>
                  </div>
                  
<!--                  <div class="pull-right">-->
<!--                    <ul class="pagination" id="paginator-example">-->
<!--                      <li><a href="#">&lt;</a></li>-->
<!--                      <li><a href="#">&lt;&lt;</a></li>-->
<!--                      <li><a href="#">1</a></li>-->
<!--                      <li class="active"><a href="#">2</a></li>-->
<!--                      <li><a href="#">3</a></li>-->
<!--                      <li><a href="#">&gt;</a></li>-->
<!--                      <li><a href="#">&gt;&gt;</a></li>-->
<!--                    </ul>-->
<!--                  </div>-->

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