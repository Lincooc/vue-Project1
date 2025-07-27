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
    if(isset($_POST['userId'])){
        $userId = $_POST['userId'];
        $sql = "SELECT cartId,name, description,quantity, imgName,price,stock
        FROM userCart JOIN items ON items.proId = usercart.proId 
        WHERE usercart.userId = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows> 0) {
            $res=$result->fetch_all(MYSQLI_ASSOC);
            echo json_encode(['success' => true, 'cart' => $res]);
        }
        else{
            echo json_encode(['success' => true, 'cart' => []]);
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