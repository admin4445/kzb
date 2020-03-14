 <?php 

 include 'header.php';
 //查询所有的咨询类型
 $casetype=casetype();
 if(isset($_GET['infoid'])&&!empty($_GET['infoid'])){
    $sql='SELECT * FROM nnd_info WHERE info_id='.$_GET['infoid'];
    $infos=find($sql);
 }


 if(isset($_POST)&&!empty($_POST)){
        $id = $_POST['info_id'];
        $type = $_POST['casetype'];
        $title = $_POST['title'];
        $content = isset($_POST['editorValue']) ? trim($_POST['editorValue']) : '';
        $time = time();
        //上传图片
        if(!empty($_FILES)){
            $upload = upload('pic1');
            if($upload['code']==1){
                 $imgpath = $upload['imgpath'];
                //截取数组最后一个元素
                $arr_list=explode('/',$imgpath);
                $c=count($arr_list)-1;
                $filename=$arr_list[$c];
                //生成新的缩略图
                $thumbimg=thumb($imgpath,150,102,'uploads/thumb',$filename);

                //删除本地图片
                $infoimg = explode('/',$infos['info_img']);
                $infoimgpath='./'.$infoimg[4].'/'.$infoimg[5];

                if(is_file( $infoimgpath)){
                    unlink($infoimgpath);
                }

                //删除本地缩略图
                $localthumb = explode('/',$infos['info_thumb']);
                $localthumbpath='./'.$localthumb[4].'/'.$localthumb[5].'/'.$localthumb[6];

                if(is_file($localthumbpath)){
                    unlink($localthumbpath);
                }

            }else{
                 $imgpath=$infos['info_img'];
                 $thumbimg=$infos['info_thumb'];
            }
           
        }

        $sql="UPDATE  nnd_info SET  `info_title` = '$title',`info_content`='$content',`info_img`='$imgpath',`info_time`='$time',`info_type`=$type,`info_thumb`= '$thumbimg' WHERE `info_id`=$id";

        $res=edit($sql);
        if($res['code']==1){
            echo "<script> alert('修改成功');window.location.href='info.php';</script>";
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
                        <input type="hidden" name="info_id" value="<?php  echo $infos['info_id'];  ?>" />
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
                                            <select name="casetype" id="standard-list1" class="form-control">
                                                <?php foreach($casetype as $val){ ?>
                                                <option value="<?php echo $val['info_type_id'] ?>" 
                                                    <?php if($infos['info_type']==$val['info_type_id']){echo "selected = 'selected'";} ?> >
                                                    <?php  echo $val['info_type_name']?>
                                                        
                                                    </option>
                                                <?php }?>
                                              
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">标题</span>
                                            <input type="text" name="title" value="<?php echo $infos['info_title'] ;?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                                   <!--  <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">作者</span>
                                            <input type="text" name="author" value="admin" class="form-control">
                                        </div>
                                    </div> -->
                                     <div>
                                       
                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                    <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="<?php echo $infos['info_img']; ?>" alt="" />
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
					                  <?php echo $infos['info_content']; ?>

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