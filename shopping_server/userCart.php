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
    }
    if(isset($_POST['proId'])&&isset($_POST['userId'])&&isset($_POST['quantity'])){
        $proId = $_POST['proId'];
        $userId = $_POST['userId'];
        $quantity = $_POST['quantity'];
        $sql = "SELECT cartId, quantity FROM userCart WHERE userId = ? AND proId = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ii", $userId, $proId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $newQuantity = $row['quantity'] + $quantity;
            $updateSql = "UPDATE userCart SET quantity = ? WHERE cartId = ?";
            $updateStmt = $link->prepare($updateSql);
            $updateStmt->bind_param("ii", $newQuantity, $row['cartId']);
            if($updateStmt->execute()){
                echo json_encode(['success'=>true]);
            }
            else{
                echo json_encode(['success'=>false,'message'=>'执行出错']);
                exit;
            }
        } else {

            $insertSql = "INSERT INTO userCart (userId, proId, quantity) VALUES (?, ?, ?)";
            $insertStmt = $link->prepare($insertSql);
            $insertStmt->bind_param("iii", $userId, $proId, $quantity);
            if($insertStmt->execute()){
                echo json_encode(['success'=>true]);
            }
            else{
                echo json_encode(['success'=>false,'message'=>'执行出错']);
                exit;
            }
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