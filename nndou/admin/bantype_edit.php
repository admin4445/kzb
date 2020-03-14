 <?php 

 include 'header.php';

 /****************查询单个数据*******************/
 if(isset($_GET['edit'])&&!empty($_GET['edit'])){
    $sql='SELECT * FROM nnd_bantype WHERE btype_id='.$_GET['edit'];
    $infos=find($sql);
 
 }
 /********修改数据*********************************************************/
 if(isset($_POST)&&!empty($_POST)){
       
        //获取post方式提交的数据
        $id = $_POST['btype_id'];
        $name = $_POST['btype_name'];
        $add = $_POST['btype_add'];
      
        //修改数据的sql语句
        $sql="UPDATE  nnd_bantype SET  `btype_name` = '$name',`btype_add`='$add' WHERE `btype_id`=$id";
        //调取封装的函数中的修改数据的方法 ，返回的是数据的类型是布尔值 true或false
        $res=edit($sql);
        if($res['code']==1){
            echo "<script> alert('修改成功');window.location.href='bantype_list.php';</script>";
        }else{
            echo "<script> alert('修改失败')</script>";
        }
 }



 ?>
    



    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href=""><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">修改类型</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                        <input type="hidden" name="btype_id" value="<?php  echo $infos['btype_id'];  ?>" />
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">编辑类型</div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">类型名称</span>
                                            <input type="text" name="btype_name" value="<?php echo $infos['btype_name'] ;?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">地址</span>
                                            <input type="text" name="btype_add" value="<?php echo $infos['btype_add'] ;?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                               
                               
                                   







                                </div>
                              
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue" name="sub">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <!-- End: Content -->
</div>
<!-- End: Main -->

</body>

</html>