<?php
header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
header('Access-Control-Allow-Methods: POST'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
$link=require_once "connect.php";

session_start();
if(isset($_SESSION["defaultId"])){
    $defaultId=$_SESSION["defaultId"];
}
else{
    $res=mysqli_query($link,"select userId from address limit 1");
    $res=mysqli_fetch_assoc($res);
    $defaultId=$res["userId"];
}
echo json_encode($defaultId);

?>