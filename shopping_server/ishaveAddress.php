<?php
header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
header('Access-Control-Allow-Methods: POST'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
$link=require_once "connect.php";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success'=>false,'message'=>'提交方式错误']);
        exit;
}

$res = $link->query('SELECT COUNT(*) FROM address');
$row = $res->fetch_row();
$count = $row[0];
if($count > 0){
    if(isset($_POST['userId'])){
       $userId = $_POST['userId'];
        session_start();
        if(isset($_SESSION["defaultId"])){
            $defaultId=$_SESSION["defaultId"];
        }
        else{
            $res=mysqli_query($link,"select addressId from address where userId=$userId limit 1");
            $res=mysqli_fetch_assoc($res);
            $defaultId=$res["addressId"];
        }

        $result=mysqli_query($link,"select * from address where addressId=$defaultId");
        $result=mysqli_fetch_assoc($result);
        echo json_encode(['success'=>true,'ishaveAddress'=>true,'message'=>$result,'index'=>$defaultId]);
        exit;
    }
    else{
        echo json_encode(['success'=>false,'message'=>$_POST['userId']]);
        exit;
    }

//    if(isset($_POST['userId'])){
//        $userId = $_POST['userId'];
//        $res = $link->query('select addressId from address where userId = $userId and isDefault = 1');
//        $res=$res->fetch_assoc();
//        echo json_encode(['success'=>true,'ishaveAddress'=>true,'message'=>$res['addressId']]);
//    }
//    else{
//        echo json_encode(['success'=>false,'message'=>"出错了"]);
//        exit;
//    }

}
else{//表为空
    echo json_encode(['success'=>true,'ishaveAddress'=>false,'message'=>'表为空']);
}