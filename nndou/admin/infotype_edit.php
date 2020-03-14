 <?php 

 include 'header.php';

 /****************查询单个数据*******************/
 if(isset($_GET['typeid'])&&!empty($_GET['typeid'])){
    $sql='SELECT * FROM nnd_info_type WHERE info_type_id='.$_GET['typeid'];
    $infos=find($sql);
 
 }
 /********修改数据*********************************************************/
 if(isset($_POST)&&!empty($_POST)){
        //获取post方式提交的数据
        $id = $_POST['typeid'];
        $name = $_POST['name'];
        $time = time();
        //修改数据的sql语句
        $sql="UPDATE  nnd_info_type SET  `info_type_name` = '$name',`info_type_time`='$time' WHERE `info_type_id`=$id";
        //调取封装的函数中的修改数据的方法 ，返回的是数据的类型是布尔值 true或false
        $res=edit($sql);
        if($res['code']==1){
            echo "<script> alert('修改成功');window.location.href='infotype_list.php';</script>";
        }else{
            echo "<script> alert('修改失败')</script>";
        }
 }



 ?>
    



    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">修改类型</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                        <input type="hidden" name="typeid" value="<?php  echo $infos['info_type_id'];  ?>" />
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
                                            <input type="text" name="name" value="<?php echo $infos['info_type_name'] ;?>"
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