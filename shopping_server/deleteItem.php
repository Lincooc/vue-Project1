<?php

header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
header('Access-Control-Allow-Methods: POST'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
$link = require_once "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST)) {
        echo json_encode(['success' => false, 'message' => '未提交']);
        exit;
    }
    if (isset($_POST['shopId'])&&isset($_POST['all'])) {
        $all = $_POST['all'];

        if($all=='true'){
            $sql="DELETE FROM usercart";
            mysqli_query($link, $sql);
            echo json_encode(['success' => true,'message'=>"已清空购物车"]);
            exit;
        }

        $shopId = $_POST['shopId'];
        $sql = "DELETE FROM usercart WHERE cartId =?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $shopId);
        if($stmt->execute()){
            echo json_encode(['success' => true,'message'=>"删除成功"]);
            exit;
        }
        else{
            echo json_encode(['success' => true,'message'=>"删除成功"]);
            exit;
        }
    }
    echo json_encode(['success' => true,'message'=>"删除成功"]);
    exit;

}
else{
    echo json_encode(['success'=>false,'message'=>'提交错误']);
    exit;
}
?>