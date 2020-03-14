<?php
     setcookie('username','admin',time()+60*60,'/');



      //设置cookie数组

     setcookie('info[email]','769347672@qq.com',time()+60*60,'/');
     setcookie('info[tel]','1234567899',time()+60*60,'/');

     var_dump($_COOKIE);

?>