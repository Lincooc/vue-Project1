<?php
header('Access-Control-Allow-Origin: http://localhost:8080'); // 允许 localhost:8080 的跨域请求
header('Access-Control-Allow-Methods: GET'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
$link=require_once "connect.php";
$res=mysqli_query($link,"select userId,userName,email from users");
if($res){
    $arr=mysqli_fetch_all($res,MYSQLI_ASSOC);
    echo json_encode(['users'=>$arr,'success'=>true]);
}
else{
    echo json_encode(['success'=>false]);
}
?>