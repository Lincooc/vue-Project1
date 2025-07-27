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
//1address表不为空，1.1有默认  1.2无默认 2表为空
if(isset($_POST['addressId'])){
    $addressId = $_POST['addressId'];
    $sql="select * from address where addressId=$addressId";
    $res=$link->query($sql);
    $res=$res->fetch_assoc();
    if($res){
        echo json_encode(['success'=>true,'message'=>$res]);
        exit;
    }
}
else{
    echo json_encode(['success'=>true,'message'=>'aa']);
    exit;
}
?>