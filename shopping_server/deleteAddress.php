<?php
header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
header('Access-Control-Allow-Methods: POST'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
$link=require_once "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($_POST)){
        echo json_encode(['success'=>false,'message'=>'未提交']);
        exit;
    }}
else{
    echo json_encode(['success'=>false,'message'=>'提交方式错误']);
    exit;
}
if(isset($_POST['addressId'])){
    $addressId = $_POST['addressId'];
    $isDefault=mysqli_query($link,"select * from address where addressId=$addressId and isDefault=1");
    if(mysqli_num_rows($isDefault)!=0){
        session_start();
        unset($_SESSION["defaultId"]);
    }
    $res=mysqli_query($link,"DELETE FROM address WHERE addressId=$addressId");
    if($res){
        echo json_encode(['success'=>true,'message'=>'删除成功']);
        exit;
    }
    else{
        echo json_encode(['success'=>false,'message'=>'删除失败']);
        exit;
    }

}
?>