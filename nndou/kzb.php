<?php
        /**
         * @param $img_addr         [原图路径]
         * @param $width            [缩略图宽度]
         * @param $hight            [缩略图高度]
         * @param string $path      [存储目录]
         * @param string $filename  [原图文件名]
         * @return string           [缩略图路径]
         */
        function thumb($img_addr,$width,$hight,$path='',$filename=''){
            list($w,$h,$type) = getimagesize($img_addr);

            $types = [
                1 => 'gif',
                2 => 'jpeg',
                3 => 'png'
            ];
            $desc_str = "imagecreatefrom".$types[$type];
            $desc_img = $desc_str($img_addr);

            $img_new = imagecreatetruecolor($width,$hight);

            //imagecolorallocate 为一幅图像分配颜色
            $white = imagecolorallocate($img_new,255,255,255);
            //imagecolorallocate 为一幅图像分配颜色 + alpha(透明度)
            //$white = imagecolorallocatealpha($img_new,255,255,255,100);
            imagefill($img_new,0,0,$white);

            imagecopyresized($img_new,$desc_img,0,0,0,0,$width,$hight,$w,$h);


            //后缀
            $suffix = $types[$type];

            //header("Content-Type:image/{$suffix}");

            $filename = 'thumb_'.$filename;

            $thumb = $path.'/'.$filename.'.'.$suffix;

            $save = "image".$types[$type];
            $save($img_new,$thumb); //保存
            //$save($img_new); //输出

            //8. 释放内存
            imagedestroy($img_new);

            return $thumb;
        }


        //加水印
        function watermark($img_addr,$string='',$path = ''){
            list($w,$h,$type) = getimagesize($img_addr);
            $types = [
                1 => 'gif',
                2 => 'jpeg',
                3 => 'png'
            ];
            //变量函数
            $createimg = "imagecreatefrom".$types{$type};
            //原图
            $img=$createimg($img_addr);
            //为图像分配颜色

            $white=imagecolorallocate($img,255,255,255);
            $black=imagecolorallocate($img,0,0,0);
            $red=imagecolorallocate($img,255,0,0);
            $pink=imagecolorallocate($img,255,0,255);

            //添加线条
            //imageline($img,0,0,200,200,$red);
            //添加文字

            //imagestring( $img ,  8 ,  10 ,  10 ,  $string ,  $black );


            //设置字体
            imagettftext($img,30,0,50,50,$red,'./static/fonts/STHUPO.ttf',$string);
            //后缀
            $suffix = $types[$type];

//            header("Content-Type:image/{$suffix}");
//            $save = "image".$types[$type];
//            $save($img); //输出

            header("Content-Type:image/{$suffix}");
            if($path==""){
                $path='./';
            }
            //
            $save = "image".$types[$type];
            $save($img,$path.time().'.'.$types[$type]); //保存
            $save($img); //输出

            //8. 释放内存
            imagedestroy($img);
        }

           //watermark('http://www.niundou.com/admin/uploads/1578397765.png','kzb','img/');


        function watermark_img($origin_img,$water_img,$path=''){
            list($w,$h,$type) = getimagesize($origin_img);
            list($ww,$wh,$wtype) = getimagesize($water_img);
            $types = [
                1 => 'gif',
                2 => 'jpeg',
                3 => 'png'
            ];
            //变量函数
            //原图
            $originimg = "imagecreatefrom".$types{$type};
            //水印图
            $waterimg = "imagecreatefrom".$types{$wtype};

            //创建画布
            $img_src = $originimg($origin_img);//原图
            $img_des = $waterimg($water_img);//水印图
            //随机位置不能超出原图的位置
            //$x = mt_rand(4,$w - $ww);
            //$y = mt_rand(4,$h - $wh);
            $x = $w-$ww-20;
            $y = $h-$wh-20;
            imagecopy($img_src,$img_des,$x,$y,0,0,$ww,$wh);
            //后缀
            $suffix = $types[$type];

            header("Content-Type:image/{$suffix}");
            if($path==""){
                $path='./';
            }
            //
            $save = "image".$types[$type];
            $save($img_src,$path.time().'.'.$types[$type]); //保存
            $save($img_src); //输出

            //8. 释放内存
            imagedestroy($img_src);
            imagedestroy($img_des);

        }
        watermark_img('http://www.niundou.com/admin/uploads/1578301024.png','./static/images/public/logo.png','img/')


?>

