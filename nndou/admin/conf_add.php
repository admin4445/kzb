    <?php 
        include 'header.php' ;
        if(isset($_GET['edit']) && !empty($_GET['edit'])){
            //查询单个数据
            $sql='SELECT * FROM nnd_conf WHERE conf_id='.$_GET['edit'];
            $confinfo=find($sql);
        }
        //添加网站配置信息
        if(isset($_POST)){
            $conf_addr = $_POST['conf_addr'];
            $conf_copy = $_POST['conf_copy'];
            $conf_bean= $_POST['conf_bean'];
            if(isset($_POST['addsub'])){
                //上传图片
                if(!empty($_FILES)){
                    $upload = upload('pic1');
                    if($upload['code']==1){
                        $conf_img = $upload['imgpath'];
                    }else{
                        $conf_img="";
                    }
                }
                $sql="INSERT INTO nnd_conf (`conf_addr`,`conf_copy`,`conf_bean`,`conf_img`) VALUES( '$conf_addr',' $conf_copy',' $conf_bean','$conf_img')";
                $res=insert($sql);
                if($res['code']==1){
                    echo "<script> alert('添加成功');window.location.href='conf_list.php';</script>";
                }else{
                    echo "<script> alert('添加失败')</script>";
                }
            }else if($_POST['subedit']){
                $id = $_POST['conf_id'];
                //上传图片
                if(!empty($_FILES)){
                    $upload = upload('pic1');
                    if($upload['code']==1){
                        $conf_img = $upload['imgpath'];
                    }else{
                        $conf_img=$confinfo['conf_img'];
                    }
                }
                $sql="UPDATE nnd_conf SET `conf_addr`= '$conf_addr',`conf_copy`='$conf_copy',`conf_bean`='$conf_bean',`conf_img`='$conf_img' WHERE `conf_id`=".$id;

                $res=edit($sql);
                if($res['code']==1){
                    echo "<script> alert('修改成功');window.location.href='conf_list.php';</script>";
                }else{
                    echo "<script> alert('修改失败')</script>";
                }
            }

        }

    ?>  

   





    <!-- End: Sidebar -->
    <!-- Start: Content -->
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">添加网站配置</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                        <input type="hidden" name="conf_id" value="<?php  if(isset($confinfo)){ echo $confinfo['conf_id'];}else{ echo ""; }?>" />
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">添加配置信息</div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">

                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">网站地址</span>
                                            <input type="text" name="conf_addr" value="<?php  if(isset($confinfo)){ echo $confinfo['conf_addr'];}else{ echo ""; } ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">版权信息</span>
                                            <input type="text" name="conf_copy" value="<?php  if(isset($confinfo)){ echo $confinfo['conf_copy'];}else{ echo ""; } ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">备案信息</span>
                                            <input type="text" name="conf_bean" value="<?php  if(isset($confinfo)){ echo $confinfo['conf_bean'];}else{ echo ""; } ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div>
                                       
                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                    <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src=" <?php  if(isset($confinfo)){ echo $confinfo['conf_img'];}else{ echo "images/noimage.png"; } ?>" alt="" />
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                <div>
                                                    <span class="btn btn-primary btn-file">
                                                        <span class="fileinput-new">选择文件</span>
                                                        <span class="fileinput-exists">换一张</span>
                                                        <input type="file" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                                                    </span>
                                                    <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                                </div>
                                            </div>

                                    </div>

                                </div>

                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue" name="<?php if(isset($confinfo)){ echo 'subedit';}else{echo 'addsub';} ?>">
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