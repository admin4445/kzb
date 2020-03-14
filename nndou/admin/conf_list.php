 <?php 
     include 'header.php';
     //查询网站配置信息
       $sql='SELECT * FROM nnd_conf';
       $confinfo=select($sql);


   



          

        
      /*删除操作********************************************************************/

      if(!empty($_GET['del'])&&isset($_GET['del'])){
        //获取get方式提交的数据
        $id=$_GET['del'];

        //查询单个数据
        $sqls="SELECT * FROM nnd_conf WHERE conf_id=$id";


        $confinfo=find($sqls);

        //删除数据的sql
        $sql="DELETE FROM nnd_conf WHERE conf_id=$id";
        //调取封装的函数中的删除数据的方法 ，返回的是数据的类型是布尔值 true或false
        $res=del($sql);
        if($res['code']==1){
            //删除本地图片
            $infoimg = explode('/',$confinfo['conf_img']);
            $infoimgpath='./'.$infoimg[4].'/'.$infoimg[5];

            if(is_file($infoimgpath)){
                unlink($infoimgpath);
            }
        echo "<script> alert('删除成功');window.location.href='conf_list.php';</script>";
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
        <li class="active">网站配置管理</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">网站配置列表</div>
                  <a href="conf_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加配置</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">网站配置</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th class="text-center">网站地址</th>
                        <th class="text-center">版权</th>
                        <th class="text-center">备案</th>
                          <th class="text-center">图片</th>
                        <th width="200">操作</th>
                      </tr>

                      <?php if(count($confinfo)>0){foreach($confinfo as $v){ ?>
                    	<tr class="success">
                        <td class="text-center"><input type="checkbox" value="<?php $confinfo['conf_id'] ?>" name="idarr[]" class="cbox"></td>
                        <td class="text-center"> <?php echo $v['conf_addr'] ?></td>
                        <td class="text-center"> <?php echo $v['conf_copy'] ?></td>
                        <td class="text-center"> <?php echo $v['conf_bean'] ?></td>
                        <td width="300" height="150px"><img src='<?php echo $v['conf_img'] ?>' width="300" height="150px" /></td>

                        <td>
		                      <div class="btn-group">
		                        <a href="conf_add.php?edit=<?php echo $v['conf_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
		                        <a onclick="return confirm('确定要删除吗？');" href="conf_list.php?del=<?php echo $v['conf_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
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