 <?php 

 include 'header.php';

 /****************查询单个数据*******************/
 if(isset($_GET['edit'])&&!empty($_GET['edit'])){
    $sql='SELECT * FROM nnd_about_type WHERE abo_type_id='.$_GET['edit'];
    $abouttypeinfo=find($sql);

 }
 /********修改数据*********************************************************/
 if(isset($_POST)&&!empty($_POST)){
        //获取post方式提交的数据
        $id = $_POST['abo_type_id'];
        $name = $_POST['abo_type_name'];
        //修改数据的sql语句
        $sql="UPDATE  nnd_about_type SET  `abo_type_name` = '$name' WHERE `abo_type_id`=$id";
        //调取封装的函数中的修改数据的方法 ，返回的是数据的类型是布尔值 true或false
        $res=edit($sql);
        if($res['code']==1){
            echo "<script> alert('修改成功');window.location.href='abouttype_list.php';</script>";
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
                        <input type="hidden" name="abo_type_id" value="<?php  echo $abouttypeinfo['abo_type_id'];  ?>" />
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">编辑方案类型</div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">

                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">名字</span>
                                            <input type="text" name="abo_type_name" value="<?php echo $abouttypeinfo['abo_type_name'] ;?>"
                                                   class="form-control">
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

 <script src="js/bootstrap-fileinput.js"></script>

 <script type="text/javascript">
     $(function () {
         //比较简洁，细节可自行完善
         $('#uploadSubmit').click(function () {
             var data = new FormData($('#uploadForm')[0]);
             $.ajax({
                 url: 'xxx/xxx',
                 type: 'POST',
                 data: data,
                 async: false,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function (data) {
                     console.log(data);
                     if(data.status){
                         console.log('upload success');
                     }else{
                         console.log(data.message);
                     }
                 },
                 error: function (data) {
                     console.log(data.status);
                 }
             });
         });

     })
 </script>
</body>

</html>