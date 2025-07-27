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
if(isset($_POST['userId'])){
    $userId = $_POST['userId'];
    $stmt=$link->prepare("SELECT * FROM address where userId=?");
    $stmt->bind_param("i",$userId);
    if($stmt->execute()){
        $result=$stmt->get_result();
        //新增
        $result=$result->fetch_all(MYSQLI_ASSOC);
        session_start();
        if(isset($_SESSION["defaultId"])){
            $defaultId=$_SESSION["defaultId"];
        }
        else{
            $res=mysqli_query($link,"select addressId from address where userId=$userId limit 1");
            $res=mysqli_fetch_assoc($res);
            $defaultId=$res["addressId"];
        }
        echo json_encode(['success' => true, 'message' => $result, 'index' => $defaultId]);
        exit;
    }
    else{
        $stmt->close();
        echo json_encode(['success' => false, 'message' => '加载失败，请稍后再试','index'=>0]);
        exit;
    }
}

?>