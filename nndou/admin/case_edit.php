 <?php 

 include 'header.php';
 /***************查询案例类型*******************************/
 $sql='SELECT * FROM nnd_case_type';
 $casetype=type($sql);

 /****************查询单个数据*******************/
 if(isset($_GET['edit'])&&!empty($_GET['edit'])){
    $sql='SELECT * FROM nnd_cases WHERE case_id='.$_GET['edit'];
    $caseinfo=find($sql);

 }
 /********修改数据*********************************************************/
 if(isset($_POST)&&!empty($_POST)){
     $id=$_POST['case_id'];
     $type = $_POST['case_type'];

     $name = $_POST['case_name'];
     $content = isset($_POST['editorValue']) ? trim($_POST['editorValue']) : '';
     //上传图片
     if(!empty($_FILES)){
         $upload = uplaods();
         if($upload['code']==1){
             $img = $upload['img'];
             $thumb=$upload['thumb'];
         }else{
             $img = $caseinfo['case_img'];
             $thumb = $caseinfo['case_thumb'];
         }
     }

     //修改数据的sql语句
     $sql="UPDATE  nnd_cases  SET  `case_name` = '$name',`case_img`='$img',`case_desc`='$content',`case_type`=$type,`case_thumb`='$thumb' WHERE `case_id`=$id";


     //调取封装的函数中的修改数据的方法 ，返回的是数据的类型是布尔值 true或false
     $res=edit($sql);
     if($res['code']==1){
         echo "<script> alert('修改成功');window.location.href='case_list.php';</script>";
     }else{
         echo "<script> alert('修改失败')</script>";
     }

 }



 ?>
    



    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">修改解决方案</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                        <input type="hidden" name="case_id" value="<?php  echo $caseinfo['case_id'];  ?>" />
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">编辑方案</div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">分类</span>
                                            <select name="case_type" id="standard-list1" class="form-control">
                                                <?php foreach($casetype as $val){ ?>
                                                    <option value="<?php echo $val['case_type_id'] ?>"
                                                        <?php if($caseinfo['case_type']==$val['case_type_id']){echo "selected = 'selected'";} ?> >
                                                        <?php  echo $val['case_type_name1']?>

                                                    </option>
                                                <?php }?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">名字</span>
                                            <input type="text" name="case_name" value="<?php  echo $caseinfo['case_name'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div>大图</div>
                                    <div>

                                        <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                            <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="<?php  echo $caseinfo['case_img'] ?>" alt="" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
                                                    <span class="btn btn-primary btn-file">
                                                        <span class="fileinput-new">选择文件</span>
                                                        <span class="fileinput-exists">换一张</span>
                                                        <input type="file" name="pic1[]" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                                                    </span>
                                                <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                            </div>
                                        </div>

                                    </div>
                                    <div>小图</div>

                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                            <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="<?php  echo $caseinfo['case_thumb'] ?>" alt="" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
                                                    <span class="btn btn-primary btn-file">
                                                        <span class="fileinput-new">选择文件</span>
                                                        <span class="fileinput-exists">换一张</span>
                                                        <input type="file" name="pic1[]" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                                                    </span>
                                                <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="form-group col-md-12">
                                    <script type="text/plain" id="myEditor" style="width:100%;height:200px;">
					                  <?php echo $caseinfo['case_desc']; ?>

                                    </script>
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
 <link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css">
 <script src="js/bootstrap-fileinput.js"></script>
 <script src="umeditor/umeditor.config.js" type="text/javascript"></script>
 <script src="umeditor/editor_api.js" type="text/javascript"></script>
 <script src="umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>
 <script type="text/javascript">
     var ue = UM.getEditor('myEditor', {
         autoClearinitialContent: false,
         wordCount: false,
         elementPathEnabled: false,
         initialFrameHeight: 300
     });
 </script>
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