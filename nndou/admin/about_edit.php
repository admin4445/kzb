 <?php 

 include 'header.php';
 //查询所有的关于我们的类型
 $sql='SELECT * FROM nnd_about_type';
 $abouttype=type($sql);
 if(isset($_GET['edit'])&&!empty($_GET['edit'])){
    $sql='SELECT * FROM nnd_about WHERE about_id='.$_GET['edit'];
    $infos=find($sql);
 }


 if(isset($_POST)&&!empty($_POST)){
         $id=$_POST['about_id'];
         $type = $_POST['about_type'];
         $name = $_POST['about_name'];
         $ename = $_POST['about_ename'];
         $content = isset($_POST['editorValue']) ? trim($_POST['editorValue']) : '';
        //上传图片
        if(!empty($_FILES)){
            $upload = upload('pic1');
            if($upload['code']==1){
                 $imgpath = $upload['imgpath'];
                //删除本地图片
                $infoimg = explode('/',$infos['about_img']);
                $infoimgpath='./'.$infoimg[4].'/'.$infoimg[5];

                if(is_file( $infoimgpath)){
                    unlink($infoimgpath);
                }
            }else{
                 $imgpath=$infos['about_img'];

            }
           
        }
        $sql="UPDATE  nnd_about SET  `about_title` = '$name',`about_title_en`='$ename',`about_content`='$content',`about_img`='$imgpath',`about_tpye`=$type  WHERE `about_id`=$id";
      
        $res=edit($sql);
        if($res['code']==1){
            echo "<script> alert('修改成功');window.location.href='about_list.php';</script>";
        }else{
            echo "<script> alert('修改失败')</script>";
        }

 }



 ?>
    



    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">修改资讯</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                        <input type="hidden" name="about_id" value="<?php  echo $infos['about_id'];  ?>" />
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">编辑文章</div>
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
                                            <select name="about_type" id="standard-list1" class="form-control">
                                                <?php foreach($abouttype as $val){ ?>
                                                <option value="<?php echo $val['abo_type_id'] ?>"
                                                    <?php if($infos['about_tpye']==$val['abo_type_id']){echo "selected = 'selected'";} ?> >
                                                    <?php  echo $val['abo_type_name']?>

                                                    </option>
                                                <?php }?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">标题</span>
                                            <input type="text" name="about_name" value="<?php echo $infos['about_title'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">英文标题</span>
                                            <input type="text" name="about_ename" value="<?php echo $infos['about_title_en'] ?>" class="form-control">
                                        </div>
                                    </div>
                                     <div>

                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                    <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="<?php echo $infos['about_img']; ?>" alt="" />
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
                                <div class="form-group col-md-12">
                                    <script type="text/plain" id="myEditor" style="width:100%;height:200px;">
					                  <?php echo $infos['about_content']; ?>

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