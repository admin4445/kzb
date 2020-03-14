    <?php 
        include 'header.php';

        /*添加操作********************************************************************/
        //判断是否post提交的数据是否有存在
        if(!empty($_POST['sub']) && isset($_POST['sub'])){
            //获取表单post提交的数据
            $name=$_POST['name'];
            //设置添加的时间，以时间戳的形式存储在表中
            $time=time();
            //添加的sql语句
            $sql="INSERT INTO nnd_info_type (`info_type_name`,`info_type_time`) VALUES('$name','$time')";
            //调取封装的函数中的插入方法 ，返回的是数据的类型是布尔值 true或false
            $res=insert($sql);
            if($res['code']==1){
                echo "<script> alert('添加成功');window.location.href='infotype_list.php';</script>";
            }else{
                echo "<script> alert('添加失败')</script>";
            }
        }

       



     ?>
    <!-- End: Sidebar -->
    <!-- Start: Content -->
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">添加资讯</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="#" method="post" class="cmxform">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">添加类型</div>
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
                                            <input type="text" name="name" value="" class="form-control">
                                        </div>
                                    </div>
                                 
                                </div>
                          
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue n" name="sub">
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