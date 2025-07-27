<?php
    header('Content-Type: text/html; charset=utf-8');
    header('Content-Type: application/json');
    $link=mysqli_connect("localhost","root","root","sustain_life");
    if(!$link){
        die("数据库连接失败！<br>错误号：".mysqli_connect_errno()."<br>错误信息: ".mysqli_connect_error());
    }
    return $link;
?>