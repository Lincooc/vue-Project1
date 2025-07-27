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


if(isset($_POST["userId"])&&isset($_POST["address"])){
    $userId=$_POST["userId"];
    $address=$_POST["address"];
    $isDefault =$address['isDefault']=='true'? 1 : 0;
    if($isDefault==1){
        $stmt=$link->prepare("update address set isDefault=0 where userId=? and isDefault=1");
        $stmt->bind_param("i",$userId);
        $stmt->execute();
        $stmt->close();


    }
    $stmt=$link->prepare("INSERT INTO address(userId,name,phone,province,city,district,detail,isDefault) VALUES(?,?,?,?,?,?,?,?)");

    $stmt->bind_param("issssssi",$userId,$address['name'],$address['phone'],
        $address['province'],$address['city'],$address['district'],$address['detail'],$isDefault);

    if($stmt->execute()){
        $stmt->close();
        if($isDefault==1){
            $res=mysqli_query($link,"select MAX(addressId) from address where userId=$userId");
            $res=mysqli_fetch_assoc($res);
            session_start();
            if (isset($res['MAX(addressId)'])) {
                $_SESSION['defaultId'] = (int)$res['MAX(addressId)']; // 正确赋值
            }
        }
        echo json_encode(['success' => true, 'message' => '添加成功']);
        exit;


    }
    else{
        $stmt->close();
        echo json_encode(['success' => false, 'message' => '添加失败，请稍后再试']);
        exit;
    }
}
?>