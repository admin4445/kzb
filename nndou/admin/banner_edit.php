    <?php 
         include 'header.php' ;
        /****************查询单个数据*******************/
         if(isset($_GET['edit'])&&!empty($_GET['edit'])){
            //查询banner图的类型
            $sql='SELECT * FROM nnd_bantype';
            $bantype=type($sql);
            $sql='SELECT * FROM nnd_banner as a,nnd_bantype as b WHERE a.ban_type=b.btype_id AND a.ban_id='.$_GET['edit'];
            $infos=find($sql);

         }
        //修改轮播图信息
        if(isset($_POST['sub'])){
            $type = $_POST['ban_type'];
            $id = $_POST['ban_id'];
            $name = $_POST['ban_name'];
            //上传图片
            if(!empty($_FILES)){
                $upload = upload('pic1');
                if($upload['code']==1){
                     $imgpath = $upload['imgpath'];
                    //删除本地图片
                    $infoimg = explode('/',$infos['ban_url']);
                    $infoimgpath='./'.$infoimg[4].'/'.$infoimg[5];
                    unlink($infoimgpath);
                   
                }else{
                     $imgpath=$infos['ban_url'];

                }
               
            }
            //修改数据的sql语句
            $sql="UPDATE  nnd_banner SET  `ban_name` = '$name',`ban_url`='$imgpath',`ban_type`=$type WHERE `ban_id`=$id";
          
            //调取封装的函数中的修改数据的方法 ，返回的是数据的类型是布尔值 true或false
            $res=edit($sql);
            if($res['code']==1){
                echo "<script> alert('修改成功');window.location.href='banner_list.php';</script>";
            }else{
                echo "<script> alert('修改失败')</script>";
            }



        }

    ?>  

   





    <!-- End: Sidebar -->
    <!-- Start: Content -->
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">修改轮播图</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                         <input type="hidden" name="ban_id" value="<?php  echo $infos['ban_id'];  ?>" />
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">修改轮播图</div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">隶属于</span>
                                            <select name="ban_type" id="standard-list1" class="form-control">
                                               
                                                <?php foreach ($bantype as  $v) {?>
                                                <option value="<?php echo $v['btype_id'] ?>" 
                                                    <?php if($v['btype_id']==$infos['ban_type']){echo "selected = 'selected'";} ?>>
                                                    <?php echo $v['btype_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">名称</span>
                                            <input type="text" name="ban_name" value="<?php echo $infos['ban_name'] ?>" class="form-control">
                                        </div>
                                    </div>
                                 <!--  <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">作者</span>
                                            <input type="text" name="author" value="" class="form-control">
                                        </div>
                                    </div> -->
                                    <div>
                                       
                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                    <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="<?php echo $infos['ban_url']?>" alt="" />
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