<?php
header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
header('Access-Control-Allow-Methods: POST'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
$link=require_once "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST)) {
        echo json_encode(['success' => false, 'message' => '未提交']);
        exit;
    }
    if(!isset($_POST['shopId'])){
        echo json_encode(['success' => false, 'message' => '11']);
        exit;
    }
    if(!isset($_POST['quantity'])){
        echo json_encode(['success' => false, 'message' => '22']);
        exit;
    }
    if(isset($_POST['shopId'])&&isset($_POST['quantity'])){
        $shopId = $_POST['shopId'];
        $quantity = $_POST['quantity'];
        $sql = "update userCart set quantity = $quantity where cartId=?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $shopId);
        if($stmt->execute()){
            echo json_encode(['success' => true]);
        }

        else{
            echo json_encode(['success' => true, 'cart' => null]);
        }
    }
    else{
        echo json_encode(['success'=>false,'message'=>'数据传输错误']);
        exit;
    }

}
else{
    echo json_encode(['success'=>false,'message'=>'提交错误']);
    exit;
}
?>